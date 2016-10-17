<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Redirect;
use DB;

class ApiControlPanelController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        return view('api_control_panel', ['data' => User::find($user_id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_token = str_random(255);
        $user_id = Auth::user()->id;

        $model = ApiControlPanel::find($user_id);
        $model->api_token = bcrypt(str_random(30));

        $model->save();

        return Redirect::back();
    }


}
