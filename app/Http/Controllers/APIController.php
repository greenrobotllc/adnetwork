<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class APIController extends Controller
{
    //
    function publisher_report() {

    	// $id = Auth::id();
    	// if(!)
    	$date = Input::get("date");
    	if(!$date) {
			die("no date parameter");
		}
    	$publisher_user_id = Input::get("user_id");
    	if(!$publisher_user_id) {
    		die("no user_id parameter");
    	}

    	$publisher_api_key =Input::get('publisher_api_key');

        //check if pub api key matches user
        $user = User::findOrFail($publisher_user_id);

        $saved_api_key = $user->api_key;
        //print_r($saved_api_key);
        if($saved_api_key != $publisher_api_key) {
            die("key error");
        }
    	$reports = DB::table('daily_widget_reports')
                     ->select(DB::raw('report_date, widget_id, widgets.name as widget_name, widgets.site_id as site_id, sites.name as site_name, sites.platform as platform, sum(impressions) as impressions, sum(clicks) as clicks, (round(total_revenue * .70))  revenue'))
                      ->join('widgets', 'widgets.id', '=', 'daily_widget_reports.widget_id')
                      ->join('sites', 'sites.id', '=', 'widgets.site_id')

                     ->where('publisher_user_id', '=', $publisher_user_id)
                     ->where('report_date', '=', $date)
                     ->groupBy('widget_id')
                     ->groupBy('report_date')
                     ->groupBy('widgets.name')
                     ->groupBy('impressions')
                     ->groupBy('clicks')
                     ->groupBy('total_revenue')
                     ->groupBy('widgets.site_id')
                     ->groupBy('sites.name')
                     ->groupBy('sites.platform')
                     ->get();

                     foreach($reports as $report) {
                        $amount = $report->revenue;
                        $report->revenue=money_format("%i", $amount/100);
                     }
    
	//    $fp = fopen('file.csv', 'w');
echo "report_date, widget_id, widget_name, site_id, site_name, platform, impressions, clicks, revenue\n";
$out = fopen('php://output', 'w');
foreach($reports as $report) {
	//var_dump($report);
fputcsv($out, get_object_vars($report));
//readfile($out);

}
fclose($out);
// 		foreach ($reports as $fields) {
//     		fputcsv($fp,get_object_vars($fields));
// 		}

// 		fclose($fp);
// //		return $fp;
// 	return response($fp)
//             ->withHeaders([
//                 'Content-Type' => "text/csv"
         
//             ]);



		//return view('api.publisher_report', compact('reports'));

    }
}
