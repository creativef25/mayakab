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
    return view('tienda.carrito', compact('prods'));
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
    $tien[$pro->id]->cantidad = $cantidad;
    \Session::put('cart', $tien);
    return redirect()->route('showCarrito');
  }


}
