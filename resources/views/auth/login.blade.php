@extends('layouts.auth')

@section('content')
    <div class="section">
        <div class="valign-wrapper mh-75vh">
            <div class="container valign">
                <div class="row">

                    <div class="col l6 offset-l0 m10 offset-m1 s10 offset-s1">
                        <div class="row">
                            <div class="col s12">
                                <h4>One click away!</h4>
                                <p class="font-lg">
                                    {{app_info('description.short')}}
                                    Log in now to start contributing to better education for all.
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m6 s12 align-m-right align-s-centre">
                                <p>
                                    <button class="btn btn-large z-depth-half full-width">
                                        Log In with Facebook
                                    </button>
                                </p>
                            </div>
                            <div class="col m6 s12 align-m-left align-s-centre">
                                <p>
                                    <button class="btn btn-large z-depth-half full-width">
                                        Log In with Google
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

                    <form id="login-form" class="col l5 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half" role="form" method="POST"
                          action="{{ url()->route('auth.login') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col s12">
                                <h5 class="font-bold">Log in with E-mail</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" class="validate" required>
                                <label for="email">E-mail Address</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" name="password" type="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="center-align">
                            <p id="notify" style="display: none;"></p>
                        </div>

                        <div class="row">
                            <div class="col m8 s12">
                                <p class="left-align">
                                    <input type="checkbox" name="remember" class="filled-in" id="remember" checked="checked"/>
                                    <label for="remember">
                                        Remember me on this
                                        <span class="hide-on-med-and-down">computer</span>
                                        <span class="hide-on-large-only">device</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col m4 s12 right-align">
                                <button type="submit" class="btn z-depth-half">
                                    Log Me In
                                </button>
                            </div>
                        </div>

                        <div class="row divider"></div>
                        <div class="row center-align">
                            <div class="col s6">
                                <a href="{{ url()->route('auth.signup') }}" class="font-sm">
                                    <span class="hide-on-small-only">Don't have an account?</span> Sign Up
                                </a>
                            </div>
                            <div class="col s6">
                                <a href="{{ url()->route('auth.password.reset') }}" class="font-sm">
                                    <span class="hide-on-small-only">Forgot Your Password?</span> Reset Password
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
            var form = $('#login-form');
            form.submit(function (e) {
                e.preventDefault();
                $this = $('#login-form');

                $.post($this.prop('action'), $this.serialize(), null, 'json')
                        .done(function (response) {
                            if (response.status == true) {
                                notify($('#notify'), response);
                                setTimeout(function () {
                                    window.location = response.data.redirect;
                                }, 1000);
                            } else {
                                notify($('#notify'), response);
                            }
                        })
                        .fail(function (xhr) {
                            handleHttpErrors(xhr, form)
                        });
            });
        });
    </script>
@endsection
