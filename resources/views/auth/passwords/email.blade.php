@extends('layouts.auth')

@section('content')
    <div class="section">
        <div class="valign-wrapper mh-75vh">
            <div class="container valign">
                <div class="row">

                    <div class="col l6 offset-l0 m10 offset-m1 s10 offset-s1">
                        <div class="row center-align">
                            <h3>No Worries</h3>
                            <h5 class="font-bold">
                                We all forget sometimes...
                            </h5>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s12">
                            </div>
                        </div>
                    </div>

                    <form id="email-form" class="col l5 offset-l1 m10 offset-m1 s10 offset-s1 valign white z-depth-half" role="form" method="POST"
                          action="{{ url()->route('auth.password.email') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col s12 center-align">
                                <h5 class="font-bold">Get a Password Reset Link</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" class="validate" required>
                                <label for="email">E-Mail Address</label>
                            </div>
                        </div>
                        <div class="center-align">
                            <p id="notify" style="display: none;"></p>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 right-align">
                                <button type="submit" class="btn blue white-text z-depth-half">
                                    <i class="material-icons right">send</i>
                                    Send Password Reset Link
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
                                <a href="{{ url()->route('auth.login') }}" class="font-sm">
                                    Log-In with email
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
            var form = $('#email-form');
            form.submit(function (e) {
                e.preventDefault();
                $this = $('#email-form');

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
                            handleHttpErrors(xhr, form)
                        });
            });
        });
    </script>
@endsection
