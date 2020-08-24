<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function productos(){

      $produ = DB::table('productos')->get();

      return view('adminis.productos', compact('produ'));
    }

    public function productosGuardar(Request $re){

      $file = $re->file('imagen');

      $nombre = $file->getClientOriginalName();

      \Storage::disk('local')->put($nombre, \File::get($file));

      DB::table('productos')->insert(['nombre' => $re->nombre,
                                      'descripcion' => $re->descripcion,
                                      'precio' => $re->precio,
                                      'cantidad' => $re->cantidad,
                                      'nombre_imagen' => $nombre]);

      return redirect()->route('productos');

    }
}
