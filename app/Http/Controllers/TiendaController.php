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


}
