<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../../css/main-style.css">
    <link rel = "stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="shortcut icon" href="/img/flag.png" type="image/png">
    <script src='../../js/jquery.js'></script>
    <script src = '../../js/gradient.js'></script>
    <script src = "../../js/movemouse.js">   </script>
    <title>Страница подтверждения</title>
</head>
<body class = "body-1" id = "highlight2">
<div id="highlight"></div>
<div class = "img">
    <img src = "/img/olymp.png" class = "img-olymp">
    <img src = "/img/gerb.png" class = "img-gerb">
    <h3 class = "text-1"> </br>Астраханская</br>область</h3>
</div>
<div class="container box-1" id = "table-1">
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <h2>Название_Предмета Дата</h2>
        <table class="table table-bordered" id="myTable">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Класс участия</th>
                <th scope="col">Учебное учреждение</th>
                <th scope="col">Обоснование участия</th>
                <th scope="col">Гражданство</th>
                <th scope="col">ОВЗ</th>
                <th scope="col">Статус участника</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data->data as $one)
                <input type="hidden" name="ids[]" value="{{ $one->id }}"/>
                <tr>
                    <td>{{ $one->name }}</td>
                    <td>{{ $one->surname }}</td>
                    <td>{{ $one->patronymic }}</td>
                    <td>{{ $one->birthdate }}</td>
                    <td>{{ $one->class }}</td>
                    <td>{{ $one->educational }}</td>
                    <td>{{ $one->warrant }}</td>
                    <td>
                        <select name="citizenship[]">
                            <option value = "0">РФ</option>
                            <option value = "1">Резидент</option>
                            <option value = "2">Иностранное государство</option>
                        </select>
                    </td>

                    <td>
                        <select name="disabled[]">
                            <option value="0">Без ОВЗ</option>
                            <option value="1">Имеется ОВЗ</option>
                        </select>
                    </td>

                    <td>
                        <select name="status[]">
                            <option value="0">Отклонить заявку</option>
                            <option value="1">Подвердить заявку</option>
                        </select>
                    </td>


                </tr>
            @endforeach


            </tbody>
            </table>
            <script src = "../../js/checkbox.js">
            </script>
            <input type="submit" class="btn btn-primary button-1" id = "button-1">
                <script src="../../js/empty.js"></script>
                Подтвердить участие
            </input>
        </form>
</div>
<div class="container box-1" id = "div-1">Ваше участие подтверждено</div>
</div>
</body>
</html>