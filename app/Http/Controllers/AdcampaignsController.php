<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adcampaigns;
use App\Http\Requests\AdcampaignsRequest;

use Illuminate\Http\Request;

class AdcampaignsController extends Controller {

    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $adcampaigns = Adcampaigns::all();
		return view('adcampaigns.index', compact('adcampaigns'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$adcampaigns = Adcampaigns::findOrFail($id);

		return view('adcampaigns.show', compact('adcampaigns'));
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adcampaigns.create');
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  AdcampaignsRequest $request
	 * @return Response
	 */
	public function store(AdcampaignsRequest $request)
	{
		Adcampaigns::create($request->all());

		return redirect('/adcampaigns');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$adcampaigns = Adcampaigns::findOrFail($id);

        return view('adcampaigns.edit', compact('adcampaigns'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  AdcampaignsRequest $request
	 * @return Response
	 */
	public function update(AdcampaignsRequest $request, $id)
	{
        $adcampaigns = Adcampaigns::findOrFail($id);
        $adcampaigns->update($request->all());

        return redirect('/adcampaigns');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$adcampaigns = Adcampaigns::findOrFail($id);
		$adcampaigns->delete();

		return redirect('/adcampaigns');
	}

}
