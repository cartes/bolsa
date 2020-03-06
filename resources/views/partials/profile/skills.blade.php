<form class="form" method="post" action="{{ route('profile.skills') }}">
    <h4 class="text-left">Habilidades</h4>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-12">
            <label>Conocimientos</label>
            <input class="form-control {{$errors->has('country_st') ? 'is-invalid' : ''}}" name="skill"
                   value="{{old('skill')}}"/>
            @if($errors->has('country_st'))
                <span class="invalid-feedback">{{$errors->first('country_st')}}</span>
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar los Datos</button>

    @if($user->UserSkills)
        <div class="col-md-12 my-2">
            <div class="my-3">
                <div class="body">
                    <div class="align-content-center">
                        @foreach($user->UserSkills as $skill)
                            <span class="badge-xl badge-pill badge-info">{{$skill->skill}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</form>