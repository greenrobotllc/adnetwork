<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\AdInfoController;
use App\Http\Controllers\RefreshController;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // echo "Starting Refresh Ad RPM";
        // $theDate = date('Y-m-d');

        // $clicks = DB::select(DB::raw("select ad_id, avg(cost) from clicks where click_date =? group by ad_id)", [$theDate]);
        // print_r($clicks);
            

        echo "Starting Refresh Ad RPM";
        $RefreshController = new RefreshController();
        $output = $RefreshController->index();
        echo str_replace(array('<br />','<hr>','</p>','<p>')," \n ",$output); //formatting output for terminal
        echo "\n Done Refresh Ad RPM";

        // $AdInfo = new AdInfoController();
        // $output = $AdInfo->refresh();
        // echo str_replace(array('<br />','<hr>','</p>','<p>')," \n ",$output); //formatting output for terminal
       // echo "\n Done Refresh Ad RPM";
        // $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
