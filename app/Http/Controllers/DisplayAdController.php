<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Widget;
use App\Sites;
use App\DailyAdUnitReport;
use App\DailyWidgetReport;
use App\Ad;
use App\Campaign;
use App\Click;
use App\User;

class DisplayAdController extends Controller
{
    //



	public function random()
	{
		//DB::enableQueryLog();
		// At start of script
		$time_start = microtime(true); 



		$agent = new Agent();

		$isMobile = $agent->isMobile();
		$isTablet = $agent->isTablet();
		$isDesktop = $agent->isDesktop();
		$isAndroid = $agent->isAndroid();
		$isiOS = $agent->isiOS();
		
        //print_r($agent->platform());
		if($agent->platform() == "AndroidOS") {
    		$isAndroid=true;
		}
		if($agent->platform() == "iOS") {
    		$isiOS=true;
		}
		//print_r($isTablet);
		//print_r($agent->platform());
		//echo("is mobile: $isMobile; is tablet: $isTablet; is desktop: $isDesktop; is android: $isAndroid is ios : $isiOS" . $agent->platform());

		//dd(geoip());
		$g=geoip();
		//print_r($g['iso_code']);
		//dd($g->getLocation()['iso_code']);
		$iso = strtolower($g->getLocation()['iso_code']);
		//echo $iso;
		$wid =Request::get('wid');
		$widget = Widget::findOrFail($wid);
		//$publisher_id = $widget->user_id;
			$advertiser_user_id=$widget->user_id;
	       	 $advertiser_user = User::findOrFail($advertiser_user_id);

			 if($advertiser_user->advertiser_balance < 100) {
           	 //echo("under");
       	 	//disable all advertiser's ads and campaigns
       	 	$campaigns = Campaign::where('user_id', $advertiser_user_id)->get();
       	 	foreach($campaigns as $campaign) {
       	 		//$campaign->enabled = 0;
       	 		$campaign->status="account_low_funds";
       	 		$campaign->save();

       	 		$ads = Ad::where('campaign_id', $campaign->id)->get();
       	 		//dd($ads);
       	 		foreach($ads as $ad) {
       	 			$ad->campaign_status="account_low_funds";

       	 			//$ad->campaign_enabled = 0;
       	 			$ad->save();
       	 		}
       	 	}
       	 	//dd($campaigns);
       	 }

		//print_r($wid);
		$ad =0;
		if($isDesktop) {


		 $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select blocks.campaign_id as campaign_id from blocks where blocks.site_id = ?)  and campaign_id not in(select campaign_blocks.campaign_id as campaign_id from campaign_blocks where site_id = '?') and desktop_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) 
		 	union 

select * from ads where status = 'approved' and whitelist_only=1 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id in(select target_onlies.campaign_id as campaign_id from target_onlies where target_onlies.site_id = ?) and desktop_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%'))


		  order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, $iso, $widget->site_id, $iso, $widget->site_id, $iso]);




        }
        else if($isTablet){


        	
        	if($isiOS == 1) {
    //     		//echo("HI");
				// $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select campaign_id from blocks where site_id = ?) and campaign_id not in(select campaign_id from campaign_blocks where site_id = ?) and tablet_enabled = ? and (all_countries=1 or countries like concat('%', ?, '%')) and (all_operating_systems = 1 or ios_enabled = 1) order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, (int)$isTablet, $iso]);

						 $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select blocks.campaign_id as campaign_id from blocks where blocks.site_id = ?)  and campaign_id not in(select campaign_blocks.campaign_id as campaign_id from campaign_blocks where site_id = '?') and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 
		 	union 

select * from ads where status = 'approved' and whitelist_only=1 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id in(select target_onlies.campaign_id as campaign_id from target_onlies where target_onlies.site_id = ?) and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 


		  order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, $iso, $widget->site_id, $iso]);


			}
			else if($isAndroid == 1) {
				// $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select campaign_id from blocks where site_id = ?) and campaign_id not in(select campaign_id from campaign_blocks where site_id = ?) and tablet_enabled = ? and (all_countries=1 or countries like concat('%', ?, '%')) and (all_operating_systems = 1 or android_enabled = 1) 

				// 	order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, (int)$isTablet, $iso]);


				//couldnt test this one


								 $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select blocks.campaign_id as campaign_id from blocks where blocks.site_id = ?)  and campaign_id not in(select campaign_blocks.campaign_id as campaign_id from campaign_blocks where site_id = '?') and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 
		 	union 

select * from ads where status = 'approved' and whitelist_only=1 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id in(select target_onlies.campaign_id as campaign_id from target_onlies where target_onlies.site_id = ?) and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or android_enabled = 1) 


		  order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, $iso, $widget->site_id, $iso]);

			}


        }
        else if($isMobile) {
	//print_r($isMobile);
	//dd($isAndroid);
        	if($isiOS == 1) {

				// $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select campaign_id from blocks  where site_id = ?) and campaign_id not in(select campaign_id from campaign_blocks  where site_id = ?) and mobile_enabled = ? and (all_countries=1 or countries like concat('%', ?, '%')) and (all_operating_systems = 1 or ios_enabled = 1) order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, (int)$isMobile, $iso]);




				$ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select blocks.campaign_id as campaign_id from blocks where blocks.site_id = ?)  and campaign_id not in(select campaign_blocks.campaign_id as campaign_id from campaign_blocks where site_id = '?') and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 
		 	union 

select * from ads where status = 'approved' and whitelist_only=1 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id in(select target_onlies.campaign_id as campaign_id from target_onlies where target_onlies.site_id = ?) and mobile_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 


		  order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, $iso, $widget->site_id, $iso]);


			}
			else if($isAndroid == 1) {
				// $ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select campaign_id from blocks  where site_id = ?)  and campaign_id not in(select campaign_id from campaign_blocks  where site_id = ?) and mobile_enabled = ? and (all_countries=1 or countries like concat('%', ?, '%')) and (all_operating_systems = 1 or android_enabled = 1) order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, (int)$isMobile, $iso]);



				$ad = DB::select(DB::raw("select * from ads where status = 'approved' and whitelist_only=0 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id not in(select blocks.campaign_id as campaign_id from blocks where blocks.site_id = ?)  and campaign_id not in(select campaign_blocks.campaign_id as campaign_id from campaign_blocks where site_id = '?') and tablet_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or ios_enabled = 1) 
		 	union 

select * from ads where status = 'approved' and whitelist_only=1 and campaign_status = 'active' and enabled= 1 and campaign_enabled = 1 and campaign_id in(select target_onlies.campaign_id as campaign_id from target_onlies where target_onlies.site_id = ?) and mobile_enabled = 1 and (all_countries=1 or countries like concat('%', '?', '%')) and (all_operating_systems = 1 or android_enabled = 1) 


		  order by -LOG(RAND())/weight, RAND() limit 1"), [$widget->site_id, $widget->site_id, $iso, $widget->site_id, $iso]);


				//dd($ad);
			}


	
        }
        else {
        	return "not tablet or mobile or desktop";
        }
 
			
			if(!$ad) {
				return "";
			}
			//$campaign_id = 
			
			//$ad = Ad::findOrFail($ad->id);
			//print_r($ad->campaign_id);
			//return;
			$ad = $ad[0];
//
			//dd($ad);
			// Anywhere else in the script

			//print_r(array_keys($ad));
			//$ad = get_object_vars($ad);
			//dd($ad);

			////echo($ad);
			//print_r($wid);
			$widget = Widget::findOrFail($wid);
			//print_r($widget);
			//$platform = $widget->platform;
			//print_r($platform);
			$site_id = $widget->site_id;
			$site = Sites::findOrFail($site_id);
			$platform=$agent->platform();
			//print_r($platform);
			$advertiser_user_id=$widget->user_id;
			$site = Sites::findOrFail($site_id);
			$publisher_user_id=$site->user_id;
            $date = Date('Y-m-d');
		//print_r($date);


            $db = DailyAdUnitReport::firstOrNew(['ad_unit_id'=>$ad->id, 'report_date'=>$date, 'publisher_widget_id' => $wid,
				'campaign_id'=> $ad->campaign_id, 'site_id' =>$site_id, 'publisher_user_id' => $publisher_user_id, 'advertiser_user_id' => $advertiser_user_id]);
            $db->save();
            $db->increment('impressions');
            $db->save();


            $db2 = DailyWidgetReport::firstOrNew(['widget_id'=>$widget->id, 'report_date'=>$date,'site_id' =>$site_id, 'publisher_user_id' => $publisher_user_id]);
            $db2->save();
            $db2->increment('impressions');
            $db2->save();


			//print_r($platform);
			//print_r($ad);
			//todo windows
			//dd(DB::getQueryLog());


            if($platform == 'web' || $platform == 'OS X' || $platform == "Windows") {
			    //echo "hello";
                return view('ads.show_noframe_desktop', compact('ad', 'wid'));
			}
			else if($platform == 'iOS') {
				$isTablet = $agent->isTablet();
				if($isTablet) {
					return view('ads.show_noframe_ipad', compact('ad', 'wid'));

				}
				else {
					return view('ads.show_noframe_iphone', compact('ad', 'wid'));
	
				}

			}
			else if($platform == "AndroidOS") {
                return view('ads.show_noframe_iphone', compact('ad', 'wid'));

			}


			
	}



	public function click() {
		$url =Request::get('url');
		//print_r($url);
		$widget_id =Request::get('wid');
		$ad_id =Request::get('aid');
		//todo increment clicks
		$ad = Ad::findOrFail($ad_id);
		$widget = Widget::findOrFail($widget_id);
		$date = Date('Y-m-d');
        $db = DailyAdUnitReport::firstOrNew(['ad_unit_id'=>$ad_id, 'report_date'=>$date, 'publisher_widget_id' => $widget_id,
				'campaign_id'=> $ad->campaign_id]);
        $db->save();
        $db->increment('clicks');


		$campaign = Campaign::findOrFail($ad->campaign_id);
		// dd($campaign);

		 //TODO: this should be dynamic against the next highest winner.
		$cost = $campaign->bid_amount;

        $db->total_cost = $db->total_cost + $cost;
        $db->save();


    	$db2 = DailyWidgetReport::firstOrNew(['widget_id'=>$widget_id, 'report_date'=>$date,'site_id' =>$widget->site_id, 'publisher_user_id' => $widget->user_id]);
            $db2->save();
            $db2->increment('clicks');
            $db2->save();
        $db2->total_revenue = $db->total_revenue + $cost;
        $db2->save();






		 $publisher_user_id = $campaign->user_id;
		 $widget = Widget::findOrFail($widget_id);
		 $advertiser_user_id = $widget->user_id;



         $ip_address = $_SERVER['REMOTE_ADDR'];

       	 $db = Click::create(['widget_id'=>$widget_id, 
				'ad_id'=> $ad->id, 'cost'=>$cost, 'ip_address' => $ip_address, 'campaign_id' => $ad->campaign_id,			'click_date' => $date, 'publisher_user_id' => $publisher_user_id, 'advertiser_user_id' => $advertiser_user_id]);

       	 //debit advertiser
       	 $advertiser_user = User::findOrFail($advertiser_user_id);
       	 $advertiser_user->advertiser_balance = $advertiser_user->advertiser_balance - $cost;
       	 $advertiser_user->save();
       	 if($advertiser_user->advertiser_balance < 100) {
           	 //echo("under");
       	 	//disable all advertiser's ads and campaigns
       	 	$campaigns = Campaign::where('user_id', $advertiser_user_id)->get();
       	 	foreach($campaigns as $campaign) {
       	 		//$campaign->enabled = 0;
       	 		$campaign->status="account_low_funds";
       	 		$campaign->save();

       	 		$ads = Ad::where('campaign_id', $campaign->id)->get();
       	 		//dd($ads);
       	 		foreach($ads as $ad) {
       	 			$ad->campaign_status="account_low_funds";

       	 			//$ad->campaign_enabled = 0;
       	 			$ad->save();
       	 		}
       	 	}
       	 	//dd($campaigns);
       	 }
       	 else {
           	 //echo("over");
           	 
       	 }

       	 //65% to publisher, 35% for adnetwork
       	 $publisher_user = User::findOrFail($publisher_user_id);
       	 $click_cost = round($cost * .70);
       	 $publisher_user->publisher_balance = $publisher_user->publisher_balance + $click_cost;
       	 $publisher_user->save();
          //  print_r($url);
            //return redirect()->route('login');
		//header("Location:$url");

        return redirect($url);

	}


}
