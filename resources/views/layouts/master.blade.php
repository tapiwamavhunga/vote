<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>eVoting</title>
  <meta name="description" content="eVoting">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body>
  <div id="app">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('info'))
    <div class="alert alert-info" role="alert">
      {{Session::get('info')}}
    </div>
    @endif
    @if(Session::has('danger'))
    <div class="alert alert-danger" role="alert">
      {{Session::get('danger')}}
    </div>
    @endif
    <dashboard-component></dashboard-component>
    <vue-progress-bar></vue-progress-bar>
  </div>
  @auth
  <script>
  window.user = @json(auth()->user())
</script>
@endauth
<script>
  var APP_URL = {!! json_encode(url('/')) !!} 
</script>
  <script src="/js/app.js"></script>
</body>
</html> 