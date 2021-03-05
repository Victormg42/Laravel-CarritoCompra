<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Carrito</title>
</head>
<body>
@if (!Cart::isEmpty())
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach (Cart::getContent() as $item)
        <tr> 
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}€</td>
            <td>{{$item->quantity}}</td>
            <td>{{Cart::getTotalQuantity()}}</th>
            <td>{{Cart::getSubTotal()}}€</th>
            <td>{{Cart::getTotal()}}€</th>
            <td>
              <form method="POST" action="{{url('/borrarCart/'.$item->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button>Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    @endif
<body>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>