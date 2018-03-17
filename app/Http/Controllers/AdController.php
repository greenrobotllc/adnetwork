<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ad;
use App\Click;
use App\Widget;
use App\Sites;
use App\User;
use App\Campaign;
use App\DailyAdUnitReport;
use App\Http\Requests\AdsRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AdController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $ads = Ad::all();
		return view('ads.index', compact('ads'));
	}



    public function ajax_enable($c) {
        //$cid =Input::get('cid');
        $ad = Ad::findOrFail($c);
        //$ads = Ad::where('campaign_id', $campaign->id)->get();
        //print_r($ads);
        // foreach($ads as $ad) {
        //     $ad->campaign_enabled=1;
        //     $ad->save();
        // }
        $ad->enabled=1;
        $ad->save();
        echo("enabled");
    }
    
    public function ajax_disable($c) {
        //$cid =Input::get('cid');
        $ad = Ad::findOrFail($c);
        // $ads = Ad::where('campaign_id', $campaign->id)->get();
        // print_r($ads);
        // foreach($ads as $ad) {
        //     $ad->campaign_enabled=0;
        //     $ad->save();
        // }

        $ad->enabled=0;
        $ad->save();

        echo("disabled");
    }




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ad = Ad::findOrFail($id);

		return view('ads.show', compact('ad'));
	}

	

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		        //$term = Input::get('term', false);

		$cid =Input::get('cid');
		$campaign = Campaign::findOrFail($cid);
		$ad = new \stdClass();
		$ad->campaign_id=$cid;
		$ad->url="";
		$ad->headline="";
		$ad->brand_name="";

		return view('ads.create', compact('campaign', 'ad'));
	}




    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  AdsRequest $request
	 * @return Response
	 */
	public function store(AdsRequest $request)
	{
		$request['user_id']=  Auth::id();

		$path = $request->file('image')->store('images', 's3');
		$request['image_url']=  $path;
		$request['enabled']=  true;
		$request['status']= "pending";
		$cid=$request['campaign_id'];
		$campaign=Campaign::findOrFail($cid);
		$campaign_status = $campaign->status;
		if($campaign_status == "no_ads") {
			$campaign->status="ads_pending_review";
			$campaign->save();
		}
		$request['campaign_enabled'] = $campaign->enabled;
		$request['campaign_status'] = $campaign->status;
		$request['all_countries'] = $campaign->all_countries;
		$request['countries'] = $campaign->countries;
		$request['all_devices'] = $campaign->all_devices;
		$request['desktop_enabled'] = $campaign->desktop_enabled;
		$request['mobile_enabled'] = $campaign->mobile_enabled;
		$request['tablet_enabled'] = $campaign->tablet_enabled;
		$request['all_operating_systems'] = $campaign->all_operating_systems;
		$request['android_enabled'] = $campaign->android_enabled;
		$request['ios_enabled'] = $campaign->ios_enabled;
		$request['bid_amount'] = $campaign->bid_amount;
		$ad = Ad::create($request->all());
		// dd($ad);

  //       $db = DailyAdUnitReport::firstOrNew(['ad_unit_id'=>$ad->id, 'report_date'=>$date, 'publisher_widget_id' => $wid,
		// 		'campaign_id'=> $ad->campaign_id, 'site_id' =>$site_id, 'publisher_user_id' => $publisher_user_id, 'advertiser_user_id' => $advertiser_user_id]);


		return redirect("/campaigns/$cid/content");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ad = Ad::findOrFail($id);
		$campaign_id=$ad->campaign_id;
		$campaign=Campaign::findOrFail($campaign_id);

        return view('ads.edit', compact('ad', 'campaign'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  AdsRequest $request
	 * @return Response
	 */
	public function update(AdsRequest $request, $id)
	{
		print_r($request->all());
		//die();
        $ads = Ad::findOrFail($id);
        if(isset($request['image']) && $request['image'] != "") {
        	//echo("HELLO");
        	$path = $request->file('image')->store('images', 's3');
        	$request['image_url']=  $path;

        }
      	$request['status']=  'pending';

        $ads->update($request->all());
		$cid=$request['campaign_id'];
		
		return redirect("/campaigns/$cid/content");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$ads = Ads::findOrFail($id);
		$cid=$ads->campaign_id;
		$ads->delete();

		return redirect("/campaigns/$cid/content");
	}

}
