<form class="form-offer w-100 my-3 p-4" method="post" action="{{ route('create.offer') }}">
    @csrf
    @method('PUT')
    <h3 class="text-center">Publica un Aviso</h3>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Puesto ofrecido</label>
            <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title"
                   value="{{old('title')}}"/>
            @if($errors->has('title'))
                <span class="invalid-feedback">{{$errors->first('title')}}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Descripción</label>
            <textarea id="contents" type="text" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                      name="description">{{old('description')}}</textarea>
            @if($errors->has('description'))
                <span class="invalid-feedback">{{$errors->first('description')}}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Área del puesto</label>
            <input type="text" name="area" class="form-control {{$errors->has('area') ? 'is-invalid' : ''}}"
                   value="{{old('area')}}"/>
            @if($errors->has('area'))
                <span class="invalid-feedback">{{$errors->first('area')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Subárea del puesto</label>
            <input type="text" name="subarea" class="form-control {{$errors->has('subarea') ? 'is-invalid' : ''}}"
                   value="{{old('subarea')}}"/>
            @if($errors->has('subarea'))
                <span class="invalid-feedback">{{$errors->first('subarea')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>País</label>
            <input type="text" name="country" class="form-control {{$errors->has('country') ? 'is-invalid' : ''}}"
                   value="{{old('country')}}"/>
            @if($errors->has('country'))
                <span class="invalid-feedback">{{$errors->first('country')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Provincia</label>
            <input type="text" name="state" class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}"
                   value="{{old('state')}}"/>
            @if($errors->has('state'))
                <span class="invalid-feedback">{{$errors->first('state')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Ciudad</label>
            <input type="text" name="city" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}"
                   value="{{old('city')}}"/>
            @if($errors->has('city'))
                <span class="invalid-feedback">{{$errors->first('city')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Comuna</label>
            <input type="text" name="comune" class="form-control {{$errors->has('comune') ? 'is-invalid' : ''}}"
                   value="{{old('comune')}}"/>
            @if($errors->has('comune'))
                <span class="invalid-feedback">{{$errors->first('comune')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Dirección</label>
            <input type="text" name="address" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}"
                   value="{{old('address')}}"/>
            @if($errors->has('address'))
                <span class="invalid-feedback">{{$errors->first('address')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Renta Ofrecida</label>
            <input type="text" name="salary" class="form-control {{$errors->has('salary') ? 'is-invalid' : ''}}"
                   value="{{old('salary')}}"/>
            @if($errors->has('salary'))
                <span class="invalid-feedback">{{$errors->first('salary')}}</span>
            @endif
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Publicar Aviso</button>
</form>
