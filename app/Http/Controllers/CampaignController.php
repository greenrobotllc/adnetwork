<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Ad;
use App\CampaignCountryG;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\CampaignCountry;
use App\User;
use App\Http\Requests\CampaignRequest;
use App\Block;
use App\CampaignBlock;
use App\TargetOnly;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "Your Campaigns";
        //$campaign = $
        //
        // Get the currently authenticated user's ID...
        $id = Auth::id();
        //echo "Your id: $id";

        if(Input::get('start') && Input::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Input::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Input::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            return redirect()->action( 'CampaignController@index', ['start' => $reportStart, 'end' => $reportEnd]);
            
            

        }



    //$wid =Input::get('wid');
        //$widget = Widget::findOrFail($wid);
        //$publisher_id = $widget->user_id;
            $advertiser_user_id=Auth::id();
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
         else {

            $campaigns = Campaign::where('user_id', $advertiser_user_id)->get();
            foreach($campaigns as $campaign) {
                //$campaign->enabled = 0;
                $campaign->status="active";
                $campaign->save();

                $ads = Ad::where('campaign_id', $campaign->id)->get();
                //dd($ads);
                foreach($ads as $ad) {
                    $ad->campaign_status="active";

                    //$ad->campaign_enabled = 0;
                    $ad->save();
                }
            }
         }

        //$campaigns = Campaign::all();
        // $campaigns = Ad::where('user_id', $advertiser_user_id)->get();

        //$reportStart =Input::get('start');
        //print_r($reportStart);

        // $date = Date('Y-m-d');
        // if($reportDate == "yesterday") {
        //     $date = Date('Y-m-d', strtotime( '-1 days' ));
        //     $to=$date;
        //     $from=$date;
        // }
        // else if($reportDate == "today") {
        //     $date = Date('Y-m-d');
        //     $to=$date;
        //     $from=$date;
        // }
        // else if($reportDate == "this_month") {
        //     $from=Date('Y-m-01');
        //     $to = Date('Y-m-d');
        // }
        // else if($reportDate == "last_month") {
        //     $from=Date('Y-m-d', strtotime('first day of previous month'));
        //     $to = Date('Y-m-d', strtotime('last day of previous month'));
        // }
        // else {
        //     //today
        //     $date = Date('Y-m-d');
        //     $to=$date;
        //     $from=$date; 

        // }
        
        //print_r($reportStart);
        //echo "Today is " . date("Y/m/d", time()) . "<br>";
        foreach($campaigns as $campaign) {
                $impressions = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($reportStart, $reportEnd))
                ->where('campaign_id', $campaign->id)
                ->sum('impressions');
                $clicks = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($reportStart, $reportEnd))
                ->where('campaign_id', $campaign->id)
                ->sum('clicks');

                $cost= DB::table('clicks')
                ->whereBetween('click_date', array($reportStart, $reportEnd))
                ->where('campaign_id', $campaign->id)
                ->sum('cost');
                ///print_r($cost);
                //print_r($campaign);
                //die();
                $campaign->cost=$cost/100;
                $campaign->budget_amount = $campaign->budget_amount/100;
                $campaign->impressions=$impressions;              
                $campaign->clicks=$clicks;              
        }
        return view('campaigns/index', compact('campaigns'));

    }


    /**
     * Show the settings form
     *
     * @return Response
     */
    public function settings($id)
    
    {
        $campaign = Campaign::findOrFail($id);

        //print_r($campaign->start_date);
        
        //$id = Auth::id();
        //$adcampaigns4 = Adcampaigns4::create(["user_id" > $id]);
        $campaign['bid_amount'] = money_format("%i", (float)($campaign['bid_amount']/100));

        $campaign['budget_amount'] = money_format("%i", (float)($campaign['budget_amount']/100));

        return view('campaigns.settings', compact('campaign'));
    }



    /**
     * Show the content form
     *
     * @return Response
     */
    public function content($id)
    
    {
        //return Storage::disk('s3')->url($filename);
        //$id = Auth::id();

        //$adcampaigns4 = Adcampaigns4::create(["user_id" > $id]);
        $campaign = Campaign::findOrFail($id);


        // $reportDate =Input::get('date');

        // $date = Date('Y-m-d');
        // if($reportDate == "yesterday") {
        //     $date = Date('Y-m-d', strtotime( '-1 days' ));
        //     $to=$date;
        //     $from=$date;
        // }
        // else if($reportDate == "today") {
        //     $from= Date('Y-m-d');

        //     $to = Date('Y-m-d');
        // }
        // else if($reportDate == "this_month") {
        //     $from=Date('Y-m-01');
        //     $to = Date('Y-m-d');
        // }
        // else if($reportDate == "last_month") {
        //     $from=Date('Y-m-d', strtotime('first day of previous month'));
        //     $to = Date('Y-m-d', strtotime('last day of previous month'));
        // }
        // else {
        //     //this month
        //     $from=Date('Y-m-01');
        //     $to = Date('Y-m-d');

        // }

        //print_r($from);
        //print_r($to);
        $ads = Ad::all()->where('campaign_id', $id);

        if(Input::get('start') && Input::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Input::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Input::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            return redirect()->action( 'CampaignController@content', ['start' => $reportStart, 'end' => $reportEnd, 'id'=>$campaign->id]);
            
            

        }

        $from = $reportStart;
        $to=$reportEnd;

        foreach($ads as $ad) {
                $impressions = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($from, $to))
                ->where('ad_unit_id', $ad->id)
                ->sum('impressions');
                $ad->impressions=$impressions; 

                $impressions = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($from, $to))
                ->where('ad_unit_id', $ad->id)
                ->sum('impressions');
                $clicks = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($from, $to))
                ->where('ad_unit_id', $ad->id)
                ->sum('clicks');

                $cost= DB::table('clicks')
                ->whereBetween('click_date', array($from, $to))
                ->where('widget_id', $ad->id)
                ->sum('cost');
                ///print_r($cost);
                $ad->cost=$cost/100;
                $ad->impressions=$impressions;              
                $ad->clicks=$clicks;            


        }

        return view('campaigns.content', compact('campaign', 'ads'));
    }




    public function ajax_enable($c) {
        //$cid =Input::get('cid');
        $campaign = Campaign::findOrFail($c);
        $ads = Ad::where('campaign_id', $campaign->id)->get();
        //print_r($ads);
        foreach($ads as $ad) {
            $ad->campaign_enabled=1;
            $ad->save();
        }
        $campaign->enabled=1;
        $campaign->save();
        echo("enabled");
    }
    
    public function ajax_disable($c) {
        //$cid =Input::get('cid');
        $campaign = Campaign::findOrFail($c);
        $ads = Ad::where('campaign_id', $campaign->id)->get();
        print_r($ads);
        foreach($ads as $ad) {
            $ad->campaign_enabled=0;
            $ad->save();
        }

        $campaign->enabled=0;
        $campaign->save();

        echo("disabled");
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $id = Auth::id();


        //$adcampaigns4 = Adcampaigns4::create(["user_id" > $id]);
        $campaign= new stdClass;
        $campaign->name="";
        $campaign->bid_amount="0.01";
        $campaign->budget_amount="10.00";
        $campaign->start_date="";
        $campaign->end_date="";
        $campaign->all_countries=2;
        $campaign->all_devices=2;
        $campaign->desktop_enabled=2;
        $campaign->mobile_enabled=2;
        $campaign->tablet_enabled=2;
        $campaign->all_operating_systems=2;
        $campaign->android_enabled=2;
        $campaign->ios_enabled=2;
        $campaign->countries="";


        return view('campaigns.create', compact('campaign'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        //


        $req=$request->all();
       
        $req['user_id']=  Auth::id();
        if(isset($req['optradio'])) {
            if($req['optradio'] == 'specific') {
                $originalDate = $req['datepicker'];
                $newDate = date('Y-m-d H:i:s', strtotime($originalDate));
                //print_r($newDate);
                //print_r($newDate->format('Y-m-d H:i:s'));
                $req['start_date'] = $newDate;
            }
            else {
                $req['start_date']=date('Y-m-d H:i:s');

            }
        }
        if(isset($req['optradio2'])) {
            if($req['optradio2'] == 'specific') {

                $originalDate = $req['datepicker2'];
      
                $newDate = date('Y-m-d H:i:s', strtotime($originalDate));
       
                $req['end_date'] = $newDate;
      
            }
            else {
                $req['end_date']=null;

            }
        }

        // print_r($req);
        //die();

        if($req['optradiocountry'] == "all") {
            $req['all_countries']=1;
        }
        else {
            $req['all_countries']=0;
        }

        if($req['optradiodevices'] == "specific") {
            $req['all_devices']=0;

        }
        else {
            $req['all_devices']=1;
            $req['desktop']=1;
            $req['mobile']=1;
            $req['tablet']=1;
            $req['android']=1;
            $req['ios']=1;
            $req['all_operating_systems']=1;
            $req['optradioos']=1;
        }

        if(isset($req['desktop'])) {
            $req['desktop_enabled']=1;
        }
        else {
            $req['desktop_enabled']=0;
        }
        
        if(isset($req['mobile'])) {
            $req['mobile_enabled']=1;
        }
        else {
            $req['mobile_enabled']=0;
        }

        if(isset($req['tablet']) ) {
            $req['tablet_enabled']=1;
        }
        else {
            $req['tablet_enabled']=0;
        }


        if(isset($req['optradioos']) ) {

            if($req['optradioos'] =='specific') {
                $req['all_operating_systems']=0;

            }
            else {
                $req['all_operating_systems']=1;
                $req['android']=1;
                $req['ios']=1;
            }
            
        } 
        else { 
            $req['all_operating_systems']=0;
        }
        

        if(isset($req['android'])) {
            $req['android_enabled']=1;
        }
        else {
            $req['android_enabled']=0;
        }

        if(isset($req['ios'])) {
            $req['ios_enabled']=1;
        }
        else {
            $req['ios_enabled']=0;
        }
        $req['bid_amount'] = $req['bid_amount'] * 100;
        $req['budget_amount'] = $req['budget_amount'] * 100;
        $req['bid_range_low']=$req['bid_amount'];
        $req['bid_range_high']=$req['bid_amount'];
        $req['status']='no_ads';           

        if((!isset($req['countries']) || $req['countries'] == null)) {
            $req['countries'] = "all";
        }

        $req['campaign_status']="no_ads";


        //

        Campaign::create($req);

        return redirect('/campaigns');
    }

    public function targeting($id) {
        //return "targeting";
        //$site = Sites::findOrFail($id);
        $blacklist_or_targetonly =Input::get('blacklist_or_targetonly');
        if($blacklist_or_targetonly) {
            //dd($blacklist_or_targetonly);
            if($blacklist_or_targetonly == "blacklist") {
               //print("hi");
                $campaign = Campaign::findOrFail($id);
                $campaign->whitelist_only=0;
                $ads = Ad::where('campaign_id', '=', $id)->get();
                 //dd($ads);
                foreach($ads as $ad) {
                    //dd($ad);
                    $ad->whitelist_only=0;
                    $ad->save();
                }
                $campaign->save();
                $blocks = CampaignBlock::where('campaign_id', '=', $id)->get();
                return view('campaigns.targeting', compact('campaign', 'blocks'));
            }
            else if($blacklist_or_targetonly== "targetonly") {
                //echo "ok";//targeting.targetonly.blade.php
                $campaign = Campaign::findOrFail($id);
                $campaign->whitelist_only=1; 
                $ads = Ad::where('campaign_id', '=', $id)->get();
                foreach($ads as $ad) {
                    $ad->whitelist_only=1;
                    $ad->save();
                }
                $campaign->save();
                $targetonly = TargetOnly::where('campaign_id', '=', $id)->get();
                
                return view('campaigns.targeting_targetonly', compact('campaign', 'targetonly'));

            }

        }
        else {
            //default is blacklist
            $campaign = Campaign::findOrFail($id);
            if($campaign->whitelist_only) {
                $campaign = Campaign::findOrFail($id);
                $targetonly = TargetOnly::where('campaign_id', '=', $id)->get();
                
                return view('campaigns.targeting_targetonly', compact('campaign', 'targetonly'));

            }
            else {
            $campaign = Campaign::findOrFail($id);
            $blocks = CampaignBlock::where('campaign_id', '=', $id)->get();
            return view('campaigns.targeting', compact('campaign', 'blocks'));

            }
  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //

        //dd($campaign);
        // $reportDate =Input::get('date');
   


        // $date = Date('Y-m-d');
        // if($reportDate == "yesterday") {
        //     $date = Date('Y-m-d', strtotime( '-1 days' ));
        //     $to=$date;
        //     $from=$date;
        // }
        // else if($reportDate == "this_month") {
        //     $from=Date('Y-m-01');
        //     $to = Date('Y-m-d');
        // }
        // else if($reportDate == "last_month") {
        //     $from=Date('Y-m-d', strtotime('first day of previous month'));
        //     $to = Date('Y-m-d', strtotime('last day of previous month'));
        // }
        // else {
        //     //this month
        //     $from=Date('Y-m-01');
        //     $to = Date('Y-m-d');

        // }


       // dd($campaign->id);

        if(Input::get('start') && Input::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Input::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Input::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            return redirect()->action( 'CampaignController@show', ['start' => $reportStart, 'end' => $reportEnd, 'campaign' => $campaign]);
            
            

        }


        $from=$reportStart;
        $to=$reportEnd;

        $reports = DB::select(DB::raw("select report_date, sum(impressions) impressions, sum(clicks) clicks from daily_ad_unit_reports where campaign_id = ? and report_date BETWEEN ? AND ? group by report_date"), [$campaign->id, $from, $to]);
        //dd($reports);

                // $reports = DB::table('daily_ad_unit_reports')
                // ->where('campaign_id', $campaign->id)
                // ->whereBetween('report_date', array($from, $to))
                // ->groupBy('report_date')

                // ->get();

                foreach($reports as $report) {

                $cost= DB::table('clicks')
                ->where('click_date', $report->report_date)
                ->where('campaign_id', $campaign->id)
                ->sum('cost');
                //print_r($cost);
                if($cost) {
                    $theCost = $cost;
                }
                else {
                    $theCost = 0;
                }
                ///print_r($cost);
                $report->cost=$theCost/100;
                }

                //print_r($reports);


        return view('campaigns.show', compact('campaign', 'reports', 'cost'));

    }

    //     /**
    // //  * Display the specified resource.
    // //  *
    // //  * @param  int  $id
    // //  * @return Response
    // //  */
    // // public function show($id)
    // // {
    // //     $adcampaigns4 = Adcampaigns4::findOrFail($id);

    // //     return view('adcampaigns4.show', compact('adcampaigns4'));
    // // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $req, Campaign $campaign)
    {
        //
        //$req['bid_amount'] = $req['bid_amount']*100;

        //print_r($req['datepicker']);
        //print_r($req->all());
        $countries = $req['country'];
        // $pieces = explode(",", $countries);
        // //print_r($pieces);
        // $campaign_id = $campaign->id;;
        // foreach($pieces as $country) {
        //    // $params= new stdClass;
        //     $params['country_code'] = $country;
        //     $params['campaign_id'] = $campaign_id;
        //     //var_dump($params);
        //     //print_r($country);
        //     //die();
        //     //$params->name="";
        
        //     if($country != "") {
        //         CampaignCountry::create($params);
        //     }
        // }
                //Campaign::create($req);


        //die();

                //print_r($campaign);
                //die();
                //die();
        $ads = Ad::where('campaign_id', $campaign->id)->get();

        if(isset($req['optradio'])) {
            if($req['optradio'] == 'specific') {
                $originalDate = $req['datepicker'];
                $newDate = date('Y-m-d H:i:s', strtotime($originalDate));
                //print_r($newDate);
                //print_r($newDate->format('Y-m-d H:i:s'));
                $req['start_date'] = $newDate;
            }
            else {
                $req['start_date']=date('Y-m-d H:i:s');

            }
        }

        if(isset($req['optradio2'])) {
            if($req['optradio2'] == 'specific') {

                $originalDate = $req['datepicker2'];
      
                $newDate = date('Y-m-d H:i:s', strtotime($originalDate));
       
                $req['end_date'] = $newDate;
      
            }
            else {
                $req['end_date']=null;

            }
        }


        if($req['optradiocountry'] == "all") {
            $req['all_countries']=1;
            $req['countries'] = "all";
                foreach($ads as $ad) {
                    $ad->countries="all";
                    $ad->all_countries=1;
                    $ad->save();
                }

        }
        else {
            $req['all_countries']=0;
            foreach($ads as $ad) {
                    $ad->countries="";
                    $ad->all_countries=0;
                    $ad->save();
                }
        }

        if($req['optradiodevices'] == "specific") {
            $req['all_devices']=0;
            foreach($ads as $ad) {
                    $ad->all_devices=0;
                    $ad->save();
            }

        }
        else {
            $req['all_devices']=1;
             foreach($ads as $ad) {
                    $ad->all_devices=1;
                    $ad->save();
            }           
        }
        //dd($req['all_devices']);

        if(isset($req['desktop'])) {
            $req['desktop_enabled']=1;
            foreach($ads as $ad) {
                    $ad->desktop_enabled=1;
                    $ad->save();
            }
        }
        else {
            $req['desktop_enabled']=0;
            foreach($ads as $ad) {
                    $ad->desktop_enabled=0;
                    $ad->save();
            }
        }
        
        if(isset($req['mobile'])) {
            $req['mobile_enabled']=1;
            foreach($ads as $ad) {
                    $ad->mobile_enabled=1;
                    $ad->save();
            }
        }
        else {
            $req['mobile_enabled']=0;
            foreach($ads as $ad) {
                    $ad->mobile_enabled=0;
                    $ad->save();
            }
        }

        if(isset($req['tablet'])) {
            $req['tablet_enabled']=1;
            foreach($ads as $ad) {
                    $ad->tablet_enabled=1;
                    $ad->save();
            }
        }
        else {
            $req['tablet_enabled']=0;
            foreach($ads as $ad) {
                    $ad->tablet_enabled=0;
                    $ad->save();
            }
        }


        if(isset($req['optradioos'])) {

            if($req['optradioos'] =='specific') {
                $req['all_operating_systems']=0;
                foreach($ads as $ad) {
                    $ad->all_operating_systems=0;
                    $ad->save();
                }

            }
            else {
                $req['all_operating_systems']=1;
                foreach($ads as $ad) {
                    $ad->all_operating_systems=1;
                    $ad->save();
                }
            }
            
        } 
        else { 
            $req['all_operating_systems']=0;
            foreach($ads as $ad) {
                    $ad->all_operating_systems=0;
                    $ad->save();
                }
        }
        

        if(isset($req['android'])) {
            $req['android_enabled']=1;
            foreach($ads as $ad) {
                    $ad->android_enabled=1;
                    $ad->save();
                }
        }
        else {
            $req['android_enabled']=0;
            foreach($ads as $ad) {
                    $ad->android_enabled=0;
                    $ad->save();
            }
        }

        if(isset($req['ios'])) {
            $req['ios_enabled']=1;
            foreach($ads as $ad) {
                    $ad->ios_enabled=1;
                    $ad->save();
            }
        }
        else {
            $req['ios_enabled']=0;
            foreach($ads as $ad) {
                    $ad->ios_enabled=0;
                    //$ad->save();
            }
        }
        $req['bid_amount'] = $req['bid_amount'] * 100;
        $req['budget_amount'] = $req['budget_amount'] * 100;
        $req['bid_range_low']=$req['bid_amount'];
        $req['bid_range_high']=$req['bid_amount'];
        foreach($ads as $ad) {
                    $ad->bid_amount=$req['bid_amount'];
                    $ad->save();
        }


        //($req->all());
        //die();
        //print("REQUEST<br><br>");
         //print_r($req->all());
         //die();
        //check if campaign budget has been raised if it had been stopped for that reason.
        
        $reportDate = date('Y-m-d', time());

        $c_cost_for_today = DB::select(DB::raw("select report_date, sum(total_cost) total_cost from daily_ad_unit_reports where campaign_id = ? and report_date = ? group by report_date"), [$campaign->id, $reportDate]);
        if(count($c_cost_for_today) > 0) {
          $campaign_cost_for_today=$c_cost_for_today[0]->total_cost;
        
   

        if($campaign->status == 'campaign_reached_budget') {
            if($campaign->budget_amount > $campaign_cost_for_today) {
                $campaign->status='active';
                $ads = Ad::where('campaign_id', $campaign->id)->get();

                foreach($ads as $ad) {
                    if($ad->campaign_status = 'campaign_reached_budget') {
                        $ad->campaign_status="active";
                        $ad->save();
                    }
                }
            }
        }
        }


        $campaign->update($req->all());

  

        $campaigns=Campaign::all();
        return view('campaigns.index', compact('campaigns'));

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
