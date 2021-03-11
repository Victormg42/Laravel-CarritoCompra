<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="card card-container">
    <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
    <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="{{url('recibirlogin')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="Email..." required autofocus><br>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="passwd_usuario" name="passwd_usuario" placeholder="Password..." required><br>
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-lg btn-primary btn-block btn-signin" value="Iniciar Sesión" name="enviar">
                </div>
        </form>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>