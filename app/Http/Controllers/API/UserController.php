<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Cache;
use Auth;
use Session;
use Carbon\Carbon;
// use Notification;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        return response()->json(User::latest()->get());
    }

    public function totalUsers()
    {
        return response()->json(User::count());
    }

    public function totalLogins()
    {
        return response()->json(User::where('candidate_email', '!=',  null)->count());
    }

    public function authuser()
    {
        $id = auth('api')->user()->id;
        return response()->json(User::latest()
            ->where('id', 'LIKE', $id)
            ->first());
    }

    public function protocol()
    {
        $id = auth('api')->user()->id;
        return response()->json(User::latest()
            ->where('id', 'LIKE', 1)
            ->first());
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($request->image) {
            $name = "1" . time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->resize(720, 900)->save(('img/books/') . $name);

            $request->merge(['image' => $name]);
        }

        if (Auth::check()) {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'type' => $request['type'],
                'phone' => $request['phone'],
                'status' => $request['status'],
                'reason' => $request['reason'],
                'image' => $request['image'],
                'department' => $request['department'],
                'password' => Hash::make($request['password']),
                'availability' => 'Offline',
                'user_id' => auth('api')->user()->id,
            ]);
        } else {

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'type' => $request['type'],
                'phone' => $request['phone'],
                'status' => $request['status'],
                'image' => $request['image'],
                'reason' => $request['reason'],
                'department' => $request['department'],
                'password' => Hash::make($request['password']),
                'availability' => 'Offline',
            ]);
        }
        return response()->json([
            'status' => 'User Created',
            'msg' => 'Data Uploaded Successfully!',
            'cod' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
        ]);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
    }
    public function profile()
    {
        return auth('api')->user();
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8'
        ]);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

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
                'status' => 'User Updated',
                'msg' => 'Data Uploaded Successfully!',
                'cod' => 200
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function userOnlineStatus()
    {

        $search = \Request::get('que');
        $users = User::where(function ($query) use ($search) {
            $query->where('availability', 'LIKE', "%$search%");
        })->paginate(20);

        return $users;
    }

    public function userStatus()
    {
        return User::all()->map(function ($user) {
            $user->isOnline = $user->isOnline();
            return $user;
        });
    }


    public function search()
    {
        $search = \Request::get('que');
        $users = User::where(function ($query) use ($search) {
            $query->where('phone', 'LIKE', "%$search%");
            // ->orWhere('name','LIKE',"%$search%");
        })->paginate(20);

        return $users;
    }
}
