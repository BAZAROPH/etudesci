<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
</head>
<body>
    <style>
        @page {
            margin: 0 !important;
            padding: 0 !important;
        }
        .name{
            top: 40%;
            position: absolute;
            color: #143F7C;
            font-size: 4em;;
            left:10%;
            right: 10%;
            text-align: center;
            font-weight: bold;
        }
        .onlineclass{
            position: absolute;
            top: 60%;
            text-align: center;
            left:10%;
            right: 10%;
            color: #143F7C;
            font-size: 1em;
        }
        .trainer{
            position: absolute;
            top: 65%;
            left:28%;
            right: 10%;
            color: #143F7C;
        }
        .trainer-name{
            font-weight: bold;
            font-size: 1.3em;
        }
        .trainer-post{
            font-size: 1em;
            padding-left: 2px;
            font-weight: 100
        }
        .certificate-id{
            position: absolute;
            top: 88.2%;
            right: 13%;
            color: #143F7C;
            font-size: 1em;
            font-weight: 100;
        }
    </style>
    <div class=" " style="position:relative; max-width:100%; max-height:100%;">
        <div class="name">
            {{$name}}
        </div>
        <div class="onlineclass">
            « {{$onlineclass}} ».
        </div>
        <div class="trainer">
            <span class='trainer-name'>{{$trainer}}</span><span class="trainer-post">, {{$post}}</span>
        </div>
        <div class="certificate-id">
            {{$id}}
        </div>
        <img src="{{$base}}" style="height: 100%; width:100%" alt="">
    </div>
</body>
</html>
