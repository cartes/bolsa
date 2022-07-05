<form class="form-offer w-100 my-3 p-4" method="post" action="{{ route('offer.create') }}">
    @csrf
    @method('PUT')
    <h4 class="text-left">Completa la información de la oferta que quieres publicar.</h4>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Cargo (*)</label>
            <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title"
                   value="{{old('title')}}"/>
            @if($errors->has('title'))
                <span class="invalid-feedback">{{$errors->first('title')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Tipo de puesto (*)</label>
            <select name="position" class="form-control{{$errors->has('position') ? ' is-invalid' : ''}}">
                <option>Seleccione un tipo</option>
                <option value="1" {{old('position') == 1 ? 'selected' : ''}}>Full-time</option>
                <option value="2" {{old('position') == 2 ? 'selected' : ''}}>Part-time</option>
                <option value="3" {{old('position') == 3 ? 'selected' : ''}}>Turnos</option>
            </select>
            @if($errors->has('position'))
                <span class="invalid-feedback">{{$errors->first('position')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Area Implementación (*)</label>
            <input type="text" name="area" class="form-control {{$errors->has('area') ? 'is-invalid' : ''}}"
                   value="{{old('area')}}"/>
            @if($errors->has('area'))
                <span class="invalid-feedback">{{$errors->first('area')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group">
            <label>Nivel de experiencia</label>
            <select class="form-control" name="experience">
                {{ old('experience') ?? '' }}
                <option value="">Seleccione un nivel</option>
                <option value="0">Indiferente</option>
                <option value="1" {{old('experience') == 1 ? 'selected' : ''}}>Junior</option>
                <option value="2" {{old('experience') == 2 ? 'selected' : ''}}>Semi-senior</option>
                <option value="3" {{old('experience') == 3 ? 'selected' : ''}}>Senior</option>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label>La oferta es inclusiva <i class="fas fa-wheelchair"></i></label>
            <select class="form-control" name="handicapped">
                <option value="">Seleccione</option>
                <option value="0" {{old('handicapped') == "0" ? 'selected' : ''}}>No</option>
                <option value="1" {{old('handicapped') == "1" ? 'selected' : ''}}>Si</option>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label>Renta ofrecida</label>
            <input class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}"
                   type="text" name="salary" value="{{ old('salary') }}"/>

            @if ($errors->has('salary'))
                <span class="invalid-feedback">{{ $errors->first('salary') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Descripción (*)</label>
            <textarea id="contents" type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                      name="description">{{old('description')}}</textarea>
            @if($errors->has('description'))
                <span class="invalid-feedback">{{$errors->first('description')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Requisitos</label>
            <textarea type="text" class="form-control{{ $errors->has('requirements') ? ' is-invalid' : '' }}"
                      name="requirements">{{ old('requirements') }}</textarea>
            @if ($errors->has('requirements'))
                <span class="invalid-feedback">{{ $errors->first('requirements') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Beneficios</label>
            <div class="row">
                <div class="col-12">
                    @php($i = 0)
                    @if (old('benefits'))
                        @foreach (old('benefits') as $benefit)
                            <div id='div_{{ $i++ }}' class='btn-benefit mr-3 mb-2 btn btn-secondary'>
                                {{ $benefit }}
                                <input name='benefits[]' type='hidden' value='{{ $benefit }}'/>
                            </div>
                        @endforeach
                    @endif
                    <div id="listBenefits" class="col-12">
                        <div class="btn-benefit" id="div_0"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-inline col-md-5">
                    <input class="form-control{{ $errors->has('benefit') ? ' is-invalid' : '' }}" name="benefit"/>
                </div>
                <div class="d-inline col-md-3">
                    <a id="addBenefit" href="#">Agregar Beneficio</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 my-0 py-0">
                    <small>Cuando agregue beneficios, los puede borrar si les da click en la etiqueta</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label>Vacantes</label>
            <div class="row">
                <div class="d-inline col-md-5">
                    <input class="form-control{{ $errors->has('vacancy') ? ' is-invalid' : '' }}" name="vacancy" value="{{ old('vacancy') ?? '' }}"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 my-2">
            <button class="btn btn-primary" type="submit">Publicar Aviso</button>
        </div>
    </div>
</form>
