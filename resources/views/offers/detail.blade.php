@extends('layout.app')

@section('content')
    <div class="container">

        @if(session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-{{session('message')[0]}}" role="alert">
                        {{session('message')[1]}}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center mb-3">
            <div class="col-sm-8">
                <a href="{{ route('offer.admin') }}">&laquo; Volver al listado</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 card card-body">
                <form method="post" action="{{ route('offer.store', $offer->slug ) }}">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="text-left">Editando oferta Nº{{$offer->id}}</h3>
                        <h4 class="text-left">{{$offer->title}}</h4>
                        <h6>Publicado en: {{$offer->date}}</h6>
                    </div>
                    <div class="col-md-4 d-flex flex-row-reverse align-items-center">
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Guardar los datos</button>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                    @csrf
                    @method("PUT")
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Título</label>
                            <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                   name="title" value="{{old('title') ?: $offer->title}}"/>
                            @if($errors->has('title'))
                                <span class="invalid-feedback">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Descripción</label>
                            <textarea id="contents" type="text"
                                      class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                                      name="description">{{old('description') ?: $offer->description}}</textarea>
                            @if($errors->has('description'))
                                <span class="invalid-feedback">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Área del puesto</label>
                            <input type="text" name="area"
                                   class="form-control {{$errors->has('area') ? 'is-invalid' : ''}}"
                                   value="{{old('area') ?: $offer->area}}"/>
                            @if($errors->has('area'))
                                <span class="invalid-feedback">{{$errors->first('area')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Subárea del puesto</label>
                            <input type="text" name="subarea"
                                   class="form-control {{$errors->has('subarea') ? 'is-invalid' : ''}}"
                                   value="{{old('subarea') ?: $offer->sub_area}}"/>
                            @if($errors->has('subarea'))
                                <span class="invalid-feedback">{{$errors->first('subarea')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>País</label>
                            <input type="text" name="country"
                                   class="form-control {{$errors->has('country') ? 'is-invalid' : ''}}"
                                   value="{{old('country') ?: $offer->country}}"/>
                            @if($errors->has('country'))
                                <span class="invalid-feedback">{{$errors->first('country')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Provincia</label>
                            <input type="text" name="state"
                                   class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}"
                                   value="{{old('state') ?: $offer->state}}"/>
                            @if($errors->has('state'))
                                <span class="invalid-feedback">{{$errors->first('state')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Ciudad</label>
                            <input type="text" name="city"
                                   class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}"
                                   value="{{old('city') ?: $offer->city}}"/>
                            @if($errors->has('city'))
                                <span class="invalid-feedback">{{$errors->first('city')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Comuna</label>
                            <input type="text" name="comune"
                                   class="form-control {{$errors->has('comune') ? 'is-invalid' : ''}}"
                                   value="{{old('comune') ?: $offer->comune}}"/>
                            @if($errors->has('comune'))
                                <span class="invalid-feedback">{{$errors->first('comune')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Dirección</label>
                            <input type="text" name="address"
                                   class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                                   value="{{old('address') ?: $offer->address}}"/>
                            @if($errors->has('address'))
                                <span class="invalid-feedback">{{$errors->first('address')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Renta Ofrecida</label>
                            <input type="text" name="salary"
                                   class="form-control {{$errors->has('salary') ? 'is-invalid' : ''}}"
                                   value="{{old('salary') ?: $offer->salary}}"/>
                            @if($errors->has('salary'))
                                <span class="invalid-feedback">{{$errors->first('salary')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Guardar los datos</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {
            $(document).ready(function () {
                tinymce.init({
                    selector: '#contents',
                    schema: 'html5',
                    themes: 'modern',
                    language: 'es_ES',
                    menubar: false,
                    plugins: "lists",
                    skin: 'oxide',
                    statusbar: false,
                    toolbar: [
                        'bold italic underline numlist bullist',
                        'code'
                    ],
                });
            });
        });
    </script>
@endpush