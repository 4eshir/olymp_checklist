<?php

namespace App\Console\Commands;

use App\Models\dbUrl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Ramsey\Uuid\Type\Integer;

class GenUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generate {m_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : void
    {
        $m_id = $this->argument('m_id');

        for ($i = 1; $i < 25; $i++)
        {
            $tUrl = $this->generateUrl($m_id, $i);

            $dbUrl = dbUrl::create([
                'raw' => $tUrl,
                'municipality_id' => $m_id,
                'subject_id' => $i,
            ]);
        }
    }



    public function generateUrl($municipality_id, $subject_id)
    {
        $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(1000), [], false);
        return $url;
    }

}
