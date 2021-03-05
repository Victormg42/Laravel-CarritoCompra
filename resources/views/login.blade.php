<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Mostrar alumnos</title>
</head>
<body>
<div>
    <form action="{{url('recibirlogin')}}" method="POST">

        {{csrf_field()}}

        <label>Email</label>
        <input type="email" id="email" name="email" required><br>

        <label>Password</label>
        <input type="password" id="password" name="password" required><br>
  
        <input type="submit" value="enviar" name="enviar">
</form>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>