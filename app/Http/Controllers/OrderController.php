<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function pedidosActivos()
    {

        // Obtengo todos los registros
        $pending_order = Pedido::orderBy('updated_at', 'asc')->where('estado_pedido_id', '1')->paginate(5);
        $accepted_order = Pedido::orderBy('updated_at', 'asc')->where('estado_pedido_id', '2')->paginate(5);
        $preparing_order = Pedido::orderBy('updated_at', 'asc')->where('estado_pedido_id', '3')->paginate(5);
        $done_order = Pedido::orderBy('updated_at', 'asc')->where('estado_pedido_id', '4')->paginate(5);
        $pending_count = Pedido::where('estado_pedido_id', '1')->count();
        $acceptado_count = Pedido::where('estado_pedido_id', '2')->count();
        $preparando_count = Pedido::where('estado_pedido_id', '3')->count();
        $listo_count = Pedido::where('estado_pedido_id', '4')->count();


        return view('pending.index',  compact('pending_order', 'accepted_order', 'preparing_order', 'done_order', 'pending_count', 'acceptado_count', 'preparando_count', 'listo_count'));
    }

    public function destroy(Pedido $order)
    {
        if ($order->estado_pedido_id == 1) {
            $data = ([
                'estado_pedido_id'          => 5,
                'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by'        => Auth::user()->name,
            ]);
            $order->update($data);
            return redirect('/orders/pending');
        } else {
            return redirect('/orders/pending');
        }
    }

    public function buttonselection(Request $request, $id)
    {

        switch ($request->input('action')) {

            case 'acceptar':
                $data = ([
                    'estado_pedido_id'          => 2,
                    'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by'        => Auth::user()->name,
                ]);
                Pedido::where('id', $id)->update($data);
                break;

            case 'preparando':
                $data = ([
                    'estado_pedido_id'          => 3,
                    'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by'        => Auth::user()->name,
                ]);
                Pedido::where('id', $id)->update($data);
                break;

            case 'listo_para_entregar':
                $data = ([
                    'estado_pedido_id'          => 4,
                    'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by'        => Auth::user()->name,
                ]);
                Pedido::where('id', $id)->update($data);
                break;
            case 'entregado':
                $data = ([
                    'estado_pedido_id'          => 5,
                    'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by'        => Auth::user()->name,
                ]);
                Pedido::where('id', $id)->update($data);
                break;
            case 'rechazar':

                $data = ([
                    'estado_pedido_id'          => 6,
                    'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                    'updated_by'        => Auth::user()->name,
                ]);
                Pedido::where('id', $id)->update($data);
                break;
        }
        return redirect()->back();
    }
}
