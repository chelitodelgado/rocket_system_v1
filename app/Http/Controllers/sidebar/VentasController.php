<?php

namespace App\Http\Controllers\sidebar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ventas;
use App\Producto;
use DateTime;
use Illuminate\Support\Facades\DB;
use Validator;

class VentasController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $producto = Producto::latest()->get();

        $datatable = Producto::query('articulo')
            ->join('ventas', 'articulo.id', '=', 'ventas.articulo_id')
            ->select('articulo.nombre', 'ventas.*')
            ->get();

        if (request()->ajax()) {

            return datatables()->of($datatable)
                ->addColumn('action', function ($data) {
                    $button = '<a style="cursor:pointer; color: #00C851;"
                    name="edit" id="' . $data->id . '"
                    class="edit"><i class="fa fa-edit"></i></a> ';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer; color:#FF3547;"
                    name="delete" id="' . $data->id . '"
                    class="delete"><i class="fa fa-trash"></i></a> ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        // Redireccionar a vista de ventas
        return view('layouts.sidebar.venta',[
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $abcMayus   = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $abcMinus   = "abcdefghijklmnopqrstuvwxyz";
        $numericos  = "1234567890";

        $total = 0;
        $stock = 0;
        $date = date('d-m-Y H:i:s');
        $codigoVenta = VentasController::generador(13, $abcMayus );

        if( $request->articulo_id >= 1 ) {

            $cantidad = $request->articulo_id;
            foreach( $cantidad as $key => $value ) {

                $producto = Producto::findOrFail($request->articulo_id[$key]);
                $stock = $producto->stock - $request->cantidad[$key];
                /* if( $stock == 0 ){
                   return response()->json(['stock' => "Producto sin stock."]);
                } */
                $total = $producto->precio_venta * $request->cantidad[$key];
                Producto::whereId($request->articulo_id[$key])->update(['stock' =>  $stock]);
                // return response()->json(['success' => 'Venta concretada correctamente.']);

                $venta = new Ventas();
                $venta->codigoventa = $codigoVenta;
                $venta->cantidad    = $request->cantidad[$key];
                $venta->total       = $total;
                $venta->articulo_id = $request->articulo_id[$key];
                $venta->created_at  = $date;
                $venta->save();
            }
            return response()->json(['success' => 'Venta concretada correctamente.']);

        } else {
            return response()->json(['errors' => "Seleccione un producto"]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Busqueda de la categoria por id
        if ( request()->ajax() ) {
            $data = Ventas::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $total = 0;

        //Validaciones
        $rules = array(
            'articulo_id' => 'required',
            'cantidad'    => 'required'
        );

        $error = Validator::make(  $request->all(), $rules );

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // Actualizar el stock del producto y el precio
        // $stock = Producto::

        $form_data = array(
            'articulo_id' => $request->articulo_id,
            'cantidad'    => $request->cantidad,
            'total'       => $request->articulo_id
        );

        Ventas::whereId($request->hidden_id)->update($form_data);


        return response()->json(['success' => 'OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // Eliminando la categori por id
        $data = Ventas::findOrFail($id);
        $data->delete();
    }

    public function fullSelect() {

        if ( request()->ajax() ) {
            $producto = Producto::latest()->get();
            return response()->json(['data' => $producto]);
        }

    }

    public function getChart() {

        // Optener venta
        $total = Ventas::select('total')->get();
        $fecha = Ventas::select('created_at')->get();

        $labels = ["Enero", "Febrero", "Marzo", "Abril"];
        $dataVentas = [1, 9, 10, 14];

        $resp = [
            "labels" => $fecha,
            "data"   => $total,
        ];

        return response()->json(['resp' => $resp]);
    }

    public static function generador($long, $string) {

        $codigoVenta = "";

        for ($i=0; $i < $long; $i++) {
          $indice = rand(0, (strlen($string)-1));
          $codigoVenta = $codigoVenta.$string[$indice];
        }

        return $codigoVenta;

    }


}
