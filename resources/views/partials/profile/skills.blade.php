<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form" method="post" action="{{ route('profile.skills') }}">
            <h3 class="text-center">Conocimientos</h3>
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
        </form>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="align-content-center">
                    @if($user->UserSkills)
                        @foreach($user->UserSkills as $skill)
                            <span class="badge-xl badge-pill badge-info">{{$skill->skill}}</span>
                        @endforeach
                    @else
                        <p>Aun no has cargado ningún idioma que domines.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>