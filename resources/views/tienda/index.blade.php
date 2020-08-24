@extends('indexT')
@section('container')

  <div class="owl-carousel hero-slide owl-style">
    <div class="intro-section container" style="background-image: url('{{ asset('tienda/images/hero_1.jpg')}}');">
      <div class="row justify-content-center text-center align-items-center">
        <div class="col-md-8">
          <span class="sub-title">Royal Wine</span>
          <h1>Grape Wine</h1>
        </div>
      </div>
    </div>
    <div class="intro-section container" style="background-image: url('{{ asset('tienda/images/hero_2.jpg')}}');">
      <div class="row justify-content-center text-center align-items-center">
        <div class="col-md-8">
          <span class="sub-title">Welcome</span>
          <h1>Wines For Everyone</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section mt-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 section-title text-center mb-5">
          <h2 class="d-block">Nuestros Productos</h2>
        </div>
      </div>
      <div class="row">
        @foreach ($produ as $value)
        <div class="col-lg-4 mb-5 col-md-6">
          <div class="wine_v_1 text-center pb-4">
            <a href="#" class="thumbnail d-block mb-4">
              <img src="{{ asset('productos_img/'.$value->nombre_imagen)}}" alt="" class="img-fluid">
            </a>
            <h3 class="heading mb-1">
              <a href="#">{{$value->nombre}}</a>
            </h3>
            <span class="price">$ {{$value->precio}}</span>
            <div class="wine-actions">
              <h3 class="heading-2">
                <a href="#">{{ $value->nombre}}</a>
              </h3>
              <span class="price d-block">$ {{ $value->precio}}</span>
              <a href="{{ route('addProducto', $value->id)}}" class="btn add"><span class="icon-shopping-bag mr-3"></span>Agregar a Carrito</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="hero-2" style="background-image: url('{{ asset('tienda/images/hero_2.jpg')}}');">
    <div class="container">
      <div class="row justify-content-center text-center align-items-center">
        <div class="col-md-8">
          <span class="sub-title">Welcome</span>
          <h2>Wines For Everyone</h2>
        </div>
      </div>
    </div>
  </div>

@endsection
