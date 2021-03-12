<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Crear Producto</title>
    </head>
    <body>
    @if ($errors->any())
       <!-- <div class="alert-danger alert-dismissible" role="alert"> -->
           <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
             <form action="{{url('recibir')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!--{{csrf_field()}}-->
                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" class="form-control" name="foto_ropa" required>
                </div>

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="prenda_ropa" required>
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input type="text" class="form-control" name="precio_ropa" required>
                </div>

                <div class="form-group">
                  <label>Cantidad</label>
                  <input type="text" class="form-control" name="cantidad_ropa" required>
                </div>

                <input type="submit" name="enviar" value="Crear Producto">
      <div>
  <script src="{{asset('js/app.js')}}"></script>
</body>
</html>