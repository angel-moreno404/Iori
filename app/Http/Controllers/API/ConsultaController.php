<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Environment\Console;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('api');
       //$this->authorize('isAdmin');
    }

    public function index()
    {   
        //dd(Gate::allows('isAdmin'));
      //if (Gate::allows('isAdmin') || Gate::allows('isAuthor')){
        
        return User::paginate(4);//}
        $this->authorize('isAdmin');
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
        $currentPhoto = $user->photo;
        $this->validate($request, [
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=> 'sometimes|required|string|min:6',
        ]);

        if ($request->photo){
            
            $name= time().'.' .explode('/',explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name); 

            $request->merge(['photo' => $name]);

            $userPhoto= public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){

                @unlink($userPhoto);

            }

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

        if(!empty($request->password)){
            $request->merge([ 'password'=> Hash::make ($request['password'])]);
            
           
        }

        $user->update($request->all());
        return ['massage'=> 'update the user'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {   
      //$this->authorize('isAdmin');
      
        $user = User::findOrFail($id);
        //delete user
        $user->delete();
        
        return['massage' => 'User deleted'];

    }

   /* public function search(Request $request){
        
       
       
        return['massage'=> 'User deleted'];
       
       
         dd("hola aqui toy");
  
     if($search = \Request::get('q')){
            
            $users = User::where(function($query) use($search){

                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                     ->orWhere('type', 'LIKE', "%$search%");
            }) ->paginate(10);
            
       }else{
        $users=User::paginate(5);
        

       }
        return $users;
    
    }*/
    public function search($search){
        


        $cargos=User:: where('name', 'LIKE', "%$search%")
        ->orWhere('email', 'LIKE', "%$search%")
         ->orWhere('type', 'LIKE', "%$search%") ->orderBy('id')->paginate(10);
        
        
        if(!$cargos->isEmpty()){
                
                    return $cargos;
                }
                else{
              
                return User::orderBy('id')->paginate(10);
        
        
                }

            } 
}
