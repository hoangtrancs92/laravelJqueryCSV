<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title> {{ $title }} </title>
    <x-partials.core-css />
    @stack('child-stylesheets')
</head>
<body class="hold-transition sidebar-mini layout-fixed  ">
    <x-partials.overlay />
    <x-messages.alert />
    <div class="wrapper">

        <x-partials.header :title="$title"/>
        <x-partials.sidebar title="Intern Training" />
        <div class="content-wrapper">
            <x-messages.error />
            {{ $slot }}
        </div>
    </div>
    <x-partials.core-js />
</body>
@stack('child-scripts')
</html>
