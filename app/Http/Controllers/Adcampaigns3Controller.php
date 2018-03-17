<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adcampaigns3;
use App\Http\Requests\Adcampaigns3Request;

use Illuminate\Http\Request;

class Adcampaigns3Controller extends Controller {

    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $adcampaigns3s = Adcampaigns3::all();
		return view('adcampaigns3.index', compact('adcampaigns3s'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$adcampaigns3 = Adcampaigns3::findOrFail($id);

		return view('adcampaigns3.show', compact('adcampaigns3'));
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adcampaigns3.create');
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  Adcampaigns3Request $request
	 * @return Response
	 */
	public function store(Adcampaigns3Request $request)
	{
		Adcampaigns3::create($request->all());

		return redirect('/adcampaigns3');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$adcampaigns3 = Adcampaigns3::findOrFail($id);

        return view('adcampaigns3.edit', compact('adcampaigns3'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  Adcampaigns3Request $request
	 * @return Response
	 */
	public function update(Adcampaigns3Request $request, $id)
	{
        $adcampaigns3 = Adcampaigns3::findOrFail($id);
        $adcampaigns3->update($request->all());

        return redirect('/adcampaigns3');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$adcampaigns3 = Adcampaigns3::findOrFail($id);
		$adcampaigns3->delete();

		return redirect('/adcampaigns3');
	}

}
