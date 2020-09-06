@extends('indexT')
@section('container')

  <div class="site-section pb-0">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-7 section-title text-center mb-5">
          <h2 class="d-block">Mi Carrito</h2>
        </div>
      </div>
      <div class="row mb-5">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Imagen</th>
                <th class="product-name">Nombre</th>
                <th class="product-price">Precio</th>
                <th class="product-quantity">Cantidad</th>
                <th>Actualizar</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($prods as $value)
                <tr>
                  <td class="product-thumbnail">
                    <img src="{{ asset('productos_img/'.$value->nombre_imagen)}}" alt="" class="img-fluid">
                  </td>
                  <td class="product-name">{{ $value->nombre}}</td>
                  <td class="product-price">$ {{ $value->precio}}</td>
                  <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                      </div>
                      <input type="text" class="form-control text-center border mr-0" id="producto_{{$value->id}}" value="{{ $value->cantidad}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                      </div>
                    </div>
                  </td>
                  <th>
                    <button id="hola" class="btn btn-secondary btn-update-item" type="button" name="button" data-href="{{ route('actualizarCantidad', $value->id)}}" data-id="{{ $value->id}}">Actualizar</button>
                  </th>
                  <th class="product-total" id="total">$ {{ number_format($value->precio * $value->cantidad)}}.00</th>
                  <th>
                    <a href="{{ route('eliminarProducto', $value->id)}}" class="btn btn-primary height-auto btn-sm">X</a>
                  </th>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section pt-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6">
              <a href="{{ route('tienda')}}" class="btn btn-outline-primary btn-md btn-block">Continuar Comprando</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Total</h3>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">$ {{$total}}.00</strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">$ {{$total}}.00</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <a href="{{ route('checkout')}}" class="btn btn-primary btn-lg btn-bloc">Pagar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(".btn-update-item").click(function(e){
    e.preventDefault();

    var id = $(this).data('id');
    var href = $(this).data('href');
    var cantidad = $("#producto_"+id).val();

    window.location.href = href + "/" + cantidad;
  });

  </script>

@endsection
