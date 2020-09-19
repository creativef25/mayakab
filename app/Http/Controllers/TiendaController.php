<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TiendaController extends Controller
{


  public function __construct(){
    if(!\Session::has('cart')) \Session::put('cart', array());
  }

  public function index(){

    $produ = DB::table('productos')->take(3)
                                  ->get();

    return view('tienda.index', compact('produ'));
  }

  public function showCarrito(){
    $prods =  \Session::get('cart');
    $total = $this->total();
    return view('tienda.carrito', compact('prods', 'total'));
  }

  public function addProducto($pro){

    $tien = \Session::get('cart');
    $pro->cantidad = 1;
    $tien[$pro->id] = $pro;

    \Session::put('cart', $tien);

    return redirect()->route('showCarrito');
  }

  public function eliminarProducto($pro){
    $tien = \Session::get('cart');
    unset($tien[$pro->id]);
    \Session::put('cart', $tien);
    return redirect()->route('showCarrito');
  }

  public function actualizarCantidad($pro, $cant){
    $tien = \Session::get('cart');
    $tien[$pro->id]->cantidad = $cant;
    \Session::put('cart', $tien);
    return redirect()->route('showCarrito');
  }

  private function total(){
    $tien = \Session::get('cart');
    $total = 0;
    foreach ($tien as $value) {
      $total += $value->precio * $value->cantidad;
    }

    return $total;
  }

  public function checkout(){
    $prods = \Session::get('cart');
    $total = $this->total();
    //dd($prods);

     return view('tienda.checkout', compact('prods', 'total'));
  }

  public function nosotros(){
    return view('tienda.nosotros');
  }

  public function contacto(){
    return view('tienda.contacto');
  }

  public function guardarPedido(Request $re){

    $nomComp = $re->nombre." ".$re->apellidos;
    $direc = $re->direccion." Referencias: ".$re->referencia;
    $esta = $re->estado;
    $copo = $re->cp;
    $correo = $re->correo;
    $tel = $re->telefono;
    $envio = $re->envio;
    $tien = \Session::get('cart');
    $fecha = date('Y-m-d H:i:s');

    if (empty($re->file('imagen'))) {
      $pago = "tarjeta";
      dd($tien);
    }else {
      $pago = "deposito";
      $archivo = $re->file('imagen');
      $nombre_img = $archivo->getClientOriginalName();
      \Storage::disk('local')->put($nombre_img, \File::get($archivo));
    }

    foreach ($tien as $value) {
      DB::table('pedidos')->insert([
                                    'nombre_completo' => $nomComp,
                                    'direccion_envio' => $direc,
                                    'estado' => $esta,
                                    'cp' => $copo,
                                    'correo_electronico' => $correo,
                                    'telefono' => $tel,
                                    'producto' => $value->nombre,
                                    'cantidad' => $value->cantidad,
                                    'costo_envio' => $envio,
                                    'fecha' => $fecha,
                                    'tipo_pago' => $pago,
                                    'imagen' => $nombre_img
                                  ]);
    }

    return redirect()->route('tienda');

  }


}
