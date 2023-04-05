<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Pacientes;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Environment\Console;

class SalaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {/* 
        dd('aqui toy0');
        $datos = salas::get()->paginate(5);
        dd('aqui toy1',$datos);
        return $datos; */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        dd('aqui voy11',$request);
        salas::create([
            'nombre_sala' => $request['nombre_sala'],
            'admin_sala' => $request['admin_sala'],
        ]);
        return response('Creación exitosa', 200);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseChannelStoreRequest $request)
    {
        PurchaseChannel::create([
            'nombre' => $request['nombre'],
        ]);
        return response('Creación exitosa', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseChannel  $purchaseChannel
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseChannel $purchaseChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseChannel  $purchaseChannel
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseChannel $purchaseChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseChannel  $purchaseChannel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $canal = PurchaseChannel::findOrFail($id);
        $this->validate($request,[
            'nombre' => 'required|string|max:15|unique:purchase_channels,nombre,'.$canal->id,
        ]);
        $canal->update($request->all());
        return response('Actualización exitosa', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseChannel  $purchaseChannel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseChannel::find($id)->delete();
        return response('Canal borrado exitosamente', 200);
    }
    // 

    public function search()
    {
        // dd("here i am");
       if ($search = \Request::get('q')) {
           $canal = PurchaseChannel::where(function($query) use ($search){
            $query
                ->Where('nombre', 'ilike', "%$search%");
           })
           ->orderBy('id')->paginate(5);
       }else{
        $canal = PurchaseChannel::latest()->paginate(5);
       }
       return $canal;
    }

}
