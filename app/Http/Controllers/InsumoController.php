<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsumoController extends Controller
{
   //Función para la funcionalidad de los filtros en el grid.

   public function filter(Request $request)
   {

       //Obtenemos los registros con la información filtrada.
       return Insumo::select(
           'id',
           'nombre',
           'precio',
           'estatus',
           'updated_at',
           'updated_by'
       )
            ->Where('nombre', 'like', '%' . $request->filter["nombre"]. '%')->get();


   }

   public function show()
   {


   }



   public function store(Request $request)
   {

       //recupero los datos del request, especificamente del atributo obj.
       $data = $request->obj;

       //creo un nuevo objeto del modelo con los datos del request y datos del usuario logeado
       $create_category = new Insumo([
           "nombre"                => $data["nombre"],
           "estatus"               =>  "ACTIVO",
           "precio"                => $data["precio"],
           "created_by"            => Auth::user()->name,
           'updated_by'            => Auth::user()->name,
       ]);

       //guardo el objeto creado del modelo
       $create_category->save();

       //retorno el id del objeto guardado en la bd.
       return $this->return_record($create_category->id);

   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Insumo $insumo)
   {

       //Obtenemos el objeto dentro del request.
       $request = $request->obj;

       //Agregamos los datos extras al array data.
       $data = ([
           'nombre'          => $request["nombre"],
           'estatus'          => $request["estatus"],
           "precio"                => $request["precio"],
           'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
           'updated_by'        => Auth::user()->name,
       ]);
       //Actualizamos el registro.
       $insumo->update($data);
       //Retornamos el objeto actualizado.
       return $this->return_record($insumo->id);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Insumo $insumo)
   {
       //array con la información a modificar para poner "cancelado" el registro.
       $data = ([
           'estatus'          => "INACTIVO",
           'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
           'updated_by'        => Auth::user()->name,
       ]);
       //Actualizamos el registro.
       $insumo->update($data);
       //Retornamos el objeto actualizado.
       return $this->return_record($insumo->id);
   }

   // Esta funcion retorna un formato que acepta el grid al momento de ejecutar los eventos insert,update,delete.
   public function return_record($id)
   {
       return Insumo::select('id','nombre', 'precio', 'updated_at' ,'estatus')->where("id", "=", $id)->first();
   }
}
