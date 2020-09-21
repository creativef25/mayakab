@extends('indexT')
@section('container')

  <style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>

  <div class="site-section">
    <div class="container">
      <form role="form" class="require-validation" action="{{ route('guardarPedido')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf
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
                      <input type="hidden" name="envio" value="" id="env">
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Total</strong></td>
                      <td class="text-black font-weight-bold"><strong id="precio">$ {{$total}}.00</strong> </td>
                      <input type="hidden" name="total" value="" id="tot">
                    </tr>
                  </tbody>
                </table>
                <div class="border mb-3 p-3 rounded">
                  <h3 class="h6 mb-0">
                    <a class="d-block" data-toggle="collapse" href="#pagoTarjeta" role="button" aria-expanded="false" aria-controls="pagoTarjeta">Pago con Tarjeta</a>
                  </h3>
                  <div class="collapse" id="pagoTarjeta">
                    <div class="display-td" >
                              <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                          </div>
                    <div class="py-2 pl-0">
                      <div class='form-row row'>
                            <div class='col-md-12 form-group required'>
                                <label class='control-label'>Titular de la Tarjeta</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 form-group required'>
                                <label class='control-label'>Numero de Tarjeta</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Mes de Expiración</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Años de Expiración</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="border mb-3 p-3 rounded">
                  <h3 class="h6 mb-0">
                    <a class="d-block" data-toggle="collapse" href="#pagoFicha" role="button" aria-expanded="false" aria-controls="pagoFicha">Pago con Ficha</a>
                  </h3>
                  <div class="collapse" id="pagoFicha">
                    <div class="py-2 pl-0">
                      <p class="mb-0">
                        Ingrese la ficha de pago.
                      </p>
                      <input type="file" class="form-control" name="imagen" value="">
                    </div>
                  </div>
                </div>
                <div class="border mb-3 p-3 rounded">
                  <h3 class="h6 mb-0">
                    <a class="d-block" data-toggle="collapse" href="#datosTransferencia" role="button" aria-expanded="false" aria-controls="datosTransferencia">Datos para Transferencia</a>
                  </h3>
                  <div class="collapse" id="datosTransferencia">
                    <div class="py-2 pl-0">
                      <p class="mb-0">
                        Datos para Transferencia
                      </p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block" type="submit" name="button">Comprar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript">
  $(document).ready(function(){


    $.getJSON('https://api-sepomex.hckdrk.mx/query/get_estados', function(data){
      var estados = data.response.estado;
      var esta = $("#estado");

      $.each(estados, function(index, value){
        esta.append('<option value="'+value+'">' + value + '</option>');
      });
    });


    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  });

  $("#estado").change(function(){
    var nombre = $(this).val();
    if (nombre == "Ciudad de México") {
      $("#envios").text("$ 70.00");
      $("#precio").text('$ '+{{$total + 70}}+'.00');
      $("#env").val(70);
      $("#tot").val({{$total + 70}});
    }else {
      $("#envios").text("$ 175.00");
      $("#precio").text('$ '+{{$total + 175}}+'.00');
      $("#env").val(175);
      $("#tot").val({{$total + 175}});
    }
  });

  </script>
@endsection
