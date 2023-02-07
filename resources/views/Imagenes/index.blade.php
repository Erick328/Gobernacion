@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Gobernacion SC</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Agregar Imagen
                    </button>
                    <div class="card">
                       
                        {{-- <a href="btn btn-primary" href="{{route(imagenes.create)}}">Subir Imagen</a> --}}
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff">ID</th>
                                <th style="color:#fff">Descripcion</th>
                                <th style="color:#fff">URL</th>
                                <th style="color:#fff">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($imagenes as $imagen)
                                    <tr>
                                        <td>{{$imagen->id}}</td>
                                        <td>{{$imagen->descripcion}}</td>
                                        <td>{{$imagen->path}}</td>
                                        <td>
                                            <form action="{{route('imagenes.destroy', $imagen->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-secondary" href="{{route('imagenes.show',$imagen->id)}}" target="_blank">Ver Imagen</a>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar Imagen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-bars"> Descripcion</i>
                                    </span>
                                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
                                    {{-- <input type="" id="descripcion" name="descripcion" class="form-control"> --}}
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"> Imagen</i>
                                    </span>
                                    <input type="file" id="path" name="path" class="form-control" accept="image/*">
                                    @error('file')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>      
    

@endsection

