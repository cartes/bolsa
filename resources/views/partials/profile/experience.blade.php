<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form" action="{{route('profile.experience')}}" method="post">
            <h3 class="text-center">Agregar Experiencia</h3>
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
                    <label>Actividad de la empresa</label>
                    <input class="form-control {{$errors->has('business_activity') ? 'is-invalid' : ''}}"
                           name="business_activity" value="{{old('business_activity')}}"/>
                    @if($errors->has('business_activity'))
                        <span class="invalid-feedback">{{$errors->first('business_activity')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Puesto</label>
                    <input class="form-control {{$errors->has('business_position') ? 'is-invalid' : ''}}"
                           name="business_position" value="{{old('business_position')}}"/>
                    @if($errors->has('business_position'))
                        <span class="invalid-feedback">{{$errors->first('business_position')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Nivel de experiencia</label>
                    <select class="form-control {{$errors->has('business_activity') ? 'is-invalid' : ''}}"
                            name="experience_level" value="{{old('experience_level')}}">
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
                <div class="form-group col-md-6">
                    <label>País</label>
                    <input class="form-control {{$errors->has('business_country') ? 'is-invalid' : ''}}"
                           name="business_country" value="{{old('business_country')}}"/>
                    @if($errors->has('business_country'))
                        <span class="invalid-feedback">{{$errors->first('business_country')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Desde</label>
                </div>
                <div class="form-group col-md-6">
                    <label>Hasta</label>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control {{$errors->has('month_from') ? 'is-invalid' : ''}}"
                            name="month_from">
                        <option value="" {{old('month_from') == '' ? 'selected' : ''}}>Mes</option>
                        <option value="01" {{old('month_from') == '01' ? 'selected' : ''}}>Ene</option>
                        <option value="02" {{old('month_from') == '02' ? 'selected' : ''}}>Feb</option>
                        <option value="03" {{old('month_from') == '03' ? 'selected' : ''}}>Mar</option>
                        <option value="04" {{old('month_from') == '04' ? 'selected' : ''}}>Abr</option>
                        <option value="05" {{old('month_from') == '05' ? 'selected' : ''}}>May</option>
                        <option value="06" {{old('month_from') == '06' ? 'selected' : ''}}>Jun</option>
                        <option value="07" {{old('month_from') == '07' ? 'selected' : ''}}>Jul</option>
                        <option value="08" {{old('month_from') == '08' ? 'selected' : ''}}>Ago</option>
                        <option value="09" {{old('month_from') == '09' ? 'selected' : ''}}>Sep</option>
                        <option value="10" {{old('month_from') == '10' ? 'selected' : ''}}>Oct</option>
                        <option value="11" {{old('month_from') == '11' ? 'selected' : ''}}>Nov</option>
                        <option value="12" {{old('month_from') == '12' ? 'selected' : ''}}>Dic</option>
                    </select>
                    @if($errors->has('month_from'))
                        <span class="invalid-feedback">{{$errors->first('month_from')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control {{$errors->has('year_from') ? 'is-invalid' : ''}}"
                           name="year_from" value="{{old('year_from')}}" placeholder="Año"/>
                    @if($errors->has('year_from'))
                        <span class="invalid-feedback">{{$errors->first('year_from')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control {{$errors->has('month_to') ? 'is-invalid' : ''}}"
                            name="month_to">
                        <option value="" {{old('month_to') == '' ? 'selected' : ''}}>Mes</option>
                        <option value="01" {{old('month_to') == '01' ? 'selected' : ''}}>Ene</option>
                        <option value="02" {{old('month_to') == '02' ? 'selected' : ''}}>Feb</option>
                        <option value="03" {{old('month_to') == '03' ? 'selected' : ''}}>Mar</option>
                        <option value="04" {{old('month_to') == '04' ? 'selected' : ''}}>Abr</option>
                        <option value="05" {{old('month_to') == '05' ? 'selected' : ''}}>May</option>
                        <option value="06" {{old('month_to') == '06' ? 'selected' : ''}}>Jun</option>
                        <option value="07" {{old('month_to') == '07' ? 'selected' : ''}}>Jul</option>
                        <option value="08" {{old('month_to') == '08' ? 'selected' : ''}}>Ago</option>
                        <option value="09" {{old('month_to') == '09' ? 'selected' : ''}}>Sep</option>
                        <option value="10" {{old('month_to') == '10' ? 'selected' : ''}}>Oct</option>
                        <option value="11" {{old('month_to') == '11' ? 'selected' : ''}}>Nov</option>
                        <option value="12" {{old('month_to') == '12' ? 'selected' : ''}}>Dic</option>
                    </select>
                    @if($errors->has('month_to'))
                        <span class="invalid-feedback">{{$errors->first('month_to')}}</span>
                    @endif
                    <input type="checkbox" class="form-group" name="to_present" {{old('to_present') ? 'checked' : ''}}/>
                    <label>Al presente</label>
                </div>
                <div class="form-group col-md-3">
                    <input class="form-control {{$errors->has('year_to') ? 'is-invalid' : ''}}"
                           name="year_to" value="{{old('year_to')}}" placeholder="Año"/>
                    @if($errors->has('year_to'))
                        <span class="invalid-feedback">{{$errors->first('year_to')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Área</label>
                    <input class="form-control {{$errors->has('area') ? 'is-invalid' : ''}}"
                           name="area" value="{{old('area')}}"/>
                    @if($errors->has('area'))
                        <span class="invalid-feedback">{{$errors->first('area')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label>Subárea</label>
                    <input class="form-control {{$errors->has('sub_area') ? 'is-invalid' : ''}}"
                           name="sub_area" value="{{old('sub_area')}}"/>
                    @if($errors->has('sub_area'))
                        <span class="invalid-feedback">{{$errors->first('sub_area')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Descripción</label>
                    <textarea name="description"
                              class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"> {{old('description')}}
                    </textarea>
                    @if($errors->has('description'))
                        <span class="invalid-feedback">{{$errors->first('description')}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Personas a cargo</label>
                    <input class="form-control {{$errors->has('dependents') ? 'is-invalid' : ''}}"
                           name="dependents" type="text"/>
                    @if($errors->has('dependents'))
                        <span class="invalid-feedback">{{$errors->first('dependents')}}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </form>
    </div>
    @if($user->userExperience)
        <div class="file col-md-8 my-2">
            <h3 class="text-center">Experiencia laboral</h3>
            @foreach($user->userExperience as $experience)
                <div class="card my-3">
                    <div class="card-header">
                        <h4>{{$experience->business_position}}</h4>
                        <p>
                            {{$experience->month_from}} {{$experience->year_from}} -
                            {{$experience->month_to}}&nbsp;{{$experience->year_to}}
                        </p>
                    </div>
                    <div class="card-body">
                        {{$experience->description}}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

