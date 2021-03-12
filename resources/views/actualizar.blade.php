<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Actualizar Producto</title>
    <div class="container"> 
             <form action="{{url('modificar/'.$ropa->id_ropa)}}"  method="post" enctype="multipart/form-data">
                @csrf
                <!--{{csrf_field()}}-->
                {{method_field('PUT')}}
                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" name="foto_ropa" class="form-control" value="{{$ropa->foto_ropa}}" required>
                </div>

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="prenda_ropa" class="form-control" value="{{$ropa->prenda_ropa}}" required>
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input type="text" name="precio_ropa" class="form-control" value="{{$ropa->precio_ropa}}" required>
                </div>

                <input type="submit" name="enviar" value="Actualizar Producto">
      <div>
</head>
<body>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>