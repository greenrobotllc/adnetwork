<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adcampaigns2;
use App\Http\Requests\Adcampaigns2Request;

use Illuminate\Http\Request;

class Adcampaigns2Controller extends Controller {

    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $adcampaigns2s = Adcampaigns2::all();
		return view('adcampaigns2.index', compact('adcampaigns2s'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$adcampaigns2 = Adcampaigns2::findOrFail($id);

		return view('adcampaigns2.show', compact('adcampaigns2'));
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adcampaigns2.create');
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  Adcampaigns2Request $request
	 * @return Response
	 */
	public function store(Adcampaigns2Request $request)
	{
		Adcampaigns2::create($request->all());

		return redirect('/adcampaigns2');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$adcampaigns2 = Adcampaigns2::findOrFail($id);

        return view('adcampaigns2.edit', compact('adcampaigns2'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  Adcampaigns2Request $request
	 * @return Response
	 */
	public function update(Adcampaigns2Request $request, $id)
	{
        $adcampaigns2 = Adcampaigns2::findOrFail($id);
        $adcampaigns2->update($request->all());

        return redirect('/adcampaigns2');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$adcampaigns2 = Adcampaigns2::findOrFail($id);
		$adcampaigns2->delete();

		return redirect('/adcampaigns2');
	}

}
