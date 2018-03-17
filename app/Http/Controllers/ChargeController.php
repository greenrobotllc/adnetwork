<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Campaign;
use App\Ad;


class ChargeController extends Controller
{
    //
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
    	//print_r($_REQUEST);
    	$amount = $_REQUEST['amount'];
    	$stripeToken = $_REQUEST['stripeToken'];

    	$charge = Stripe::charges()->create([
    		'source' => $stripeToken,
    		'currency' => 'USD',
    		'amount'   => $amount,
    		]);

    	print_r($charge);
      $user_id = Auth::id();
      $user = User::findOrFail($user_id);
      $amount = $charge['amount'];
      $ad = DB::update(DB::raw("update users set advertiser_balance= advertiser_balance + ? where id = ?"), [(int)$amount, $user_id]);
      
      //find all account_low_balance campaigns and change to active
      $campaigns=Campaign::where('user_id', $user_id)->get();
      //print_r($campaigns);
      foreach($campaigns as $campaign) {
        if($campaign->status == 'account_low_funds') {
        $reportDate = date('Y-m-d', time());


        $c_cost_for_today = DB::select(DB::raw("select report_date, sum(total_cost) total_cost from daily_ad_unit_reports where campaign_id = ? and report_date = ? group by report_date"), [$campaign->id, $reportDate]);
        if(isset($cost_for_today[0])) {
          $campaign_cost_for_today=$c_cost_for_today[0]->total_cost;
        }
        else {
          $campaign_cost_for_today=0;
        }
          //print_r("campaign cost for today $campaign_cost_for_today");

          $ads_approved = Ad::where('campaign_id', $campaign->id)->
          where('status', 'approved');


          $ads = Ad::where('campaign_id', $campaign->id)->get();

          //check for no ads
          if(count($ads) == 0) {
            $campaign->status="no_ads";
            $campaign->save();
          }

          //check if campaign reached budget
          else if($campaign_cost_for_today > $campaign->budget_amount) {
            foreach($ads as $ad) {
              $ad->campaign_status="campaign_reached_budget";
              $ad->save();
            }

            $campaign->status="campaign_reached_budget";
            $campaign->save();
          }


          //check if ads are pending review
          else if (count($ads_approved) == 0) {
            $campaign->status="ads_pending_review";
            $campaign->save();
            foreach($ads as $ad) {
              $ad->campaign_status="ads_pending_review";
              $ad->save();
            }

          }
          else {
            $campaign->status = "active";
            $campaign->save();
            foreach($ads as $ad) {
              $ad->campaign_status="active";
              $ad->save();
            }
          }


          //check if campaign  enabled == 0

          //else set to active
        }
        //$campaign->status
      }
      return redirect('/account?deposited=yes');

    }

}
