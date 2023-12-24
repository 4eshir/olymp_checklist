<?php

namespace App\Http\Controllers;

use App\Models\dbUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Ramsey\Uuid\Type\Integer;

class ConsoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUrl($municipality_id, $subject_id, $school_id = null)
    {
        $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(604800), ['mun' => $municipality_id, 'sch' => $school_id,'sub' => $subject_id]);
        return $url;
    }

    public function createArrUrlsMun($municipality_id)
    {
        $urls = [];

        for ($i = 1; $i < 25; $i++)
        {
            if ($municipality_id < 14)
            {
                $tUrl = $this->generateUrl($municipality_id, $i);

                $dbUrl = dbUrl::create([
                    'raw' => $tUrl,
                    'municipality_id' => $municipality_id,
                    'subject_id' => $i,
                ]);
            }
            else
            {
                $schools = json_decode(Http::get(getenv('STUDENT_URL')."/api/get-schools-juri/1/".$municipality_id)->body());
                $schoolsId = $schools->id;

                for ($key = 0; $key < count($schoolsId); $key++)
                {
                    $tUrl = $this->generateUrl($municipality_id, $i, $schoolsId[$key]);

                    $dbUrl = dbUrl::create([
                        'raw' => $tUrl,
                        'school_id' => $schoolsId[$key],
                        'subject_id' => $i,
                    ]);
                }
            }

            $urls[] = $tUrl;
        }

        return $urls;
    }

    public function createArrUrlsJuri($school_id)
    {
        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($school_id, $i);

            /*$record = new dbUrl();
            $record->raw = $tUrl;
            $record->school_id = $school_id;
            $record->subject_id = $i;
            $record->save();*/

            $dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'school_id' => $school_id,
                'subject_id' => $i,
            ]);
        }
    }
}
