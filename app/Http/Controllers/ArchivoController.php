<?php
 
namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;




class ArchivoController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos=Archivo::all();
        return view('archivos.index', compact('archivos'));
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
        $request->validate([
            'descripcion'=>'required',
            'path'=> 'required'
        ]);

        $archivo=new Archivo();
        $archivo->descripcion=$request->descripcion;
        $url=$request->path->store('public/archivos');
        $destino=Storage::url($url);

        $fpdi = new FPDI;
          
        $count = $fpdi->setSourceFile(public_path($destino));
  
        for ($i=1; $i<=$count; $i++) {
  
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
              
            //$fpdi->SetFont("helvetica", "", 15);
            // $fpdi->SetTextColor(153,0,153);
  
            // $left = 10;
            // $top = 10;
            // $text = "NiceSnippets.com";
            // $fpdi->Text($left,$top,$text);
  
            $fpdi->Image(public_path('img/logo.png'), 10, 10);
        }
        $fpdi->Output(public_path($destino),'F');

        $archivo->path=$destino;
        $archivo->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Archivo::find($id)->delete();
        return back();
    }
}
