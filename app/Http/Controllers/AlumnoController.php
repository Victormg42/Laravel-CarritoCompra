<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Cart;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }

    public function mostrar(){
        // Obtener todos los usuarios de la BD y mandarlos a la vista.
        //$result = DB::select('SELECT * FROM tbl_alumnos');
        $listaRopa = DB::table('tbl_ropa')->get();
        //Se envia hacia la vista mediante la url el contenido de $listaAlumnos.
        return view('mostrar', compact('listaRopa'));
    }

    public function borrar($id_ropa){
        DB::table('tbl_ropa')->where('id_ropa', '=', $id_ropa)->delete();
        return redirect('mostrar');
    }

    public function crear(){
        return view('crear');
    }

    public function recibir(Request $request){
        $datos = $request->except('_token', 'enviar');
        if ($request->hasFile('foto_ropa')) {
            $datos['foto_ropa']=$request->file('foto_ropa')->store('uploads','public');
        }
        //return $datosform;
        DB::table('tbl_ropa')->insertGetId(['foto_ropa'=>$datos['foto_ropa'],'prenda_ropa'=>$datos['prenda_ropa'],'precio_ropa'=>$datos['precio_ropa']]);
        return redirect('mostrar');
    }

    public function actualizar($id_ropa){
        //Recuperar alumno a través de su id //
        $ropa = DB::table('tbl_ropa')->where('id_ropa', '=', $id_ropa)->first();
        //Enviar los datos del alumno a la vista //
        //return response()->json($alumno);
        return view('actualizar', compact('ropa'));
    }

    public function modificar($id_ropa, Request $request){
        $datos = request()->except('_token', 'enviar', '_method');
        //return $datos;
        if ($request->hasfile('foto_ropa')) {
            $ropa = DB::table('tbl_ropa')->where('id_ropa', '=', $id_ropa)->first();
            // eliminamos la ruta de la foto de la bd.
            Storage::delete('public/'.$ropa->foto_ropa);
            // guardar la foto en el storage en la nueva ruta.
            $datos['foto_ropa']=$request->file('foto_ropa')->store('uploads', 'public');
        }
        // actualizar bd
        DB::table('tbl_ropa')->where('id_ropa', '=', $id_ropa)->update($datos);
        // redirigir a mostrar
        return redirect('mostrar');
    }

    public function login(){
        return view('login');
    }

    public function recibirlogin(Request $request){
        $datos=request()->except('_token', 'enviar');
        $pasa=DB::table('tbl_usuario')->where([
            ['email_usuario', '=', $datos['email_usuario']], 
            ['passwd_usuario', '=', $datos['passwd_usuario']],
            ])->count();
            if ($pasa == 1) {
                //establecer sesion
                //redirigir pagina mostrar
                return redirect('mostrar');
            } else {
                //redirigir a la ruta
                return redirect('/');
            }
    }

    public function pagar($id){
        # return $precio;
        $precio = Cart::getTotalQuantity();
       $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            config('services.paypal.clientid'),     // ClientID
            config('services.paypal.secret')      // ClientSecret
        )
);
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        //precio a pagar
        $amount->setTotal($precio);
        $amount->setCurrency('EUR');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        //Si se produce el pago bien, te lleva a la url comprado y envía la información del id.
        //si se cancela te lleva a la pagina que tu le indiques, en este caso, el mostrar
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(url("comprado/".$id))->setCancelUrl(url("mostrar"));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

            try {
                $payment->create($apiContext);
                //me redirige a la pagina de paypal
                return redirect()->away( $payment->getApprovalLink());

            }
            catch (\PayPal\Exception\PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
                echo $ex->getData();
            }
    }

    public function comprado(Request $request, $id) {
        return $id;
    }

    /*public function verCarrito() {
        return view('mostrarCarrito');
    }*/

    public function carritoAdd($id_ropa, $precio_ropa, $prenda_ropa, $cantidad_ropa) {
        Cart::add(array(
            'id' => $id_ropa,
            'name' => $prenda_ropa,
            'price' => $precio_ropa,
            'quantity' => $cantidad_ropa
            )
        );
        return back();
    }

    public function borrarCart($id) {
        Cart::remove($id);
        return back();
    }
}
