<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>ACTUALIZAR ALUMNO</title>
    {{$alumno->nombre}}
    <div> 
             <form action="{{url('modificar/'.$alumno->id)}}"  method="post" enctype="multipart/form-data">
                @csrf
                <!--{{csrf_field()}}-->
                {{method_field('PUT')}}
                  <label>Foto</label>
                  <input type="file" name="foto" value="{{$alumno->foto}}" required>

                  <label>Nombre</label>
                  <!-- {{-- {{<input type="text" name="__token" value=csrf_token()> }} --}}-->
                  <input type="text" name="nombre" value="{{$alumno->nombre}}" required>

                  <label>Apellido</label>
                  <input type="text" name="apellido" value="{{$alumno->apellido}}" required>

                  <label>Email</label>
                  <input type="email" name="email" value="{{$alumno->email}}" required>

                  <label>Edad</label>
                  <input type="number" name="edad" value="{{$alumno->edad}}" required>

                  <label>password</label>
                  <input type="password" name="password" value="{{$alumno->password}}" required>

                <input type="submit" name="enviar" value="Enviar">
      <div>
</head>
<body>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>