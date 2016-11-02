@extends('layouts.auth')

@section('content')
    <div class="section">
        <div class="valign-wrapper mh-75vh">
            <div class="container valign">
                <div class="row">
                    <div class="col l6 offset-l0 m10 offset-m1 s10 offset-s1">
                        <div class="row center-align">
                            <h4>Sign Up</h4>
                            <p>
                                Some text<br/>a...
                            </p>
                        </div>
                        <div class="row">
                            <div class="col m6 s12 align-m-right align-s-centre">
                                <p>
                                    <button class="btn btn-large z-depth-half full-width">
                                        Sign Up with Facebook
                                    </button>
                                </p>
                            </div>
                            <div class="col m6 s12 align-m-left align-s-centre">
                                <p>
                                    <button class="btn btn-large z-depth-half full-width">
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
                    <form id="reg-form" class="col l5 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half" role="form" method="post"
                          action="{{ url()->route('auth.signup') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col s12">
                                <h6 class="font-bold">Sign Up with email and phone</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="first_name" name="first_name" type="text" class="validate">
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="last_name" name="last_name" type="text" class="validate">
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="email" name="email" type="email" class="validate" required>
                                <label for="email">Email</label>
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
                                <button type="submit" class="btn z-depth-half">
                                    Sign Me Up Now !
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
            $('#reg-form').submit(function (e) {
                e.preventDefault();
                $this = $('#reg-form');

                $.post($this.prop('action'), $this.serialize(), null, 'json')
                        .done(function (response) {
                            if (response.status == true) {
                                window.location = response.redirect;
                            }
                            else {
                                notify($('#notify'), response);
                            }
                        })
                        .fail(function (xhr) {
                            if(xhr.status == 422){
                                var text = [];
                                var response = xhr.responseJSON;
                                if('email' in response) {
                                    text.push(response.email.join("<br/>"));
                                }
                                if('phone' in response) {
                                    text.push(response.phone.join("<br/>"));
                                }
                                if('password' in response) {
                                    text.push(response.password.join("<br/>"));
                                }
                                var notification = {
                                    'message' : text.join('<br/>'),
                                    'status' : false
                                };
                                notify($('#notify'), notification);
                            }
                        });
            });
        });
    </script>
@endsection
