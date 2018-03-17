<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefreshController extends Controller
{
	public function __construct()
	{
		//$this->middleware('auth');
	}

   //
	function index() {

		//set avg_cpc for daily_ad_unit_reports from clicks
		$theDate = date('Y-m-d');
		$query = "select ad_id, avg(cost) as avg_cpc from clicks where click_date =? group by ad_id";
        $clicks = DB::select(DB::raw($query), [$theDate]);

        foreach($clicks as $click) {
        	print_r($click->ad_id);
        	print_r($click->avg_cpc);
        	//rint_r($click['avg_cpc']);
        	$affected = DB::update("update daily_ad_unit_reports set avg_cpc=? where ad_unit_id = ? and report_date = ?", [$click->avg_cpc, $click->ad_id, $theDate]);
        }

        //set rpm for daily ad unit reports from clicks and impressions from daily_ad_unit_reports
        $sql = "select ad_id, sum(cost) as total_cost, count(cost) number_of_clicks, click_date from clicks where click_date = ? group by click_date, ad_id";
        $clicks = DB::select(DB::raw($sql), [$theDate]);

        foreach($clicks as $click) {
        	$ad_id = $click->ad_id;
        	$total_cost=$click->total_cost;
        	$sql="select impressions from daily_ad_unit_reports where ad_unit_id = ?";
        	$impressions = DB::select(DB::raw($sql), [$ad_id])[0]->impressions;
        	//dd($impressions);
        	$rpm= ($total_cost/$impressions)*1000;
        	echo("rpm: $rpm");

        	$sql = "update daily_ad_unit_reports set rpm=? where ad_unit_id = ? and report_date = ?";
        	$affected = DB::update(DB::raw($sql), [$rpm, $ad_id, $theDate]);

        }

        //set rpm for ads
        $sql="select ad_unit_id, avg(rpm) as avg_rpm from daily_ad_unit_reports group by ad_unit_id";
        $avg_rpms= DB::select(DB::raw($sql));
        foreach($avg_rpms as $avg_rpm_and_id) {
            $avg_rpm=$avg_rpm_and_id->avg_rpm;
            if(!$avg_rpm) {
                //echo("hello bad:");
                //dd($avg_rpm);
                //$avg_rpm=.1;
            }
               print_r($avg_rpm);
            $ad_id=$avg_rpm_and_id->ad_unit_id;
            $sql="update ads set rpm = ? where id = ?";
            $affected = DB::update(DB::raw($sql), [$avg_rpm, $ad_id]);


            print_r($affected);

        }

        //get total weight
        $sql="select sum(rpm) as total_rpm from ads";
        $total_rpm= DB::select(DB::raw($sql))[0]->total_rpm;

        //Total Original RPM per zone is in $total
        if ($total_rpm == 0)
        {
            $total_rpm = 0.1;
        }

        //set weight for each ad
        $sql = "select ads.id as id, rpm, campaigns.bid_amount from ads, campaigns where ads.campaign_id = campaigns.id";
        $rpms= DB::select(DB::raw($sql));

        $avgsql = "select avg(rpm) avgrpm from ads where weight is not null";
        $avgrpm= DB::select(DB::raw($avgsql))[0]->avgrpm;

        //dd($avgweight);
        //dd($rpms);
        
              
        foreach($rpms as $my_rpm) {
            $rpm_value = $my_rpm->rpm;
            $bid_amount = $my_rpm->bid_amount;
            if (is_null($rpm_value) || $rpm_value < 10 )
            {
                //dd("OK!!!");
                $rpm_value = $avgrpm;
                $total_rpm = $total_rpm + $avgrpm - $rpm_value;

            }
            
            $ad_id = $my_rpm->id;
            //dd($rpm_value);

            $weight = (($rpm_value + $bid_amount /$total_rpm) );

            // if($weight == 1.0) {
            //    $weight =.95;
            // }
            //$weight = $weight + ($bid_amount);
           //dd($weight);
           if($weight < .1) {
               $weight=.1;
           }
           // dd($ad_id);//("ok");

            $sql = "update ads set weight = ? where id = ?";
            $affected = DB::update(DB::raw($sql), [$weight, $ad_id]);

        }

        echo "all done";
        //[0]->avg_rpm;

        //dd($clicks);
		//	$ad = DB::select(DB::raw("select * from ads where status = 'approved' and enabled= 1 and campaign_enabled = 1 and desktop_enabled = ? and (all_countries=1 or countries like concat('%', ?, '%')) order by rand() limit 1"), [(int)$isDesktop, $iso]);


        // $clicks = DB::select(DB::raw("select ad_id, avg(cost) from clicks where click_date =? group by ad_id", [$theDate]));
        //print_r($clicks);
            

		return "";
	}



	
}
