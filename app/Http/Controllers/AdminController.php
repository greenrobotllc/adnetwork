<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use Illuminate\Support\Facades\Auth;
use App\Campaign;
use App\Sites;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

   //
	function index() {
//		print_r($theDate);
		$uid = Auth::id();
        //return $id;
		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {

			$pending_ads = Ad::where('status', 'pending')->get();
			$approved_ads = Ad::where('status', 'approved')->get();
			$denied_ads = Ad::where('status', 'denied')->get();

			$pending_sites = Sites::where('approval_status', 'pending')->get();
			$approved_sites= Sites::where('approval_status', 'approved')->get();
			$denied_sites = Sites::where('approval_status', 'denied')->get();


			return view('admin.index', compact('pending_ads', 'approved_ads', 'denied_ads', 'pending_sites', 'approved_sites', 'denied_sites'));
		}
		else {
			return "Not authorized";
		}
	}



	/**
	 * Approve ad
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function approve($id)
	{
		$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
			$ad = Ad::findOrFail($id);
			$ad->status="approved";
			$ad->save();

			$campaign=Campaign::findOrFail($ad->campaign_id);
			$campaign_status = $campaign->status;
			if($campaign_status == "ads_pending_review") {
				$campaign->status="active";
				$campaign->save();
			}
			$ad->campaign_status = $campaign->status;
			$ad->save();


			// $pending_ads = Ad::where('status', 'pending')->get();
			// $approved_ads = Ad::where('status', 'approved')->get();
			// $denied_ads = Ad::where('status', 'denied')->get();

			// $pending_sites = Sites::where('approval_status', 'pending')->get();
			// $approved_sites= Sites::where('approval_status', 'approved')->get();
			// $denied_sites = Sites::where('approval_status', 'denied')->get();

		//		header("Location:$url");
		return redirect("/admin");

			//return view('admin.index', compact('pending_ads', 'approved_ads', 'denied_ads'));
		}
		else {
			return "Not authorized";
		}

	}



	/**
	 * Approve ad
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function approvesite($id)
	{
		$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
			$ad = Sites::findOrFail($id);
			$ad->approval_status="approved";
			$ad->save();



			// $pending_ads = Ad::where('status', 'pending')->get();
			// $approved_ads = Ad::where('status', 'approved')->get();
			// $denied_ads = Ad::where('status', 'denied')->get();

			// $pending_sites = Sites::where('approval_status', 'pending')->get();
			// $approved_sites= Sites::where('approval_status', 'approved')->get();
			// $denied_sites = Sites::where('approval_status', 'denied')->get();

		//		header("Location:$url");
		return redirect("/admin");

			//return view('admin.index', compact('pending_ads', 'approved_ads', 'denied_ads'));
		}
		else {
			return "Not authorized";
		}

	}

		/**
	 * Reject ad
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function deny($id)
		{
			$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
				$ad = Ad::findOrFail($id);
				$ad->status="denied";
				$ad->save();


			return redirect("/admin");
			}
			else {
				return "Not authorized";
			}

		}

				/**
	 * Reject site
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function denysite($id)
		{
			$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
				$ad = Sites::findOrFail($id);
				$ad->approval_status="denied";
				$ad->save();


			return redirect("/admin");
			}
			else {
				return "Not authorized";
			}

		}




			/**
	 * Reset ad
	 *
	 * @param  int  $id
	 * @return Response
	 */
			public function reset($id)
			{
				$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
					$ad = Ad::findOrFail($id);
					$ad->status="pending";
					$ad->save();

					return redirect("/admin");

				}
				else {
					return "Not authorized";
				}

			}



			public function resetsite($id)
			{
				$uid = Auth::id();

        //return $id;

		if($uid == env('ADMIN_ID', 'ADMIN_ID')) {
					$ad = Sites::findOrFail($id);
					$ad->approval_status="pending";
					$ad->save();

					return redirect("/admin");

				}
				else {
					return "Not authorized";
				}

			}

		}
