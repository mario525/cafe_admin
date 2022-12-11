<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class HistoryController extends Controller
{
   // Función que retorna todos los banners al index.
   public function index()
   {
       // Obtengo todos los registros de la BD ordenados por el más reciente.
       $products = Pedido::join('estado_pedidos', 'estado_pedidos.id', '=', 'pedidos.estado_pedido_id')->orderBy('pedidos.id', 'desc')
       ->select('estado_pedidos.nombre', 'pedidos.*')->get();
       return Response::json([
           'products' => $products
       ]);
   }

   // Función que redirecciona a la vista create
   public function create()
   {
       return view('history.create');
   }

   // Función que almacena el nuevo registro en la BD
   public function store(Request $request)
   {
       // Validación de los campos recibidos
       $request->validate([
           'nombre' => 'required|string',
           // 'subtitle' => 'string',
           'thumbnail' => 'required|image',
           // 'url' => 'url',
           // 'validity' => 'string',
       ]);

       try {
           // ### START Guardar imagen ###
           // Obtenemos el archivo del request
           $file = $request->file('thumbnail');
           // Creamos el nombre del archivo
           $file_name = date('YmdHi') . '_producto_' . $file->getClientOriginalName();
           // Lo guardamos
           $file->move(public_path('storage/upload/producto'), $file_name);
           ### END Guardar imagen ###

           // Preparo los datos a agregar
           $data = [
               'name' => $request->nombre,
               'lastname' => $request->apellidos,
               'phone' => $request->telefono,
               'cedula' => $request->matricula,
               'email' => $request->correo,
               'rol_id' => $request->rol,
               'password' => bcrypt('password'),
               'profile_photo_path' => "storage/upload/producto/" . $file_name,
               'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
               'created_by' => Auth::user()->name,
               'updated_by' => Auth::user()->name,
               'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
               'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
           ];

           // Inserta el nuevo registro a la BD y obtengo su ID
           $banner = User::create($data)->id;

           // Alerta de exito
           $notification = array(
               'message' => __('Record created!'),
               'alert-type' => 'success'
           );
           // Retorna a la vista
           return redirect()->route('products')->with($notification);
       } catch (QueryException $e) {
           // Alerta de error
           $notification = array(
               'message' =>  $e->errorInfo[2],
               'alert-type' => 'error'
           );
           // Retorna a la vista
           return redirect()->back()->with($notification);
       }
   }

   // Función que manda a la vista show
   public function show(Pedido $pedido)
   {

       return view('history.show', compact('pedido'));
   }

   // Función que manda a la vista edit
   public function edit(Pedido $pedido)
   {


   }

   // Función que actualiza el registro en la BD
   public function update(Request $request, Pedido $pedido)
   {


       // Validación de los campos recibidos
       $request->validate([
           'nombre' => 'required|string',

       ]);

       try {
           // ### START Guardar imagen ###
           // Obtenemos el archivo del request
           $file = $request->file('thumbnail');

           $file_name = "";
           #Revisa si se modifico la imagen y pone la nueva, si no deja la que estaba
           if (isset($file)) {
               #Creamos el nombre del archivo
               $file_name = date('YmdHi') . '_producto_' . $file->getClientOriginalName();
               #Borramos la foto anterior
               @unlink(public_path($pedido->imagen));
               #Lo guardamos
               $file->move(public_path('storage/upload/producto'), $file_name);

               // Preparo los datos a actualizar
               $data = [
                   'name' => $request->nombre,
                   'lastname' => $request->apellidos,
                   'phone' => $request->telefono,
                   'cedula' => $request->matricula,
                   'email' => $request->correo,
                   'rol_id' => $request->rol,
                   'profile_photo_path' => "storage/upload/producto/" . $file_name,
                   'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
                   'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                   'updated_by' => Auth::user()->name
               ];
           } else {
               // Preparo los datos a actualizar
               $data = [
                   'name' => $request->nombre,
                   'lastname' => $request->apellidos,
                   'phone' => $request->telefono,
                   'cedula' => $request->matricula,
                   'email' => $request->correo,
                   'rol_id' => $request->rol,
                   'profile_photo_path' => "storage/upload/producto/" . $file_name,
                   'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
                   'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                   'updated_by' => Auth::user()->name
               ];
           }
           // ### END Guardar imagen ###


           // Actualiza el registro en la BD
           $pedido->update($data);

           // Alerta de exito
           $notification = array(
               'message' => __('Record updated!'),
               'alert-type' => 'success'
           );
           // Retorna a la vista
           return redirect('/usuarios-detalles')->with($notification);
       } catch (QueryException $e) {
           // Alerta de error
           $notification = array(
               'message' =>  $e->errorInfo[2],
               'alert-type' => 'error'
           );
           // Retorna a la vista
           return redirect('/usuarios-detalles')->with($notification);
       }
   }

   // Función que elimina el registro de la BD
   public function destroy(Pedido $pedido)
   {

       try {
           // Prepara los datos a actualizar
           $data = [
               'estatus' => 'INACTIVO',
               'updated_by' => Auth::user()->name,
               'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
           ];
           // Actualiza el registro a borrado.
           $pedido->update($data);
           return __('Record disabled!');
       } catch (QueryException $e) {
           return $e->errorInfo[2];
       }
   }

}
