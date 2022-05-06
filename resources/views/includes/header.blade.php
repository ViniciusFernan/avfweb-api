<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'AVFWEB') }}</title>

<?php
$colorBusc = array('#2baaea', '#3FE69E', '#F98829', '#9264AA', '#db0a5b', '#27ae60', '#f2d710');
$pos = array_rand($colorBusc);

$GLOBALS['AVFWEB_COLOR'] = $colorBusc[$pos];

?>

<meta name="theme-color" content="<?= $GLOBALS['AVFWEB_COLOR']?>">
<meta name="msapplication-navbutton-color" content="<?= $GLOBALS['AVFWEB_COLOR']?>">
<meta name="apple-mobile-web-app-status-bar-style" content="<?= $GLOBALS['AVFWEB_COLOR']?>">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ config('app.name', 'AVFWEB') }}">
<meta name="author" content="Vinicius Fernandes">

<link rel="shortcut icon" sizes=”50x50” href="{{url('/assets/images/favicon.png')}}" />

<!-- Custom fonts for this template-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet">--}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" rel="stylesheet">


<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<style>
    .spinner-box{
        background: rgb(0 0 0 /80%);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 99999;
    }
    .spinner-border{
        position: absolute;
        top: 50%;
        left: 45%;
        z-index: 999;
        width: 100px;
        height: 100px;
        font-size: 38px;
        color: #0d6efd;
    }

</style>
