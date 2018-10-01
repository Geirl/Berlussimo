<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href='{{mix('css/vendor.css')}}' rel='stylesheet' type='text/css'>
    @stack('head')
    <link href='{{mix('css/main.css')}}' rel='stylesheet' type='text/css'>
    <link href='{{mix('css/berlussimo.css')}}' rel='stylesheet' type='text/css'>
    <link href='{{mix('css/materialize-css.css')}}' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .application--wrap {
            min-height: auto;
        }
    </style>
</head>

<body style="display: flex; min-height: 100vh; flex-direction: column;">

<div id="top" style="position: sticky; top: 0; z-index: 2">
    <v-app dark>
        @if(Auth::check())
            <b-user-loader :user="{{Auth::user()}}"></b-user-loader>
            <b-global-select-loader
                    :partner="{{session()->has('partner_id') ? \App\Models\Partner::find(session()->get('partner_id')) : 'null'}}"
                    :objekt="{{ session()->has('objekt_id') ? \App\Models\Objekte::find(session()->get('objekt_id')) : 'null'}}"
                    :bankkonto="{{ session()->has('geldkonto_id') ? \App\Models\Bankkonten::find(session()->get('geldkonto_id')) : 'null'}}">
            </b-global-select-loader>
            <b-legacy-loader :is-legacy="true"></b-legacy-loader>
        @endif
        <b-toolbar></b-toolbar>
        <b-menu v-cloak>
            <div slot="mainmenu">@include('shared.menus.main')</div>
            <div v-cloak slot="submenu">
                <?php include(base_path($submenu)); ?>
            </div>
        </b-menu>
        <div>
            @include("shared.messages")
        </div>
    </v-app>
</div>

<div class="application theme--dark content" style="flex: 1 0 auto; flex-direction: column">
    @if($content != "")
        <div class="berlussimo-materialize container fluid">
            {!!$content!!}
        </div>
    @else
        <div class="berlussimo-materialize container fluid">
            @yield('content')
        </div>
    @endif
    @if(Auth::check())
        <b-notifications id="notifications" style="z-index: 1000"></b-notifications>
        <b-snackbar id="snackbar" style="z-index: 1010"></b-snackbar>
    @endif
</div>

<div id="bottom">
    <v-app dark>
        <b-footer></b-footer>
    </v-app>
</div>

<script type='text/javascript' src='{{mix('js/manifest.js')}}'></script>
<script type='text/javascript' src='{{mix('js/vendor.js')}}'></script>
<script type='text/javascript' src='{{mix('js/app-materialize.js')}}'></script>
<script type='text/javascript' src='{{mix('js/materialize.js')}}'></script>
<script type='text/javascript' src='{{mix('js/legacy.js')}}'></script>
@stack('scripts')

</body>
</html>