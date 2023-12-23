<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать персональные данные</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/ProfileForms.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
<header class="header_mobile">
    <div>
        <img class = "vsohlogo" src="./img/logo_goriz_color.svg" alt="" />
        <img class= "citylogo" src="./img/Frame 9191.svg" alt="" />
    </div>
    <div class="burger_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4 6.02632C4 5.4595 4.44772 5 5 5H19C19.5523 5 20 5.4595 20 6.02632C20 6.59313 19.5523 7.05263 19 7.05263H5C4.44772 7.05263 4 6.59313 4 6.02632ZM4 11.5C4 10.9332 4.44772 10.4737 5 10.4737H19C19.5523 10.4737 20 10.9332 20 11.5C20 12.0668 19.5523 12.5263 19 12.5263H5C4.44772 12.5263 4 12.0668 4 11.5ZM4 16.9737C4 16.4069 4.44772 15.9474 5 15.9474H19C19.5523 15.9474 20 16.4069 20 16.9737C20 17.5405 19.5523 18 19 18H5C4.44772 18 4 17.5405 4 16.9737Z" fill="#383C3F"/>
        </svg>
    </div>
</header >

<div class="burger animate__animated animate__fadeInDown " style="display: none;">

    <div class="btn-line">
        <div class="burger_btn_close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18.3002 5.70998C18.2077 5.61728 18.0978 5.54373 17.9768 5.49355C17.8559 5.44337 17.7262 5.41754 17.5952 5.41754C17.4643 5.41754 17.3346 5.44337 17.2136 5.49355C17.0926 5.54373 16.9827 5.61728 16.8902 5.70998L12.0002 10.59L7.11022 5.69998C7.01764 5.6074 6.90773 5.53396 6.78677 5.48385C6.6658 5.43375 6.53615 5.40796 6.40522 5.40796C6.27429 5.40796 6.14464 5.43375 6.02368 5.48385C5.90272 5.53396 5.79281 5.6074 5.70022 5.69998C5.60764 5.79256 5.5342 5.90247 5.4841 6.02344C5.43399 6.1444 5.4082 6.27405 5.4082 6.40498C5.4082 6.53591 5.43399 6.66556 5.4841 6.78652C5.5342 6.90749 5.60764 7.0174 5.70022 7.10998L10.5902 12L5.70022 16.89C5.60764 16.9826 5.5342 17.0925 5.4841 17.2134C5.43399 17.3344 5.4082 17.464 5.4082 17.595C5.4082 17.7259 5.43399 17.8556 5.4841 17.9765C5.5342 18.0975 5.60764 18.2074 5.70022 18.3C5.79281 18.3926 5.90272 18.466 6.02368 18.5161C6.14464 18.5662 6.27429 18.592 6.40522 18.592C6.53615 18.592 6.6658 18.5662 6.78677 18.5161C6.90773 18.466 7.01764 18.3926 7.11022 18.3L12.0002 13.41L16.8902 18.3C16.9828 18.3926 17.0927 18.466 17.2137 18.5161C17.3346 18.5662 17.4643 18.592 17.5952 18.592C17.7262 18.592 17.8558 18.5662 17.9768 18.5161C18.0977 18.466 18.2076 18.3926 18.3002 18.3C18.3928 18.2074 18.4662 18.0975 18.5163 17.9765C18.5665 17.8556 18.5922 17.7259 18.5922 17.595C18.5922 17.464 18.5665 17.3344 18.5163 17.2134C18.4662 17.0925 18.3928 16.9826 18.3002 16.89L13.4102 12L18.3002 7.10998C18.6802 6.72998 18.6802 6.08998 18.3002 5.70998Z" fill="#383C3F"/>
            </svg>
        </div>
    </div>

</div>

<header class="header_desktop">
    <img class = "vsohlogo" src="./img/logo_goriz_color.svg" alt="" />
    <img class= "citylogo" src="./img/Frame 9191.svg" alt="" />
</header>

<div class='profile'>

    <div class='section animate__animated animate__fadeIn'>
        <div class='title'>
            <h4>Введите Ваши данные</h4>
        </div>

        <form class='mainform_profile' method="POST" action="{{ route('giveurl') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div>
                <div class="info2">
                    <select name="municipality" id="municipalityInput" class="form-select">
                        <option value="" selected>Выберите район нахождения Вашего учебного учреждения</option>
                        @foreach ($municipalities->data as $one)
                            echo '<option value="{{$one[0]}}">{{ $one[1] }}</option>';
                        @endforeach
                    </select>

                    <select name="educational" id="educationalInput" class="form-select">
                        <option value="">Место работы</option>
                        @foreach ($schools->data as $one)
                            echo '<option value="{{ $one[0] }}">{{ $one[1] }}</option>';
                        @endforeach
                    </select>

                    <input
                        name="position"
                        type="text"
                        class="form-control"
                        id="positionInput"
                        placeholder="Должность"
                        value=""
                    />
                    <input
                        name="surname"
                        type="text"
                        class="form-control"
                        id="surnameInput"
                        placeholder="Фамилия"
                        value=""
                    />
                    <input
                        name="name"
                        type="text"
                        class="form-control"
                        id="nameInput"
                        placeholder="Имя"
                        value=""
                    />
                    <input
                            name="patronymic"
                            type="text"
                            class="form-control"
                            id="patronymicInput"
                            placeholder="Отчество"
                            value=""
                    />

                    <input
                            name="mun"
                            type="hidden"
                            class="form-control"
                            id="munInput"
                            value="{{ session('mun') }}"
                    />

                    <input
                            name="sub"
                            type="hidden"
                            class="form-control"
                            id="subInput"
                            value="{{ session('sub') }}"
                    />
                </div>

            </div>

            <div class='btnline'>
                 <button type="submit" class='btn btn-primary'>Продолжить</button>
            </div>
        </form>
    </div>

</div>

<footer>
    <p>© Центр олимпиадного движения г. Москва, 101000, ул. Жуковского, д.16 Телефон: 8 (495) 625 59 80 Fcod@edu.gov.ru</p>
    <p>Региональный школьный технопарк является оператором</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Initialize the datepicker -->


<style>
    #loader {
        position: absolute;
        right: 18px;
        top: 30px;
        width: 20px;
    }
</style>
<script>

    $(function () {
        var loader = $('#loader'),
            category = $('select[name="municipality"]'),
            subcategory = $('select[name="educational"]');

        loader.hide();
        //subcategory.attr('disabled','disabled')

        subcategory.change(function(){
            var id = $(this).val();
            if(!id){
                //subcategory.attr('disabled','disabled')
            }
        })

        category.change(function() {
            var id= $(this).val();
            if(id){
                loader.show();
                //subcategory.attr('disabled','disabled')

                $.get('{{url('dropdown-schools?municipality_id=')}}'+id)
                    .done(function(data){
                        var s='<option value="">Выберите место работы</option>';

                        data["data"]["data"].forEach(function(row){
                            s +='<option value="'+row[0]+'">'+row[1]+'</option>'
                        });
                        subcategory.removeAttr('disabled');
                        subcategory.html(s);
                        loader.hide();
                    })
            }

        })
    })
</script>


</body>
</html>
