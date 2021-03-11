<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <script src="{{asset('js/ajax.js')}}"></script>
    <title>Mostrar Productos</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <form class="form-inline" method="GET" action="{{url('crear')}}">
                <button type="submit" class="form-control mr-sm-2 btn navbar-btn btn-success">Crear</button>
            </form>
                <button type="submit" onclick="openModal();" class="btn navbar-btn btn-success">Ver Carrito</button>
                  
        </div>
    </nav>

    <table class="table" style="width: 100%;">
        <thead class="thead-black">
            <tr>
                <th>Foto</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Actualizar</th>
                <th>Borrar</th>
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
                <form method="get" action="{{url('/carritoAdd/'.$ropa->id_ropa.'/'.$ropa->precio_ropa.'/'.$ropa->prenda_ropa.'/'.$ropa->cantidad_ropa)}}">
                @csrf
                <button style="border:none; outline:none; background-color: transparent;"><i style="font-size: 30px;" class="fas fa-cart-plus black"></i></button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal();">&times;</span>
            <div class="container">
                <div class="abs-center">
                <table class="table">
                <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Eliminar</th>
                        </tr>
                </thead>
                @if (!Cart::isEmpty())
                <tbody>
                @foreach (Cart::getContent() as $item)
                    <tr>
                        <td><img style="margin-right: 10px" src="{{asset('storage').'/'.$ropa->foto_ropa}}" width="40">
                            {{$item->name}}</td>
                        <td>{{$item->price}}€</td>
                        <td>{{$item->quantity}}</td>
                        <td>
                            <form method="POST" action="{{url('/borrarCart/'.$item->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border:none; outline:none; background-color: transparent;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
                <div>
                    <h5>Cantidad total: {{Cart::getTotalQuantity()}}</h5>
                    <h5>Total: {{Cart::getTotal()}}€</h5>
                    <form method="get" action="{{url('/pagar/'.$item->id)}}">
                        {{csrf_field()}}
                        <button type='submit' class="btn btn-danger" onclick="return confirm('Pagar?');">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif    
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>