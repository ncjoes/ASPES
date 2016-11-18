@extends('layouts.auth')

@section('content')
    <div class="section">
        <div class="valign-wrapper mh-75vh">
            <div class="container valign">
                <div class="row">
                    <div class="col l5 offset-l0 m10 offset-m1 s10 offset-s1">
                        <div class="row">
                            <h4>Lets get your opinions heard!</h4>
                            <p class="font-lg">
                                {{app_info('description.short')}}
                                Sign up now to start contributing to better education for all.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col m6 s12 align-m-right align-s-centre">
                                <p>
                                    <button class="btn btn-large blue darken-3 white-text z-depth-half full-width">
                                        Sign Up with Facebook
                                    </button>
                                </p>
                            </div>
                            <div class="col m6 s12 align-m-left align-s-centre">
                                <p>
                                    <button class="btn btn-large red darken-1 white-text z-depth-half full-width">
                                        Sign Up with Google
                                    </button>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="divider col s5"></div>
                            <div class="col s2 center-align">OR</div>
                            <div class="divider col s5"></div>
                        </div>
                    </div>
                    <form id="reg-form" class="col l6 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half" role="form" method="post"
                          action="{{ url()->route('auth.signup') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col s12">
                                <h5 class="font-bold">Sign Up with E-mail</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="first_name" name="first_name" type="text" class="validate" required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="last_name" name="last_name" type="text" class="validate" required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="email" name="email" type="email" class="validate" required>
                                <label for="email">E-mail</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="phone" name="phone" type="tel" class="validate">
                                <label for="phone">Phone Number (optional)</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="password" name="password" type="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="password_confirmation" name="password_confirmation" type="password" class="validate" required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>
                        </div>
                        <div class="center-align">
                            <p id="notify" style="display: none;"></p>
                        </div>

                        <div class="row">
                            <div class="col m8 s12">
                                <p class="left-align">
                                    By clicking Sign Up, you agree to our Terms.
                                </p>
                            </div>
                            <div class="input-field col m4 s12 right-align">
                                <button type="submit" class="btn blue white-text z-depth-half">
                                    <i class="material-icons right">add</i>
                                    Sign Up!
                                </button>
                            </div>
                        </div>

                        <div class="row divider"></div>
                        <div class="row center-align">
                            <div class="col s12">
                                <a href="{{ url()->route('auth.login') }}">
                                    Already have an account? Log In
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_scripts')
    <script src="{{ asset('js/app.utils.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var form = $('#reg-form');
            form.submit(function (e) {
                e.preventDefault();
                var $this = $('#reg-form');

                try {
                    $.post($this.prop('action'), $this.serialize(), null, 'json')
                            .done(function (response) {
                                if (response.status == true) {
                                    notify($('#notify'), response);
                                    setTimeout(function () {
                                        window.location = response.data.redirect;
                                    }, 1000);
                                }
                                else {
                                    notify($('#notify'), response);
                                }
                            })
                            .fail(function (xhr) {
                                handleHttpErrors(xhr, form)
                            });
                }
                catch (e) {
                    console.log(e)
                }
            });
        });
    </script>
@endsection
