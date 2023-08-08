<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <x-partials.core-css />
    <link rel="stylesheet" href="{{ asset("css/pages/LOG/A01.css") }}">
</head>
<body class="hold-transition sidebar-mini">
    <x-partials.overlay />
    <x-messages.alert />
    <div class="wrapper">
        <div class="row">
            <div class="col-md-4 mx-auto" style="margin: 100px">
                <div class="card card-info" style="padding: 30px">
                    <x-forms.base action="login-a01" id="login-form" method="POST">
                        <x-slot name="slot">
                            <div class="card-header text-center">
                                <h3>LOGIN</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <x-forms.text.text-group :isRequired="true" name="email" idSelector="email" label="Email:" />
                                </div>
                                <div class="row">
                                    <x-forms.input.input-group type="password" label="Password:" :isRequired="true" name="password" idSelector="password" />
                                </div>
                            </div>
                            <x-messages.error />
                            <div class="card-footer" style="background-color:white">
                                <div class="row">
                                    <button id="login-button" type="submit" class="btn btn-info" style="min-width:50%">Login</button>
                                </div>
                            </div>
                        </x-slot>
                    </x-forms.base>
                </div>
            </div>
        </div>
    </div>
    <x-partials.core-js />
</body>
<script type="module" src="{{ asset('js/pages/Log/A01.js') }}"></script>
<script>
</script>
</html>
