<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <title>Profile</title>
</head>
<body>

@include('user.header')

<div class="form__wrapper">
    <form id="CreateVoting" action="{{route('create_voting')}}" method="post">
        @csrf
        <h1>Создать Документ для голосования</h1>
        <div class="fields">
            <label for="voting_type_name">Вид голосования:</label></br>
            <input id="voting_type_name" list="voting_type_name" type="text" name="voting_type_name">
            <datalist id="voting_type_name">
                @foreach($voting_types as $voting_type)
                    <option value="{{$voting_type->name}}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="fields">
            <label for="plot_number">Номер участка:</label></br>
            <input id="plot_number" type="number" name="plot_number">
        </div>
        <div class="fields">
            <label for="chairman">Председатель:</label></br>
            <input type="text" name="chairman"></br>
            <label for="chairman_workplace">Место работы:</label></br>
            <input id="chairman_workplace" type="text" name="chairman_workplace">
        </div>
        <div class="fields">
            <label for="vice_chairman">Заместитель председателя:</label></br>
            <input id="vice_chairman" type="text" name="vice_chairman"></br>
            <label for="vice_chairman_workplace">Место работы:</label></br>
            <input id="vice_chairman_workplace" type="text" name="vice_chairman_workplace">
        </div>
        <div class="fields">
            <label for="secretary">Секретарь:</label></br>
            <input id="secretary" type="text" name="secretary"></br>
            <label for="secretary_workplace">Место работы:</label></br>
            <input id="secretary_workplace" type="text" name="secretary_workplace">
        </div>


        <h2>Штат сотрудников:</h2>

        <div id="WorkersList" class="list_overflow">

        </div>

        <div class="block-btn">
            <button id="CreateInputBtn" class="btn-blue" type="button" class="btn">
                + Добавить поле
            </button>
            <button id="DeleteInputBtn" class="btn-danger" type="button" class="btn">
                - Удалить поле
            </button>
        </div>
        <div class="block-btn">
            <button id="CreateVotingBtn" class="btn-submit" type="submit" form="CreateVoting" class="btn">
                Создать новую запись
            </button>
        </div>
    </form>
</div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>




</body>
</html>
