<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sites;
use App\Block;
use App\Widget;
use App\Http\Requests\SitesRequest;
use stdClass;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class SitesController extends Controller {

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
	  $sites = Sites::all();
    $user_id = Auth::id();


        if(Request::get('start') && Request::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Request::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Request::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            return redirect()->action( 'SitesController@index', ['start' => $reportStart, 'end' => $reportEnd]);
            
            

        }


    $start =$reportStart;
    $end =$reportEnd;

      // $reports = DB::table('daily_ad_unit_reports' )
      //             ->leftJoin('sites', 'daily_ad_unit_reports.site_id', '=', 'sites.id' )
      //                ->select(DB::raw('sites.name name, sites.platform, sites.url, sites.approval_status, site_id id, sum(impressions) impressions, sum(clicks) clicks, round(sum(total_costd) * .70) total_cost'))
      //                ->where('publisher_user_id', '=', $user_id)
      //                ->groupBy('site_id')
      //                ->get();
      //                print_r($reports);




$reports = DB::select( DB::raw("select sites.user_id, sites.name name, sites.platform, sites.url, sites.approval_status, sites.id id, sum(impressions) impressions, sum(clicks) clicks, round(sum(total_cost) * .70) total_cost from `sites` left join `daily_ad_unit_reports` on `sites`.`id` =`daily_ad_unit_reports`.`site_id` where daily_ad_unit_reports.report_date BETWEEN :start AND :end and sites.user_id = :user_id group by `site_id`, sites.name, sites.platform, sites.url, sites.approval_status, sites.id, sites.user_id

union 

select sites.user_id, sites.name name, sites.platform, sites.url, sites.approval_status, sites.id id, sum(impressions) impressions, sum(clicks) clicks, round(sum(total_cost) * .70) total_cost from `sites`  left join `daily_ad_unit_reports` on `sites`.`id` =`daily_ad_unit_reports`.`site_id`  and sites.user_id = 1 group by `site_id`, sites.name, sites.platform, sites.url, sites.approval_status, sites.id, sites.user_id
having sites.user_id = :user_id_2 and sites.id not in (select sites.id id from `sites` left join `daily_ad_unit_reports` on `sites`.`id` =`daily_ad_unit_reports`.`site_id` where daily_ad_unit_reports.report_date BETWEEN :start_2 AND :end_2 and sites.user_id = :user_id_3 group by `site_id`, sites.name, sites.platform, sites.url, sites.approval_status, sites.id, sites.user_id
) "), array(
   'user_id' => $user_id,
   'start' => $start,
   'end' => $end,
    'user_id_2' => $user_id,
   'start_2' => $start,
   'end_2' => $end,
   'user_id_3' => $user_id,

 ));


		return view('sites.index', compact('sites', 'reports'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		

    $site = Sites::findOrFail($id);
    //dd($site);

        if(Request::get('start') && Request::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Request::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Request::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            //return redirect()->action( 'SitesController@show', [ 'id'=>"$site->id", 'start' => $reportStart, 'end' => $reportEnd ]);
            
            

        }



    //print_r($site);
//         $reports = DB::table('daily_ad_unit_reports')
//                 ->where('campaign_id', $id)
//                 ->whereBetween('report_date', array($reportStart, $reportEnd))

// ->get();

$reports = DB::table('daily_ad_unit_reports')
                     ->select(DB::raw('sum(impressions) impressions, sum(clicks) clicks, report_date, round(sum(total_cost) * .70) total_cost'))
                     ->where('site_id', '=', $id)
                     ->whereBetween('report_date', [$reportStart, $reportEnd] )
                     ->groupBy('report_date')
                     ->get();
                     //dd($reports);


		return view('sites.show', compact('site', 'reports'));
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$site= new stdClass();
        $site->name="";
        $site->url="";
        $site->platform="";

     	$site->id="";
		return view('sites.create', compact('site'));
	}


	public function targeting($id) {
		//return "targeting";
		$site = Sites::findOrFail($id);
		$blocks = Block::where('site_id', '=', $id)->get();
		return view('sites.targeting', compact('site', 'blocks'));
		
	}
    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  SitesRequest $request
	 * @return Response
	 */
	public function store(SitesRequest $request)
	{
		$request['approval_status']="pending";
   // dd($request->all());
		Sites::create($request->all());

		return redirect('/sites');
	}




    /**
     * Show the content form
     *
     * @return Response
     */
    public function content($id)
    
    {
        //$id = Auth::id();

        //$adcampaigns4 = Adcampaigns4::create(["user_id" > $id]);
        $site = Sites::findOrFail($id);
        $widgets = Widget::where('site_id', '=', $id)->get();
		//$users = User::where('votes', '>', 100)->take(10)->get();
		//print_r($widgets);
		// $date = Date('Y-m-d');



        if(Request::get('start') && Request::get('end')) {
            $reportStart =date('Y-m-d', strtotime(Request::get('start')));
            $reportEnd =date('Y-m-d', strtotime(Request::get('end')));

        }
        else {
            $reportStart = date('Y-m-d', time());
            $reportEnd =date('Y-m-d', time());

            return redirect()->action( 'SitesController@content', ['start' => $reportStart, 'end' => $reportEnd, 'id' => $id]);
            
            

        }


        $from=$reportStart;
        $to=$reportEnd;
        foreach($widgets as $widget) {
        		$impressions = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($from, $to))
                ->where('publisher_widget_id', $widget->id)
                ->sum('impressions');
                $widget->impressions=$impressions;	

                $clicks = DB::table('daily_ad_unit_reports')
                ->whereBetween('report_date', array($from, $to))
                ->where('publisher_widget_id', $widget->id)
                ->sum('clicks');
                $widget->clicks=$clicks;	
        }


        //$ads = Ad::all();
        return view('sites.content', compact('site', 'widgets', 'impressions'));
    }




    /**
     * Show the settings form
     *
     * @return Response
     */
    public function settings($id)
    
    {
        //$id = Auth::id();

        //$adcampaigns4 = Adcampaigns4::create(["user_id" > $id]);
        $site = Sites::findOrFail($id);


        return view('sites.settings', compact('site'));
    }



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$sites = Sites::findOrFail($id);

        return view('sites.edit', compact('sites'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  SitesRequest $request
	 * @return Response
	 */
	public function update(SitesRequest $request, $id)
	{
        $sites = Sites::findOrFail($id);
        $sites->update($request->all());

        return redirect('/sites');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$sites = Sites::findOrFail($id);
		$sites->delete();

		return redirect('/sites');
	}

}
