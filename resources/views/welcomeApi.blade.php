<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

</head>
<body class="gradient-bg ">
<div class="text-center full-height-flex ">
    <div class="conteiner">
        <h1 class="title mt-5">AVFWEB - API</h1>
        <div class="col-lg-6 mx-auto">
            <p class="mb-4"><b>SISTEMA | SITE | BLOG</b></p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <p  id="clock" ></p>
            </div>
        </div>
    </div>
</div>

</body>
<script>

    function relogio(){
        var data=new Date();
        var hor=data.getHours();
        var min=data.getMinutes();
        var seg=data.getSeconds();

        if(hor < 10) hor="0"+hor;
        if(min < 10) min="0"+min;
        if(seg < 10) seg="0"+seg;


        var currentTime=hor + ":" + min + ":" + seg;
        document.getElementById("clock").innerHTML = currentTime;
    }
    var timer=setInterval(relogio,1000);

</script>
</html>
