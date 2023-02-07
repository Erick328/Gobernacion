<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagenes=Imagen::all();
        return view('imagenes.index', compact('imagenes'));
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
            'path'=> 'required|image',
        ]);
        $url=$request->file('path')->store('public/imagenes');
        $destino=Storage::url($url);
        //dd(public_path($destino));
        $marca_agua=Image::make(public_path($destino));
        // $marca_agua->text('ByErick',10,10, function($fuente){
        //     $fuente->size(100);
        //     $fuente->color('#ffffff');
        //     $fuente->align('left');
        //     $fuente->valign('top');
        //     $fuente->angle(90);
            
        // });
        $logo=Image::make(public_path('img/logo.png'));
        $marca_agua->insert($logo,'top-left',10,10);
        $marca_agua->save();
        $imagen=new Imagen();
        $imagen->descripcion=$request->descripcion;
        $imagen->path= $destino;
        $imagen->save();

        // $img=$request->file('path');
        // $nombre=time().'.'.$img->getClientOriginalExtension();

        // $destino=public_path('img/gober');
        // $request->path->move($destino, $nombre);
        // $red= Image::make($destino.'/'.$nombre);
        // $red->resize(200, null, function($constraint){
        //     $constraint->aspectRatio();
        // });
        // //$red->save($destino.'/marca/'.$nombre);
        // $marca_agua=Image::make($destino.'/'.$nombre);
        // $logo=Image::make(public_path('img/logo.png'));
        // $marca_agua->insert($logo,'bottom-right',10,10);
        // $marca_agua->save();
        // $imagen=new Imagen();
        // $imagen->descripcion=$request->descripcion;
        // $imagen->path= public_path('img/gober'.$nombre);
        // $imagen->save();


    //     $imagen=new Imagen();
    //     $imagen->descripcion=$request->descripcion;
    //     $url=$request->path->store('public/imagenes');

    //     $imagen->path=Storage::url($url);

    //     $img=Image::make($url);
    //     $img->resize(200, null, function($constraint){
    //         $constraint->aspectRatio();
    //     });
    //     $img->save($url);
    //     $marca_agua=Image::make($url);
    //     $logo=Image::make(public_path('img/logo.png'));
    //     $marca_agua->insert($logo,'bottom-right',10,10);
    //     $marca_agua->save();
    //     $imagen->path=Storage::url($url);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imagen=Imagen::find($id);
        return view('imagenes.show', compact('imagen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagen $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Imagen::find($id)->delete();
        return back();
    }
}
