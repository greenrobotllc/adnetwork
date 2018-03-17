<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adcampaigns4;
use App\Http\Requests\Adcampaigns4Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Adcampaigns4Controller extends Controller {

    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $adcampaigns4s = Adcampaigns4::all();
		return view('adcampaigns4.index', compact('adcampaigns4s'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$adcampaigns4 = Adcampaigns4::findOrFail($id);

		return view('adcampaigns4.show', compact('adcampaigns4'));
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


		return view('adcampaigns4.create');
	}

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  Adcampaigns4Request $request
	 * @return Response
	 */
	public function store(Adcampaigns4Request $request)
	{
		Adcampaigns4::create($request->all());

		return redirect('/adcampaigns4');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$adcampaigns4 = Adcampaigns4::findOrFail($id);

        return view('adcampaigns4.edit', compact('adcampaigns4'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param  Adcampaigns4Request $request
	 * @return Response
	 */
	public function update(Adcampaigns4Request $request, $id)
	{
        $adcampaigns4 = Adcampaigns4::findOrFail($id);
        $adcampaigns4->update($request->all());

        return redirect('/adcampaigns4');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$adcampaigns4 = Adcampaigns4::findOrFail($id);
		$adcampaigns4->delete();

		return redirect('/adcampaigns4');
	}

}
