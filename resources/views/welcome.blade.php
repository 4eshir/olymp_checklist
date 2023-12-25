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
    <link rel="stylesheet" href="/css/RegistrationForm.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/welcome.css">

    <link rel="shortcut icon" href="/img/flag.png" type="image/png">

    <!--<script src='../../js/jquery.js'></script>
    <script src = '../../js/gradient.js'></script>
    <script src = "../../js/movemouse.js">   </script>-->
    <title>Страница подтверждения</title>
</head>
<body class = "body-1" id = "highlight2">
<header >
    <img src="/img/logo_goriz_color.svg" alt="">
    <img src="/img/Frame 9191.svg" alt="">
</header>
<div class="container box-1" id = "table-1">
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <h2>Название_Предмета Дата</h2>
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
                            <option value="1">Подтвердить заявку</option>
                        </select>
                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary button-1" id = "button-1">
            <script src="../../js/empty.js"></script>
            Подтвердить участие
        </button>
    </form>
</div>
<div class="container box-1" id = "div-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 21C13.1819 21 14.3522 20.7672 15.4442 20.3149C16.5361 19.8626 17.5282 19.1997 18.364 18.364C19.1997 17.5282 19.8626 16.5361 20.3149 15.4442C20.7672 14.3522 21 13.1819 21 12C21 10.8181 20.7672 9.64778 20.3149 8.55585C19.8626 7.46392 19.1997 6.47177 18.364 5.63604C17.5282 4.80031 16.5361 4.13738 15.4442 3.68508C14.3522 3.23279 13.1819 3 12 3C9.61305 3 7.32387 3.94821 5.63604 5.63604C3.94821 7.32387 3 9.61305 3 12C3 14.3869 3.94821 16.6761 5.63604 18.364C7.32387 20.0518 9.61305 21 12 21ZM11.768 15.64L16.768 9.64L15.232 8.36L10.932 13.519L8.707 11.293L7.293 12.707L10.293 15.707L11.067 16.481L11.768 15.64Z" fill="#1197D5"/>
    </svg>
    Ваше участие подтверждено
</div>
</div>

<h1 class="text-mobile">
    Откройте сайт на компьютере
</h1>
<script src = "../../js/checkbox.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>