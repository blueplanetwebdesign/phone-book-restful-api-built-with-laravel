<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Auth;
use DB;

use App\Models\PhoneBook;

class PhoneBookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $data = PhoneBook::where('user_id', '=', $user_id)
            ->get();

        return Response::json(array(
            'error' => false,
            'data' => $data,
            'status_code' => 200
        ), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:phone_book,email',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'error' => false,
                'error_reason' => $validator->errors(),
                'status_code' => 422
            ), 422);
        }

        $phone_book = new PhoneBook;
        $phone_book->fill($request->all());
        $phone_book->user_id = Auth::user()->id;
        $phone_book->save();

        return Response::json(array(
            'error' => false,
            'data' => $request->get('email'),
            'status_code' => 200
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;

        $data = PhoneBook::where('user_id', '=', $user_id)
            ->where('email', '=', $id)
            ->get();

        return Response::json(array(
            'error' => false,
            'data' => $data,
            'status_code' => 200
        ), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "required|unique:phone_book,email,$user_id,user_id",
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'error' => false,
                'error_reason' => $validator->errors(),
                'status_code' => 422
            ), 422);
        }

        PhoneBook::where('email', '=', $request->get('email'))
            ->where('user_id', '=', $user_id)
            ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone_number' => $request->phone_number
            ]);

        return Response::json(array(
            'error' => false,
            'data' => $request->get('email'),
            'status_code' => 200
        ), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        $user_id = Auth::user()->id;

        $affectedRows = PhoneBook::where('user_id', '=', $user_id)->where('email', '=', $email)->delete();

        if($affectedRows){
            return Response::json(array(
                'error' => false,
                'delete_success' => true,
                'status_code' => 200
            ), 200);
        }
        else{
            return Response::json(array(
                'error' => false,
                'delete_success' => false,
                'status_code' => 200
            ), 200);
        }
    }
}
