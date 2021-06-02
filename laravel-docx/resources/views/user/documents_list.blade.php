<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/documents_list.css')}}">
    <title>Documents</title>
</head>
<body>
    @include('user.header')
<div class="application-list">
    <h1>Созданные документы:</h1>
    <ul class="list_overflow">
        @foreach($votings as $voting)
            <li>
                <a class="application-list-btn" href="{{route('voting_docx_page',['id'=>$voting->id])}}">
                    Документ от: {{$voting->created_at}}
                </a>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>