<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
     //Función para la funcionalidad de los filtros en el grid.

     public function filter(Request $request)
     {

         //Obtenemos los registros con la información filtrada.
         return Categoria::select(
             'id',
             'nombre',
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
         $create_category = new Categoria([
             "nombre"                => $data["nombre"],
             "estatus"               =>  "ACTIVO",
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
     public function update(Request $request, Categoria $categoria)
     {

         //Obtenemos el objeto dentro del request.
         $request = $request->obj;

         //Agregamos los datos extras al array data.
         $data = ([
             'nombre'          => $request["nombre"],
             'estatus'          => $request["estatus"],
             'updated_at'        => Carbon::now()->setTimezone('UTC'),
             'updated_by'        => Auth::user()->name,
         ]);
         //Actualizamos el registro.
         $categoria->update($data);
         //Retornamos el objeto actualizado.
         return $this->return_record($categoria->id);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Categoria $categoria)
     {
         //array con la información a modificar para poner "cancelado" el registro.
         $data = ([
             'estatus'          => "INACTIVO",
             'updated_at'        => Carbon::now()->setTimezone('UTC'),
             'updated_by'        => Auth::user()->name,
         ]);
         //Actualizamos el registro.
         $categoria->update($data);
         //Retornamos el objeto actualizado.
         return $this->return_record($categoria->id);
     }

     // Esta funcion retorna un formato que acepta el grid al momento de ejecutar los eventos insert,update,delete.
     public function return_record($id)
     {
         return Categoria::select('id','nombre', 'updated_at' ,'estatus')->where("id", "=", $id)->first();
     }
}
