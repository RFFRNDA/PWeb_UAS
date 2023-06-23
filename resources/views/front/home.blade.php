<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Inventory</title>

    <style>    
        @import url('https://fonts.googleapis.com/css2?family=Faustina:wght@500&display=swap');     

        img{
            max-width: 100%;
            height: 100vh;
        }
        .start{
            position: absolute;
            height: 50px;
            width: 110px;
            bottom: 205px;
            right: 46vw;    
              
        }
        .title{
            position: absolute;
            height: 50px;
            width: 250px;
            top: 120px;
            right: 41vw;
            
        }

        .start h1 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            text-align: center;
            line-height: .9;    
            font-size: 28px;     
            color: black
        }

        .start h1:hover{
            cursor: pointer;
            font-size: 30px
        }
        .title h1 {
            font-family:'Faustina', serif;
            font-size: 40px;
            text-align: center;
            line-height: .9;         
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets\img\inventory.jpg') }}" alt="asset">
    </div>   
    <a href="{{ route('admin.login') }}">
        <div class="start">
            <h1>
                Get Started    
            </h1>
        </div>
    </a>
    <div class="title">
        <h1>My Inventory</h1>
    </div>
</body>
</html>