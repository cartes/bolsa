<h3 class="text-center">Publica un Aviso</h3>

<form class="form-offer w-100 my-3">
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Puesto ofrecido</label>
            <input type="text" class="form-control {{$errors->has('title')}}" name="title"
                   value="{{old('title')}}"/>
            @if($errors->has('title'))
                <span class="invalid-feedback">{{$errors->first('title')}}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Descripción</label>
            <textarea id="contents" type="text" class="form-control {{$errors->has('description')}}"
                      name="description"
                      value="{{old('description')}}"></textarea>
            @if($errors->has('description'))
                <span class="invalid-feedback">{{$errors->first('description')}}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Área del puesto</label>
            <input type="text" name="area" class="form-control {{$errors->has('area')}}"
                   value="{{old('area')}}"/>
            @if($errors->has('area'))
                <span class="invalid-feedback">{{$errors->first('area')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Subárea del puesto</label>
            <input type="text" name="subarea" class="form-control {{$errors->has('subarea')}}"
                   value="{{old('subarea')}}"/>
            @if($errors->has('subarea'))
                <span class="invalid-feedback">{{$errors->first('subarea')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>País</label>
            <input type="text" name="country" class="form-control {{$errors->has('country')}}"
                   value="{{old('country')}}"/>
            @if($errors->has('country'))
                <span class="invalid-feedback">{{$errors->first('country')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Provincia</label>
            <input type="text" name="state" class="form-control {{$errors->has('state')}}"
                   value="{{old('state')}}"/>
            @if($errors->has('state'))
                <span class="invalid-feedback">{{$errors->first('state')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Ciudad</label>
            <input type="text" name="city" class="form-control {{$errors->has('city')}}"
                   value="{{old('city')}}"/>
            @if($errors->has('city'))
                <span class="invalid-feedback">{{$errors->first('city')}}</span>
            @endif
        </div>
        <div class="col-md-6 form-group">
            <label>Dirección</label>
            <input type="text" name="address" class="form-control {{$errors->has('address')}}"
                   value="{{old('address')}}"/>
            @if($errors->has('address'))
                <span class="invalid-feedback">{{$errors->first('address')}}</span>
            @endif
        </div>
    </div>
</form>
