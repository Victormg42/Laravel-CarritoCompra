<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>CREAR ALUMNO</title>
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
    <div>
             <form  action="{{url('recibir')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!--{{csrf_field()}}-->
                  <label>Foto</label>
                  <!-- {{-- {{<input type="text" name="__token" value=csrf_token()> }} --}}-->
                  <input type="file" name="foto" required>
                  
                  <label>Nombre</label>
                  <!-- {{-- {{<input type="text" name="__token" value=csrf_token()> }} --}}-->
                  <input type="text" name="nombre" required>

                  <label>Apellido</label>
                  <input type="text" name="apellido" required>

                  <label>Email</label>
                  <input type="email" name="email" required>

              <label>Edad</label>
              <input type="number" name="edad" required>
              <label>password</label>
              <input type="password" name="password" required>
                <input type="submit" name="enviar" value="Enviar">
      <div>
  <script src="{{asset('js/app.js')}}"></script>
</body>
</html>