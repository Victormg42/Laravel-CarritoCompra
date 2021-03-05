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
                <th>Precio</th>
                <th colspan="3">Comprar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaRopa as $ropa)
            <tr>
                <td><img src="{{asset('storage').'/'.$ropa->foto_ropa}}" width="100"></td>
                <td>{{$ropa->id_ropa}}</td>
                <td>{{$ropa->prenda_ropa}}</td>
                <td>{{$ropa->precio_ropa}}</td>
                <td>
                    <form method="get" action="{{url('/actualizar/'.$ropa->id_ropa)}}">
                    <button type='submit' class="btn btn-primary" onclick="return confirm('¿Estas seguro de actualizar?');">Actualizar</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{url('/borrar/'.$ropa->id_ropa)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type='submit' class="btn btn-danger" onclick="return confirm('¿Borrar?');">Borrar</button>
                    </form>
                </td>
                <td>
                    <form method="get" action="{{url('/pagar/'.$ropa->id_ropa.'/'.$ropa->precio_ropa)}}">
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