<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Widget;
use App\Sites;
use App\Http\Requests\WidgetRequest;
use stdClass;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{
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
        $widgets = Widget::all();
        return view('widget.index', compact('widgets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $widget = Widget::findOrFail($id);
        $user_id = Auth::id();
        if ($widget->user_id != $user_id) {
            exit("Not authorized");
        }
        
        //dd($widget);
        return view('widget.show', compact('widget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $widget= new stdClass();
        $widget->name = "";
        $sid =Request::get('sid');
        $site = Sites::findOrFail($sid);


        return view('widget.create', compact('widget', 'site'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  WidgetRequest $request
     * @return Response
     */
    public function store(WidgetRequest $request)
    {
        $request['user_id']=  Auth::id();
        $sid =Request::get('sid');
        //return $sid;
        $request['site_id']=$sid;
        Widget::create($request->all());

        return redirect("/sites/$sid/content");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $widget = Widget::findOrFail($id);
        $user_id = Auth::id();
        if ($widget->user_id != $user_id) {
            exit("Not authorized");
        }
        return view('widget.edit', compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  WidgetRequest $request
     * @return Response
     */
    public function update(WidgetRequest $request, $id)
    {
		$widget = Widget::findOrFail($id);
		$user_id = Auth::id();
        if ($widget->user_id != $user_id) {
            exit("Not authorized");
        }
        $widget->update($request->all());

        return redirect('/widget');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		$widget = Widget::findOrFail($id);
		$user_id = Auth::id();
        if ($widget->user_id != $user_id) {
            exit("Not authorized");
        }
        $widget->delete();

        return redirect('/widget');
    }
}
