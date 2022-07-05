<form class="form" method="post" action="{{ route('profile.skills') }}">
    <h4 class="text-left">Habilidades</h4>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-12">
            <label>Conocimientos</label>
            <input class="form-control{{$errors->has('skill') ? ' is-invalid' : ''}}" name="skill"
                   value="{{old('skill')}}"/>
            @if($errors->has('skill'))
                <span class="invalid-feedback">{{$errors->first('skill')}}</span>
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
                            <span class="badge-xl badge-pill badge-info p-2 mr-2">
                                <span class="p-3 text-white">{{$skill->skill}}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</form>