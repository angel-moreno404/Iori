<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pacientes;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Environment\Console;

class PacientesController extends Controller
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
        return Pacientes::paginate(4);//}
       // $this->authorize('isAdmin');
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
            'nombre'=> 'required|string|max:191',
            'correo'=> 'required|string|email|max:191|unique:pacientes',
                    
        ]);
        
        return Pacientes::create([

            'nombre'=> $request['nombre'],
            'apellido'=> $request['apellido'],
            'cedula'=> $request['cedula'],
            'telefono'=> $request['telefono'],
            'telefono2'=> $request['telefono2'],
            'correo'=> $request['correo'],
            'sexo'=> $request['sexo'],
            'direccion'=> $request['direccion'],
            'tipo'=> $request['tipo'],
            'foto'=> $request['foto'],
            'estado'=> $request['estado'],
           
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
        $user = Pacientes::findOrFail($request->id);
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
        $user = Pacientes::findOrFail($id);

        

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
      
        $user = Pacientes::findOrFail($id);
        //delete user
        $user->delete();
        
        return['massage' => 'User deleted'];

    }

    public function search(Request $request){
  
     if($search = \Request::get('q')){

            $users = Pacientes::where(function($query) use($search){

                $query->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                     ->orWhere('cedula', 'LIKE', "%$search%");
            }) ->paginate(10);
       }else{
        $users=Pacientes::paginate(5);

       }
        return $users;
    
    }

}
