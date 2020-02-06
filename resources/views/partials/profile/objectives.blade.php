<div class="row justify-content-center">
    <div class="col-md-8">
        <form class="form" method="post" action="{{ route('profile.objectives') }}">
            <h3 class="text-center">Objetivo Laboral</h3>
            @csrf
            @method("PUT")
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Objetivos laborales</label>
                    <textarea name="objectives"
                              class="form-control {{$errors->has('objectives')}}">{{old('objectives')}}</textarea>
                    @if($errors->has('objectives'))
                        <span class="invalid-feedback">{{$errors->first('objectives')}}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar los Datos</button>
        </form>
    </div>

        <div class="file col-md-8 my-2">
            <h3 class="text-center">Objetivos Laborales</h3>
            <p>
                {{$user->UserMeta->objectives ?? ''}}
            </p>
        </div>
</div>

