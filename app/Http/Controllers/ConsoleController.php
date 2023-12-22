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
        $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(1000));
        return $url;
    }

    public function createArrUrlsMun($municipality_id)
    {
        //$tUrl = $this->generateUrl($municipality_id, 1);
        $dbUrl = dbUrl::create([
            'raw' => $tUrl,
            'municipality_id' => $municipality_id,
            'subject_id' => 1,
        ]);

        //$tUrl = $this->generateUrl($municipality_id, 2);
        $dbUrl = dbUrl::create([
            'raw' => $tUrl,
            'municipality_id' => $municipality_id,
            'subject_id' => 2,
        ]);

        //$tUrl = $this->generateUrl($municipality_id, 3);
        $dbUrl = dbUrl::create([
            'raw' => $tUrl,
            'municipality_id' => $municipality_id,
            'subject_id' => 3,
        ]);

        /*for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($municipality_id, $i);

            $dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'municipality_id' => $municipality_id,
                'subject_id' => $i,
            ]);
        }*/

        return 'boobs';
    }

    public function createArrUrlsJuri($school_id)
    {
        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($school_id, $i);

            $dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'school_id' => $school_id,
                'subject_id' => $i,
            ]);
        }
    }
}
