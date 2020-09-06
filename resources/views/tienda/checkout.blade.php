@extends('indexT')
@section('container')

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black font-heading-serif">Detalles de Compra</h2>
          <div class="p-3 p-lg-5 border">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="nombre" class="text-black">Nombres <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="nombre" value="">
              </div>
              <div class="col-md-6">
                <label for="apellidos" class="text-black">Apellidos <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="apellidos" value="">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="direccion" class="text-black">Direccion <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="direccion" value="" placeholder="Direccion">
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name="referencia" value="" placeholder="Apartamento, suite, unidad, etc.">
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label for="estado" class="text-black">Estado <span class="text-danger">*</span> </label>
                <select class="form-control" name="estado" id="estado">
                  <option value=""></option>

                </select>
                {{--}}<input type="text" class="form-control" name="estado" value="" id="hola">--}}
              </div>
              <div class="col-md-6">
                <label for="cp" class="text-black">Codigo Postal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cp" value="">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="correo" class="text-black">Correo Electronico <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="correo" value="">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="telefono" class="text-black">Telefono <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="telefono" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black font-heading-serif">Tu orden</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Producto</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    @foreach ($prods as $value)
                      <tr>
                        <td>{{$value->nombre}} X {{ $value->cantidad}}</td>
                        <td>$ {{ number_format($value->precio * $value->cantidad)}}.00</td>
                      </tr>
                    @endforeach
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                      <td class="text-black">$ {{$total}}.00</td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Gasto de Envio</strong> </td>
                      <td class="text-black"><strong id="envios">$ 0.00</strong> </td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Total</strong></td>
                      <td class="text-black font-weight-bold"><strong>$ {{$total}}.00</strong> </td>
                    </tr>
                  </tbody>
                </table>
                <div class="border mb-3 p-3 rounded">
                  <h3 class="h6 mb-0">
                    <a class="d-block" data-toggle="collapse" href="#" role="button" aria-expanded="false" aria-controls="collapsebank">Pago con Tarjeta</a>
                  </h3>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block" type="button" name="button">Comprar</button>
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
  $(document).ready(function(){
    $.getJSON('https://api-sepomex.hckdrk.mx/query/get_estados', function(data){
      var estados = data.response.estado;
      var esta = $("#estado");

      $.each(estados, function(index, value){
        esta.append('<option value="'+value+'">' + value + '</option>');
      });
    });
  });

  $("#estado").change(function(){
    var nombre = $(this).val();
    if (nombre == "Ciudad de México") {
      $("#envios").text("$ 70.00");
    }else {
      $("#envios").text("$ 175.00");
    }
  });

  </script>
@endsection
