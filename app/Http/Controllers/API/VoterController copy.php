<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\SendMail;
use App\Mail\VoteMail;
use App\Voter;
use App\User;
use Carbon\Carbon;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Voter::latest()->get());
    }

    public function store(Request $request)
    {


        if (Auth::guard('api')->check())
        {
            $request->merge(['user_id' => auth('api')->user()->id]);


            if ($request->image) {
                $name = "1" . time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
    
                \Image::make($request->image)->resize(720, 1280)->save(('img/books/') . $name);
    
                $request->merge(['image' => $name]);
            }
    
    
            Voter::create($request->all());
            return response()->json([
                'status' => 'Voter Added',
                'msg' => 'Data Uploaded Successfully!',
                'cod' => 200
            ]);
        }

    }

    public function voted(Request $request)
    {

        if (Auth::guard('api')->check())
        {
            $user = User::findOrFail(auth('api')->user()->id);

            $currentphoto = $user->image;
     
            if ($request->image) {
                if ($request->image != $currentphoto) {
                    $name = "1" . time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
    
                    \Image::make($request->image)->resize(720, 1280)->save(('img/books/') . $name);
                    $request->merge(['image' => $name]);
    
                    $userphoto = ('img/books/') . $currentphoto;
                    if (file_exists($userphoto)) {
                        @unlink($userphoto);
                    }
                }
            }
    
        
            $user->update([
                'candidate_email' => $request['email'],
                'voted_to' => $request['email'],
                'voted_time' => Carbon::now()
            ]);
    
            return response()->json([
                'status' => 'Notification sent',
                'msg' => 'Notification Sent Successfully!',
                'cod' => 200
            ]);
        }

    }

    public function notification(Request $request)
    {
        // $customer = \DB::table('customers')
        //     ->where('phone', 'LIKE', "$request->customer_phone")
        //     ->first();

        // $to =  $customer->email;
        // $email = auth('api')->user()->email;
        $mail_list = array('vedsenmanik@gmail.com', 'cs.saurabh05@gmail.com', 'praveenemalid@gmail.com',);

        $data = array(
            'description' => $request->description,
            // 'link' => $request->link,
        );
        Mail::to($mail_list)->send(new SendMail($data));

        return response()->json([
            'status' => 'Notification sent',
            'msg' => 'Notification Sent Successfully!',
            'cod' => 200
        ]);
    }

    public function show($id)
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
        $user = Voter::findOrFail($id);

        $user->update($request->all());
        return response()->json([
            'status' => 'User Updated',
            'msg' => 'Data Uploaded Successfully!',
            'cod' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Voter::findOrFail($id);
        $user->delete();
    }
}
