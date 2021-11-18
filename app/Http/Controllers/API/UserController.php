<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('api');
    }

    public function index()
    {
        return User::paginate(17);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users',
            'password'=> 'required|string|min:6',          
        ]);
        
        return User::create([

            'name'=> $request['name'],
            'email'=> $request['email'],
            'password' => Hash::make ($request['password']),
            'bio'=> $request['bio'],
            'photo'=> $request['photo'],
            'type'=> $request['type'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail($request->id);
        /*$user= auth('api')->user();
        dd($request->photo);
        $currentPhoto = $user->photo;*/
        //return['massage'=>"Success"];
        //this is the validations
        $this->validate($request, [
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=> 'sometimes|required|string|min:6',
        ]);

        if ($request->photo){
            
            $name= time().'.' .explode('/',explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name); 

            $request->merge(['photo' => $name]);

        };

        if(!empty($request->password)){
            $request->merge([ 'password'=> Hash::make ($request['password'])]);
        }

        $user->update($request->all());
        return['message'=>"success"];

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
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=> 'sometimes|string|min:6',
        ]);

        $user->update($request->all());
        return ['massage'=> 'update the user'];
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
        //delete user
        $user->delete();
        
        return['massage' => 'User deleted'];

    }
}
