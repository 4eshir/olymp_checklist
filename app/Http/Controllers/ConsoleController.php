<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class ConsoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUrl($municipality_id, $subject_id)
    {
        $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(1000));
        return $url;
    }

    public function createArrayUrls($municipality_id)
    {
        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($municipality_id, $i);

            
        }
    }
}
