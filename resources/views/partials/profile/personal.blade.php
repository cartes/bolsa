<form class="form" action="{{route('profile.update')}}" method="post">
    <h4 class="text-left">Completa tu información personal, para tener mayor visibilidad de los Empleadores.</h4>
    @method('PUT')
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label>Ciudad (*)</label>
            <input class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}"
                   name="city" value="{{old('city') ?? $user->userMeta->city ?? ''}}"/>
            @if($errors->has('city'))
                <span class="invalid-feedback">{{$errors->first('city')}}</span>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label>Nacionalidad(*)</label>
            <input class="form-control {{$errors->has('nacionality') ? 'is-invalid' : ''}}"
                   name="nacionality" value="{{old('nacionality') ?? $user->nacionality ?? ''}}">
            @if($errors->has('nacionality'))
                <span class="invalid-feedback">{{$errors->first('nacionality')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Género (*)</label>

            <select class="form-control{{$errors->has('gender') ? ' is-invalid' : ''}}" name="gender">
                <option value="" {{old('gender') == null && $user->gender == null ? "selected" : ""}}>
                    Seleccionar
                </option>
                <option value="1" {{old('gender') == "1" || $user->gender == "Masculino" ? 'selected' : ""}}>
                    Masculino
                </option>
                <option value="2" {{old('gender') == "2" || $user->gender == "Femenino" ? 'selected' : ""}}>
                    Femenino
                </option>
                <option value="3" {{old('gender') == "3" || $user->gender == "Otro" ? 'selected' : ""}}>
                    Otro
                </option>
            </select>
            @if($errors->has('gender'))
                <span class="invalid-feedback">{{$errors->first('gender')}}</span>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Fecha de Nacimiento (*)</label>
            <input class="form-control datepicker {{$errors->has('birthday') ? 'is-invalid' : ''}}"
                   name="birthday" value="{{old('birthday') ?? $user->birthday ?? ''}}">
            @if($errors->has('birthday'))
                <span class="invalid-feedback">{{$errors->first('birthday')}}</span>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>preferencia salarial (*)</label>
            <input class="form-control {{$errors->has('pretentions') ? 'is-invalid' : ''}}"
                   name="pretentions" value="{{old('pretentions') ?? $user->userMeta->pretentions ?? ''}}">
            @if($errors->has('pretentions'))
                <span class="invalid-feedback">{{$errors->first('pretentions')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-8">
            <label>Objetivos laborales (*)</label>
            <textarea name="objectives"
                      class="form-control{{$errors->has('objectives') ? " is-invalid" : ""}}">{{old('objectives') ?? $user->UserMeta->objectives ?? ''}}</textarea>
            @if($errors->has('objectives'))
                <span class="invalid-feedback">{{$errors->first('objectives')}}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </div>
    </div>
</form>
