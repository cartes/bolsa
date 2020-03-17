<form class="form" action="{{route('profile.experience')}}" method="post">
    <h4 class="text-left">Completa tu información Laboral, para recibir mejores ofertas</h4>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label>Nombre de la empresa</label>
            <input class="form-control {{$errors->has('business_name') ? 'is-invalid' : ''}}"
                   name="business_name" value="{{old('business_name')}}"/>
            @if($errors->has('business_name'))
                <span class="invalid-feedback">{{$errors->first('business_name')}}</span>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label>Puesto</label>
            <input class="form-control {{$errors->has('business_position') ? 'is-invalid' : ''}}"
                   name="business_position" value="{{old('business_position')}}"/>
            @if($errors->has('business_position'))
                <span class="invalid-feedback">{{$errors->first('business_position')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Desde</label>
            <input class="form-control {{$errors->has('year_from') ? 'is-invalid' : ''}}"
                   name="year_from" value="{{old('year_from')}}" placeholder="Año"/>
            @if($errors->has('year_from'))
                <span class="invalid-feedback">{{$errors->first('year_from')}}</span>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label>Hasta</label>
            <input class="form-control {{$errors->has('year_to') ? 'is-invalid' : ''}}"
                   name="year_to" value="{{old('year_to')}}" placeholder="Año"/>
            @if($errors->has('year_to'))
                <span class="invalid-feedback">{{$errors->first('year_to')}}</span>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Nivel de experiencia</label>
            <select class="form-control {{$errors->has('experience_level') ? 'is-invalid' : ''}}"
                    name="experience_level">
                <option value="" {{old('experience_level') == '' ? 'selected' : ''}}>Seleccionar</option>
                <option value="01" {{old('experience_level') == '01' ? 'selected' : ''}}>Training</option>
                <option value="02" {{old('experience_level') == '02' ? 'selected' : ''}}>Junior</option>
                <option value="03" {{old('experience_level') == '03' ? 'selected' : ''}}>Semisenior</option>
                <option value="04" {{old('experience_level') == '04' ? 'selected' : ''}}>Senior</option>
            </select>
            @if($errors->has('experience_level'))
                <span class="invalid-feedback">{{$errors->first('experience_level')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-8">
            <label>Descripción</label>
            <textarea name="description"
                      class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}">{{old('description')}}</textarea>
            @if($errors->has('description'))
                <span class="invalid-feedback">{{$errors->first('description')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </div>
    </div>


    @if($user->userExperience)
        <div class="row">
            <div class="col-md-12 my-2">
                @foreach($user->userExperience as $experience)
                    <div class="my-3">
                        <div class="header">
                            <h4>{{$experience->business_position}}</h4>
                            <p>
                                {{$experience->month_from}} {{$experience->year_from}} -
                                {{$experience->month_to}}&nbsp;{{$experience->year_to}}
                            </p>
                        </div>
                        <div class="body">
                            {{$experience->description}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</form>
