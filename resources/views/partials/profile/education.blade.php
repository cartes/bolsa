<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form" action="{{route('profile.education')}}" method="post">
            <h3 class="text-center">Educación</h3>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label>País</label>
                    <input class="form-control {{$errors->has('country_st') ? 'is-invalid' : ''}}"
                           name="country_st" value="{{old('country_st')}}"/>
                    @if($errors->has('country_st'))
                        <span class="invalid-feedback">{{$errors->first('country_st')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Tipo de estudio</label>
                    <select class="form-control {{$errors->has('studies') ? 'is-invalid' : ''}}"
                            name="studies" value="{{old('studies')}}">
                        <option value="" {{old('studies') == '' ? 'selected' : ''}}>Seleccionar</option>
                        <option value="1" {{old('studies') == '1' ? 'selected' : ''}}>Secundario</option>
                        <option value="2" {{old('studies') == '2' ? 'selected' : ''}}>Terciario</option>
                        <option value="3" {{old('studies') == '3' ? 'selected' : ''}}>Universitario</option>
                        <option value="4" {{old('studies') == '4' ? 'selected' : ''}}>Posgrado</option>
                        <option value="5" {{old('studies') == '5' ? 'selected' : ''}}>Master</option>
                    </select>
                    @if($errors->has('studies'))
                        <span class="invalid-feedback">{{$errors->first('studies')}}</span>
                    @endif
                </div>
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
            </div>
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
                    <label>Área</label>
                    <input class="form-control {{$errors->has('area_st') ? 'is-invalid' : ''}}"
                           name="area_st" value="{{old('area_st')}}"/>
                    @if($errors->has('area_st'))
                        <span class="invalid-feedback">{{$errors->first('area_st')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Fecha Inicio</label>
                </div>
                <div class="form-group col-md-6">
                    <label>Fecha de Fin</label>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control {{$errors->has('month_from_st') ? 'is_invalid' : ''}}"
                            name="month_from_st">
                        <option value="" {{old('month_from_st') == '' ? 'selected' : ''}}>Mes</option>
                        <option value="01" {{old('month_from_st') == '01' ? 'selected' : ''}}>Ene</option>
                        <option value="02" {{old('month_from_st') == '02' ? 'selected' : ''}}>Feb</option>
                        <option value="03" {{old('month_from_st') == '03' ? 'selected' : ''}}>Mar</option>
                        <option value="04" {{old('month_from_st') == '04' ? 'selected' : ''}}>Abr</option>
                        <option value="05" {{old('month_from_st') == '05' ? 'selected' : ''}}>May</option>
                        <option value="06" {{old('month_from_st') == '06' ? 'selected' : ''}}>Jun</option>
                        <option value="07" {{old('month_from_st') == '07' ? 'selected' : ''}}>Jul</option>
                        <option value="08" {{old('month_from_st') == '08' ? 'selected' : ''}}>Ago</option>
                        <option value="09" {{old('month_from_st') == '09' ? 'selected' : ''}}>Sep</option>
                        <option value="10" {{old('month_from_st') == '10' ? 'selected' : ''}}>Oct</option>
                        <option value="11" {{old('month_from_st') == '11' ? 'selected' : ''}}>Nov</option>
                        <option value="12" {{old('month_from_st') == '12' ? 'selected' : ''}}>Dic</option>
                    </select>
                    @if($errors->has('month_from_st'))
                        <span class="invalid-feedback">{{$errors->first('month_from_st')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control {{$errors->has('year_from_st') ? 'is-invalid' : ''}}"
                           name="year_from_st" value="{{old('year_from_st')}}" placeholder="Año"/>
                    @if($errors->has('year_from_st'))
                        <span class="invalid-feedback">{{$errors->first('year_from_st')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control {{$errors->has('month_to_st') ? 'is_invalid' : ''}}"
                            name="month_to_st">
                        <option value="" {{old('month_to_st') == '' ? 'selected' : ''}}>Mes</option>
                        <option value="01" {{old('month_to_st') == '01' ? 'selected' : ''}}>Ene</option>
                        <option value="02" {{old('month_to_st') == '02' ? 'selected' : ''}}>Feb</option>
                        <option value="03" {{old('month_to_st') == '03' ? 'selected' : ''}}>Mar</option>
                        <option value="04" {{old('month_to_st') == '04' ? 'selected' : ''}}>Abr</option>
                        <option value="05" {{old('month_to_st') == '05' ? 'selected' : ''}}>May</option>
                        <option value="06" {{old('month_to_st') == '06' ? 'selected' : ''}}>Jun</option>
                        <option value="07" {{old('month_to_st') == '07' ? 'selected' : ''}}>Jul</option>
                        <option value="08" {{old('month_to_st') == '08' ? 'selected' : ''}}>Ago</option>
                        <option value="09" {{old('month_to_st') == '09' ? 'selected' : ''}}>Sep</option>
                        <option value="10" {{old('month_to_st') == '10' ? 'selected' : ''}}>Oct</option>
                        <option value="11" {{old('month_to_st') == '11' ? 'selected' : ''}}>Nov</option>
                        <option value="12" {{old('month_to_st') == '12' ? 'selected' : ''}}>Dic</option>
                    </select>
                    @if($errors->has('month_to_st'))
                        <span class="invalid-feedback">{{$errors->first('month_to_st')}}</span>
                    @endif
                    <input type="checkbox" class="form-group"
                           name="to_present_st" {{old('to_present_st') ? 'checked' : ''}}/>
                    <label>Al presente</label>
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control {{$errors->has('year_to_st') ? 'is-invalid' : ''}}"
                           name="year_to_st" value="{{old('year_to_st')}}" placeholder="Año"/>
                    @if($errors->has('year_to_st'))
                        <span class="invalid-feedback">{{$errors->first('year_to_st')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Institución</label>
                    <input class="form-control {{$errors->has('institution') ? 'is-invalid' : ''}}"
                           name="institution" value="{{old('institution')}}"/>
                    @if($errors->has('institution'))
                        <span class="invalid-feedback">{{$errors->first('institution')}}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </form>
    </div>
</div>

@if($user->userEducation)
    @foreach($user->userEducation as $education)
        <div class="row justify-content-center my-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4><strong>{{$education->title}}</strong> en {{$education->institution}}</h4>
                        <p>
                            {{$education->month_from}} {{$education->year_from}} -
                            {{$education->month_to}} {{$education->year_to}}
                        </p>
                    </div>
                    <div class="card-body">
                        <p>Area: {{$education->area}}</p>
                        <p>{{$education->condition}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif