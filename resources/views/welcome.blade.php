{{--
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
</html>--}}

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/RegistrationForm.css">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/welcome.css">

    <link rel="shortcut icon" href="/img/flag.png" type="image/png">

    <!--<script src='../../js/jquery.js'></script>
    <script src = '../../js/gradient.js'></script>
    <script src = "../../js/movemouse.js">   </script>-->
    <title>Страница подтверждения</title>
</head>
<body class = "body-1" id = "highlight2">
<header >
    <img src="../../img/logo_goriz_color.svg" alt="">
    <img src="../../img/Frame 9191.svg" alt="">
</header>
<div class="container box-1" id = "table-1">

    <div class='verification_info'>
        <p class="verification_text" style="margin-bottom: 0">
            Не закрывайте и не обновляйте данную страницу. Если это произойдет - следуйте инструкциями из Вашего электронного письма
        </p>
    </div>
    <div style="margin-bottom: 40px;"></div>

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <h2>{{ $subject }} 2023/2024</h2>
        <table class="table table-bordered" id="myTable">

            <thead class="thead-dark">
            <tr>
                <th scope="col" style="width: 20%; text-align: center; vertical-align: middle">ФИО</th>
                <th scope="col" style="width: 5%; text-align: center; vertical-align: middle">Дата рождения</th>
                <th scope="col" style="width: 6%; text-align: center; vertical-align: middle">Класс участия</th>
                <th scope="col" style="width: 25%; text-align: center; vertical-align: middle">Учебное учреждение</th>
                <th scope="col" style="width: 10%; text-align: center; vertical-align: middle">Обоснование участия</th>
                <th scope="col" style="width: 10%; text-align: center; vertical-align: middle">Гражданство</th>
                <th scope="col" style="width: 12%; text-align: center; vertical-align: middle">ОВЗ</th>
                <th scope="col" style="width: 12%; text-align: center; vertical-align: middle">Статус участника</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->data as $one)
                <input type="hidden" name="ids[]" value="{{ $one->id }}"/>
                <tr>
                    <td>{{ $one->name.' '.$one->surname.' '.$one->patronymic }}</td>
                    <td>{{ date('d.m.Y',strtotime($one->birthdate)) }}</td>
                    <td>{{ $one->class }}</td>
                    <td>{{ $one->educational }}</td>
                    <td>{{ $one->warrant }}</td>
                    <td>
                        <select name="citizenship[]" style="width: 100%;">
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
                            <option value="1">Подтвердить заявку</option>
                        </select>
                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>

        <div class='verification_info'>
            <p class="verification_text" style="margin-bottom: 0">
                Проверьте корректность введенных данных перед сохранением! После этого изменить их не получится.
            </p>
        </div>

        <button type="submit" class="btn btn-primary button-1" id = "button-1">
            Сохранить данные по заявкам
        </button>
    </form>
</div>

</div>

<h1 class="text-mobile">
    Откройте сайт на компьютере
</h1>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>