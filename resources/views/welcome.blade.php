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
    <form>
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
                <th scope="col">Гражданство</th>
                <th scope="col">ОВЗ</th>
                <th scope="col">Статус участника</th>
            </tr>
            </thead>
            <tbody>


            <tr>
                <td>Иванов</td>
                <td>Иван</td>
                <td>Иванович</td>
                <td>01.01.2010</td>
                <td>9 класс</td>
                <td>Государственное бюджетное общеобразовательное учреждение Астраханской области "Вечерняя (сменная) общеобразовательная школа № 10"</td>
                <td><input type="text" style="width:70%" id = "1111" list="countryList"></div>
<datalist id="countryList">
    <option value = "0">РФ</option>
    <option value = "1">Резидент</option>
    <option value = "2">Иностранное государство</option>
</datalist>
</td>

<td><input type="checkbox" class="form-check-input" checked><label>ОВЗ</label></td>

<td><input type="checkbox" class="form-check-input" checked><label>Подтвердить участие</label></td>

</tr>

<tr>
    <td>Петров</td>
    <td>Петр</td>
    <td>Петрович</td>
    <td>01.01.2011</td>
    <td>10 класс</td>
    <td>Муниципальное бюджетное общеобразовательное учреждение г. Астрахани "Средняя общеобразовательная школа №32 с углубленным изучением предметов физико-математического профиля"</td>
    <td><input type="text" style="width:70%" id = "1111" list="countryList"></div>
        <datalist id="countryList">
            <option value = "0">РФ</option>
            <option value = "1">Резидент</option>
            <option value = "2">Иностранное государство</option>
        </datalist>
    </td>

    <td><input type="checkbox" class="form-check-input" checked><label>ОВЗ</label></td>

    <td><input type="checkbox" class="form-check-input" checked><label>Подтвердить участие</label></td>

</tr>

</tbody>
</table>
<script src = "../../js/checkbox.js">
</script>
<button type="button submit" class="btn btn-primary button-1" id = "button-1">
    <script src="../../js/empty.js"></script>
    Подтвердить участие
</button>
</form>
</div>
<div class="container box-1" id = "div-1">Ваше участие подтверждено</div>
</div>
</body>
</html>