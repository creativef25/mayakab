@extends('indexT')
@section('container')

  <div class="hero-2" style="background-image: url('{{ asset('tienda/images/hero_2.jpg')}}');">
    <div class="container">
      <div class="row justify-content-center text-center align-items-center">
        <div class="col-md-8">
          <span class="sub-title">Get In Touch</span>
          <h2>Contact</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title mb-5">
            <h2>Contactanos</h2>
          </div>
          <form method="post">
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="fname">Nombre</label>
                <input type="text" id="fname" class="form-control form-control-lg">
              </div>
              <div class="col-md-6 form-group">
                <label for="lname">Apellidos</label>
                <input type="text" id="lname" class="form-control form-control-lg">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="eaddress">Correo</label>
                <input type="text" id="eaddress" class="form-control form-control-lg">
              </div>
              <div class="col-md-6 form-group">
                <label for="tel">Telefono</label>
                <input type="text" id="tel" class="form-control form-control-lg">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
                <label for="message">Mensaje</label>
                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <input type="submit" value="Enviar" class="btn btn-primary py-3 px-5">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
