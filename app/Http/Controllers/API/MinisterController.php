<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Minister;
use Auth;

class MinisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Minister::latest()->get());
    }

    public function store(Request $request)
    {

        $request->merge(['user_id' => auth('api')->user()->id]);

        if ($request->image) {
            $name = "1" . time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->resize(720, 900)->save(('img/books/') . $name);

            $request->merge(['image' => $name]);
        }

        Minister::create($request->all());
        return response()->json([
            'status' => 'Candidate Added',
            'msg' => 'Data Uploaded Successfully!',
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
        $user = Minister::findOrFail($id);

        if (Auth::guard('api')->check())
        {
            // $user = User::findOrFail($id);

            $currentphoto = $user->image;
     
            if ($request->image) {
                if ($request->image != $currentphoto) {
                    $name = "1" . time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
    
                    \Image::make($request->image)->resize(720, 900)->save(('img/books/') . $name);
                    $request->merge(['image' => $name]);
    
                    $userphoto = ('img/books/') . $currentphoto;
                    if (file_exists($userphoto)) {
                        @unlink($userphoto);
                    }
                }
            }
    
            $user->update($request->all());
            return response()->json([
                'status' => 'Candidate Updated',
                'msg' => 'Data Uploaded Successfully!',
                'cod' => 200
            ]);
        }

        // $user->update($request->all());
        // return response()->json([
        //     'status' => 'Candidate Updated',
        //     'msg' => 'Data Uploaded Successfully!',
        //     'cod' => 200
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Minister::findOrFail($id);
        $user->delete();
    }
}
