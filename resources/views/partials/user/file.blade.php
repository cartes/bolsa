<div class="row justify-content-center">
    <div class="col-sm-10">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Perfil de {{ $user->name }} {{ $user->surname }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <p>Email: <strong>{{$user->email}}</strong></p>
                        <p>Teléfono: <strong>{{ $user->userMeta->phone }}</strong></p>
                        <p>Nacionalidad: <strong>{{ $user->nacionality }}</strong></p>
                    </div>
                    <div class="col-6">
                        <p>Género: <strong>{{$user->gender}}</strong></p>
                        <p>Estado Civil: <strong>{{ $user->marital_status }}</strong></p>
                        <p>Edad: <strong>{{ $user->age }}</strong></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <p>Pretensiones de renta: <strong>{{ $user->userMeta->pretentions }}</strong></p>
                    </div>
                    <div class="col-6">
                        <p>Objetivos Laborales: </p>
                        {!! $user->userMeta->objectives !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4>Educación</h4>
                        @foreach($user->userEducation as $education)
                            <p>
                                Estudió <strong>{{ $education->title }}</strong> en
                                <strong>{{ $education->institution }}</strong> |
                                Status: {{$education->condition}} |
                                Desde: {{$education->month_from}} {{$education->year_from}} |
                                Hasta: {{$education->month_to}} {{$education->year_to}} |
                                Área: {{$education->area}}
                            </p>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>Experiencia</h4>
                        @foreach($user->userExperience as $experience)
                            <p><strong>Institución: {{ $experience->business_name }},
                                    empresa {{ $experience->business_activity }}</strong> |
                                Cargo: {{ $experience->business_position }} |
                                Tiempo: {{$experience->date_diff}} | Área: {{ $experience->area }},
                                {{$experience->sub_area}} | <br/>
                                <strong>Descripción:</strong> {{ $experience->description }}
                            </p>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4>Idiomas</h4>
                        @foreach($user->userLanguage as $language)
                            <p>
                                Idioma: {{$language->language}} | Nivel hablado: {{ $language->level_spoken }} |
                                Nivel escrito: {{ $language->level_written }}
                            </p>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h4>Conocimientos</h4>
                        @foreach($user->userSkills as $skill)
                            <h4 class="d-inline-block">
                                <span class="badge badge-pill badge-secondary">{{$skill->skill}}</span>
                            </h4>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
