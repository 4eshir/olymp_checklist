<?php

namespace App\Http\Controllers;

use App\Models\dbUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;
use Ramsey\Uuid\Type\Integer;

class ConsoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUrl($municipality_id, $subject_id)
    {
        $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(1000), ['mun' => $municipality_id, 'sub' => $subject_id]);
        return $url;
    }

    public function createArrUrlsMun($municipality_id)
    {
        $urls = [];
        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($municipality_id, $i);

            $record = new dbUrl();
            $record->raw = $tUrl;
            $record->municipality_id = $municipality_id;
            $record->subject_id = $i;
            $record->save();

            $urls[] = $tUrl;
            /*$dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'municipality_id' => $municipality_id,
                'subject_id' => $i,
            ]);*/
        }

        return $urls;
    }

    public function createArrUrlsJuri($school_id)
    {
        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($school_id, $i);

            $record = new dbUrl();
            $record->raw = $tUrl;
            $record->school_id = $school_id;
            $record->subject_id = $i;
            $record->save();

            $dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'school_id' => $school_id,
                'subject_id' => $i,
            ]);
        }
    }
}
