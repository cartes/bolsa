<form class="form" action="{{route('profile.education')}}" method="post">
    <h4 class="text-left">Completa tu información Académica.</h4>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-6">
            <label>Carrera / Título</label>
            <input class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                   name="title" value="{{old('title')}}"/>
            @if($errors->has('title'))
                <span class="invalid-feedback">{{$errors->first('title')}}</span>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label>Institución</label>
            <input class="form-control {{$errors->has('institution') ? 'is-invalid' : ''}}"
                   name="institution" value="{{old('institution')}}"/>
            @if($errors->has('institution'))
                <span class="invalid-feedback">{{$errors->first('institution')}}</span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label>Estado</label>
            <select class="form-control {{$errors->has('condition') ? 'is-invalid' : ''}}"
                    name="condition" value="{{old('condition')}}">
                <option value="" {{old('condition') == '' ? 'selected' : ''}}>Seleccionar</option>
                <option value="1" {{old('condition') == '1' ? 'selected' : ''}}>En Curso</option>
                <option value="2" {{old('condition') == '2' ? 'selected' : ''}}>Graduado</option>
                <option value="3" {{old('condition') == '3' ? 'selected' : ''}}>Abandonado</option>
            </select>
            @if($errors->has('condition'))
                <span class="invalid-feedback">{{$errors->first('condition')}}</span>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label>Año de Egreso</label>
            <input class="form-control {{$errors->has('year_to_st') ? 'is-invalid' : ''}}"
                   name="year_to_st" value="{{old('year_to_st')}}" placeholder="Año"/>
            @if($errors->has('year_to_st'))
                <span class="invalid-feedback">{{$errors->first('year_to_st')}}</span>
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </div>
    </div>

    @if($user->userEducation)
        <div class="col-md-12 my-2">
            @foreach($user->userEducation as $education)
                <div class="my-3">
                    <div class="header">
                        <h4><strong>{{$education->title}}</strong> en {{$education->institution}}</h4>
                        <p>
                            {{$education->month_from}} {{$education->year_from}} -
                            {{$education->month_to}} {{$education->year_to}}
                        </p>
                    </div>
                    <div class="body">
                        <p>Area: {{$education->area}}</p>
                        <p>{{$education->condition}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</form>
