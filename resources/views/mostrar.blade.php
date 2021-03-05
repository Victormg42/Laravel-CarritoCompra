<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <title>Mostrar alumnos</title>
</head>
<body>
    <form method="GET" action="{{url('crear')}}">
        <button type="submit" class="btn btn-success">Crear</button>
    </form>
    <form method="GET" action="{{url('verCarrito')}}">
        <button type="submit" class="btn btn-success">Ver Carrito</button>
    </form>
    <table class="table" style="width: 100%;">
        <thead class="thead-black">
            <tr>
                <th>Foto</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Actualizar</th>
                <th>Borrar</th>
                <th>Comprar</th>
                <th>Añadir a Carrito</th>
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
                <td>
                <form method="get" action="{{url('/carritoAdd/'.$ropa->id_ropa.'/'.$ropa->precio_ropa.'/'.$ropa->prenda_ropa.'/'.$ropa->cantidad_ropa)}}">
                @csrf
                <button style="border:none; outline:none; background-color: transparent;"><i style="font-size: 30px;" class="fas fa-cart-plus black"></i></button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>