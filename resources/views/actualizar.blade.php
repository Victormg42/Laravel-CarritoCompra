<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>ACTUALIZAR ALUMNO</title>
    {{$ropa->prenda_ropa}}
    <div> 
             <form action="{{url('modificar/'.$ropa->id_ropa)}}"  method="post" enctype="multipart/form-data">
                @csrf
                <!--{{csrf_field()}}-->
                {{method_field('PUT')}}
                  <label>Foto</label>
                  <input type="file" name="foto_ropa" value="{{$ropa->foto_ropa}}" required>

                  <label>Nombre</label>
                  <!-- {{-- {{<input type="text" name="__token" value=csrf_token()> }} --}}-->
                  <input type="text" name="prenda_ropa" value="{{$ropa->prenda_ropa}}" required>

                  <label>Precio</label>
                  <input type="text" name="precio_ropa" value="{{$ropa->precio_ropa}}" required>

                <input type="submit" name="enviar" value="Enviar">
      <div>
</head>
<body>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>