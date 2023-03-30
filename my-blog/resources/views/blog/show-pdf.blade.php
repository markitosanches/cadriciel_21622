<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            text-align: justify;
        }
    </style>
</head>
<body>
    <h3>{{$blogPost->title}}</h3>
    <hr>
    <p>
        {!! $blogPost->body !!}
    </p>
    <hr>
        Author : {{$blogPost->blogHasUser->name}}
</body>
</html>