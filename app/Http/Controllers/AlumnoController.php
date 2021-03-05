<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $listaAlumnos = DB::table('tbl_alumnos')->get();
        //Se envia hacia la vista mediante la url el contenido de $listaAlumnos.
        return view('mostrar', compact('listaAlumnos'));
    }

    public function borrar($id){
        DB::table('tbl_alumnos')->where('id', '=', $id)->delete();
        return redirect('mostrar');
    }

    public function crear(){
        return view('crear');
    }

    public function recibir(Request $request){
        $datos = $request->except('_token', 'enviar');
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('uploads','public');
        }
        //return $datosform;
        DB::table('tbl_alumnos')->insertGetId(['foto'=>$datos['foto'],'nombre'=>$datos['nombre'],'apellido'=>$datos['apellido'],'edad'=>$datos['edad'],'email'=>$datos['email'],'password'=>$datos['password']]);
        return redirect('mostrar');
    }

    public function actualizar($id){
        //Recuperar alumno a través de su id //
        $alumno = DB::table('tbl_alumnos')->where('id', '=', $id)->first();
        //Enviar los datos del alumno a la vista //
        //return response()->json($alumno);
        return view('actualizar', compact('alumno'));
    }

    public function modificar($id, Request $request){
        $datos = request()->except('_token', 'enviar', '_method');
        //return $datos;
        if ($request->hasfile('foto')) {
            $alumno = DB::table('tbl_alumnos')->where('id', '=', $id)->first();
            // eliminamos la ruta de la foto de la bd.
            Storage::delete('public/'.$alumno->foto);
            // guardar la foto en el storage en la nueva ruta.
            $datos['foto']=$request->file('foto')->store('uploads', 'public');
        }
        // actualizar bd
        DB::table('tbl_alumnos')->where('id', '=', $id)->update($datos);
        // redirigir a mostrar
        return redirect('mostrar');
    }

    public function login(){
        return view('login');
    }

    public function recibirlogin(Request $request){
        $datos=request()->except('_token', 'enviar');
        $pasa=DB::table('tbl_alumnos')->where([
            ['email', '=', $datos['email']], 
            ['password', '=', $datos['password']],
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

    public function pagar($id, $precio){
        # return $precio;

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
}
