@extends('index')
@section('container')

  <div class="page-header">
      <div class="page-block">
          <div class="row align-items-center">
              <div class="col-md-12">
                  <div class="page-header-title">
                      <h5 class="m-b-10">Registrar Productos</h5>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Productos</h5>
        </div>
        <div class="card-body">
          <form class="" action="{{ route('productosGuardar')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="floating-label" for="nombre">Nombre del Producto</label>
                  <input class="form-control" type="text" name="nombre" id="nombre" value="">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="floating-label" for="precio"></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend">$</span>
                      <input type="text" name="precio" class="form-control" placeholder="Precio del Producto" aria-describedby="inputGroupPrepend" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label class="floating-label" for="cantidad">Cantidad</label>
                  <input class="form-control" type="text" name="cantidad" id="cantidad" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="descripcion">Descripcion del Producto</label>
                  <textarea class="form-control" name="descripcion" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagen" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Subir Imagen</label>
                    </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn  btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5>Productos Registrados</h5>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produ as $value)
                  <tr>
                    <td>{{$value->nombre}}</td>
                    <td>{{$value->descripcion}}</td>
                    <td>{{$value->precio}}</td>
                    <td>{{$value->cantidad}}</td>
                    <td class="text-center">
                      <img src="{{ asset('/maykab/productos_img/'.$value->nombre_imagen)}}" width="20%" alt="">
                    </td>
                    <td>
                      <button class="btn btn-info" type="button" name="button">Editar</button>
                      <button class="btn btn-danger" type="button" name="button">Eliminar</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>

  </div>


@endsection
