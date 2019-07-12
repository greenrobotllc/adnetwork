<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function welcome() {
        return view('welcome');


    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Input::get('start')) {
            $reportStart =date('Y-m-d', strtotime(Input::get('start')));

        }
        else {
            $reportStart = date('Y-m-1', time());

        }

        if(Input::get('end')) {
            $reportEnd =date('Y-m-d', strtotime(Input::get('end')));
        }
        else {
            $reportEnd = date('Y-m-d', time());

        }


        $userId = Auth::id();
        $user=User::find($userId);
        $date = Date('Y-m-d');

        $sql = "select sum(cost) total from clicks where advertiser_user_id = ? and click_date =?";
        $spent_today= DB::select(DB::raw($sql), [$userId, $date])[0]->total;


    $sql = "select sum(cost) total from clicks where publisher_user_id = ? and click_date =?";
        $earned_today= DB::select(DB::raw($sql), [$userId, $date])[0]->total;
         $earned_today = round($earned_today * .70);
         //print_r($earned_today);

        $sql = "select count(*) total from clicks where advertiser_user_id = ? and click_date =?";
        $clicks_today= DB::select(DB::raw($sql), [$userId, $date])[0]->total;

        $sql = "select sum(clicks) total from daily_ad_unit_reports where advertiser_user_id = ? and report_date =?";
        $clicks_today= DB::select(DB::raw($sql), [$userId, $date])[0]->total;

        if(!$clicks_today) {
            $clicks_today = 0;
        }

       $sql = "select sum(impressions) total from daily_ad_unit_reports where advertiser_user_id = ? and report_date =?";
        $impressions_today= DB::select(DB::raw($sql), [$userId, $date])[0]->total;

        if(!$impressions_today) {
            $impressions_today = 0;
        }

        if($impressions_today == 0) {
            (float)$ctr_today = 0.0;

        }
        else {
            (float)$ctr_today = (float)($clicks_today/$impressions_today)*100;
        }
        // $impressions = DB::table('daily_ad_unit_reports')
        //         ->whereBetween('report_date', array($reportStart, $reportEnd))
        //         ->where('publisher_id', $userId)
        //         ->sum('cost');


        return view('home', compact('user', 'spent_today', 'clicks_today', 'ctr_today', 'impressions_today', 'earned_today'));
    }
}
