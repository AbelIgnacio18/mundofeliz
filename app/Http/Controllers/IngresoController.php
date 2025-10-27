<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Articulo;
use App\Http\Requests\StoreIngresoRequest;
use App\Http\Requests\UpdateIngresoRequest;
use App\Models\Detalleingreso;
use Illuminate\Http\Request;// importacion 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request) {
         
            $ingreso=Ingreso::with('detalleingresos')->get();
     
            $articulo=Articulo::with('categoria')->get();


            return view('pages.ingreso.index',compact('ingreso','articulo'));
        
        }
    
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIngresoRequest $request)
    {
        try {
            DB::beginTransaction();
            $id=Auth::user()->id;
            $ingreso = new Ingreso;
            $anolect = Anolectivo::where('estado', 1)->first();
            $ingreso->iduser =$id;
            $ingreso->montototal = $request->get('total_venta');
           

            $mytime=Carbon::now('America/Lima');
            $ingreso->fecha=$mytime->toDateTimeString(); 
             $pago->idanolectivo = $anolect->id;
            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio = $request->get('precio');
         

            $cont = 0;

            while ($cont < count($idarticulo)) {
                $detalle = new Detalleingreso();
                // dd($ingreso->id);
                $detalle->idingreso = $ingreso->id;
                $detalle->idarticulo = $idarticulo[$cont];

                $detalle->cantidad = $cantidad[$cont];
                $articulo = Articulo::find($idarticulo[$cont]);
                $stock1 = $articulo->stock; // unma
                $articulo->stock = $stock1 + $cantidad[$cont];
                $articulo->update();
                $detalle->montototal = $precio[$cont] * $cantidad[$cont];
                $detalle->fecha = $mytime->toDateTimeString();

                $detalle->save();
                $cont++;
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return back()->with('message', 'Actualización Exítosa');
      
    }
  

   
    public function edit()
    {

     
    }

    public function show($id)
    {

        $ingreso= DB::table('ingresos as i')
            ->join('users as u', 'i.iduser', '=', 'u.id')
            ->select('i.fecha','u.name','montototal')->where('i.id',$id)->first();
           
            $detalleingreso=DB::table('detalleingresos as d')
            ->join('articulos as a', 'd.idarticulo','=','a.id')
            ->join('categorias as c', 'a.idcategoria','=','c.id')
            ->select('d.idingreso','a.nombre','a.preciocosto','d.cantidad','d.montototal','c.nombre as categoria')->where('d.idingreso',$id)->get();
// dd($ingreso,$detalleingreso);

        return view("pages.ingreso.show", compact('ingreso','detalleingreso'));
    }
    public function update(UpdateIngresoRequest $request)
    {

     
    }

    

 
    public function destroy($concepto)
    {

        $concepto=Ingreso::find($concepto);
        $concepto->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
    
}

