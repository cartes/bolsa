<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <form class="form" method="post" action="{{ route('profile.languages') }}">
            <h3 class="text-center">Idiomas</h3>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Idioma</label>
                    <input type="text"
                           class="form-control {{$errors->has('language') ? 'is-invalid' : ''}}"
                           name="language" value="{{old('language')}}"/>
                    @if($errors->has('language'))
                        <span class="invalid-feedback">{{$errors->first('language')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nivel Escrito</label>
                    <select class="form-control {{$errors->has('level_written') ? 'is-invalid' : ''}}"
                            name="level_written">
                        <option value="">Seleccionar</option>
                        <option value="1" {{old('level_spoken')==1 ? 'selected' : ''}}>Básico</option>
                        <option value="2" {{old('level_spoken')==2 ? 'selected' : ''}}>Intermedio</option>
                        <option value="3" {{old('level_spoken')==3 ? 'selected' : ''}}>Avanzado</option>
                        <option value="4" {{old('level_spoken')==4 ? 'selected' : ''}}>Nativo</option>
                    </select>
                    @if($errors->has('level_written'))
                        <span class="invalid-feedback">{{$errors->first('level_written')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Nivel Hablado</label>
                    <select class="form-control {{$errors->has('level_spoken') ? 'is-invalid' : ''}}"
                            name="level_spoken">
                        <option value="">Seleccionar</option>
                        <option value="1" {{old('level_spoken')==1 ? 'selected' : ''}}>Básico</option>
                        <option value="2" {{old('level_spoken')==2 ? 'selected' : ''}}>Intermedio</option>
                        <option value="3" {{old('level_spoken')==3 ? 'selected' : ''}}>Avanzado</option>
                        <option value="4" {{old('level_spoken')==4 ? 'selected' : ''}}>Nativo</option>
                    </select>
                    @if($errors->has('level_spoken'))
                        <span class="invalid-feedback">{{$errors->first('level_spoken')}}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </form>
    </div>
</div>

@if($user->UserLanguage)
    @foreach($user->UserLanguage as $lang)
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>{{$lang->language}}</h4>
                        <h6>Escrito: {{$lang->level_written}} - Oral: {{$lang->level_spoken}}</h6>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@else
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>Aun no has cargado ningún idioma que domines.</p>
                </div>
            </div>
        </div>
    </div>
@endif