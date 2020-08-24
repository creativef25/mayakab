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
                    <a href="" class="btn btn-success btn-update-item" data-href="{{ route('actualizarCantidad', $value->id)}}" data-id="{{ $value->id}}">Actualizar </a>
                  </th>
                  <th class="product-total" id="total">$ {{ number_format($value->precio * $value->cantidad)}}</th>
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
@endsection
@push('scriptt')
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('.btn-update-item').on('click', function(e){
      alert('hooa');
      e.preventDefault();

      var id = $(this).data('id');
      var href = $(this).data('href');
      var cantidad = $("#producto_"+id).val();

      window.location.href = href + "/" + cantidad;

    });
  });
  </script>

@endpush
