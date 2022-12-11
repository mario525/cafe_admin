<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ProductoController extends Controller
{
    // Función que retorna todos los banners al index.
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $products = Producto::orderBy('estatus', 'asc')
            ->orderBy('updated_at', 'desc')
            ->get();
        return Response::json([
            'products' => $products
        ]);
    }

    // Función que redirecciona a la vista create
    public function create()
    {
        return view('products.create');
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
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'categoria_id' => $request->categoria,
                'imagen' => "storage/upload/producto/" . $file_name,
                'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
                'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];

            // Inserta el nuevo registro a la BD y obtengo su ID
            $banner = Producto::create($data)->id;

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
    public function show(Producto $product)
    {
        return view('products.show', compact('product'));
    }

    // Función que manda a la vista edit
    public function edit(Producto $product)
    {
        return view('products.edit', compact('product'));
    }

    // Función que actualiza el registro en la BD
    public function update(Request $request, Producto $product)
    {
        // Validación de los campos recibidos
        $request->validate([
            'nombre' => 'required|string',
            // 'subtitle' => 'string',
            // 'thumbnail' => 'required|image',
            // 'url' => 'url',
            // 'validity' => 'string',
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
                @unlink(public_path($product->imagen));
                #Lo guardamos
                $file->move(public_path('storage/upload/producto'), $file_name);

                // Preparo los datos a actualizar
                $data = [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'categoria_id' => $request->categoria,
                    'imagen' => "storage/upload/producto/" . $file_name,
                    'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
                    'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by' => Auth::user()->name
                ];
            } else {
                // Preparo los datos a actualizar
                $data = [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'categoria_id' => $request->categoria,
                    'estatus' => $request->estatus ? 'ACTIVO' : 'INACTIVO',
                    'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by' => Auth::user()->name
                ];
            }
            // ### END Guardar imagen ###


            // Actualiza el registro en la BD
            $product->update($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record updated!'),
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

    // Función que elimina el registro de la BD
    public function destroy(Producto $product)
    {

        try {
            // Prepara los datos a actualizar
            $data = [
                'estatus' => 'INACTIVO',
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];
            // Actualiza el registro a borrado.
            $product->update($data);
            return __('Record disabled!');
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }

    public function getdata(){
         //Obtenemos los registros con la información filtrada.
         return Categoria::all();
    }
}
