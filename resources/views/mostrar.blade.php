<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Mostrar alumnos</title>
</head>
<body>
    <form method="GET" action="{{url('crear')}}">
        <button type="submit" class="btn btn-success">Crear</button>
    </form>
    <table class="table" style="width: 100%;">
        <thead class="thead-black">
            <tr>
                <th>Foto</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actualizar</th>
                <th>Borrar</th>
                <th>Comprar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaAlumnos as $alumno)
            <tr>
                <td><img src="{{asset('storage').'/'.$alumno->foto}}" width="100"></td>
                <td>{{$alumno->id}}</td>
                <td>{{$alumno->nombre}}</td>
                <td>{{$alumno->apellido}}</td>
                <td>{{$alumno->edad}}</td>
                <td>{{$alumno->email}}</td>
                <td>{{$alumno->password}}</td>
                <td>
                    <form method="get" action="{{url('/actualizar/'.$alumno->id)}}">
                    <button type='submit' class="btn btn-primary" onclick="return confirm('¿Estas seguro de actualizar?');">Actualizar</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{url('/borrar/'.$alumno->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type='submit' class="btn btn-danger" onclick="return confirm('¿Borrar?');">Borrar</button>
                    </form>
                </td>
                <td>
                    <form method="get" action="{{url('/pagar/'.$alumno->id.'/'.$alumno->precio)}}">
                    {{csrf_field()}}
                    <button type='submit' class="btn btn-danger" onclick="return confirm('¿Comprar?');">Comprar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>