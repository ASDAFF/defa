<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сайт в разработке!</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #e9e8ed;
            font-size: 40px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .error-header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .logo {
            margin-right: 20px;
        }

        .error-main {
            position: relative;
            margin: 20px auto;
            width: 39%;
            text-align: center;
            background-color: #e9e8ed;
        }

        .error-title {
            font-family: Arial, sans-serif;
            font-weight: 500;
            font-size: 1em;
            color: #d33234;
        }

        .error-main__error-text {
            width: 60%;
            margin: 20px auto;
            /*font-size: 22px;*/
            font-size: 0.5em;
            font-family: Arial, sans-serif;
            color: #000;
        }

        @media screen and (max-width: 812px) {
            .wrapper {
                justify-content: flex-start;
            }

            .error-main {
                width: 80%;
            }

            .error-main__error-text {
                width: 100%;
            }
        }

    </style>
</head>
<body>
<div class="wrapper">
    <div class="error-header">
        <img src="/images/small_logo.png" alt="Логотип Дэфо" class="logo" width="90" height="90">
        <h1 class="error-title">Все отлично!</h1>
    </div>

    <div class="error-main">
        <img src="/images/sad-bird.jpg" alt="Нам очень грустно, что Вы не увидите сайт еще какое-то время" class="sad-bird" width="292" height="228">
        <p class="error-main__error-text">Наш сайт находится в разработке и будет готов в течение некоторого времени. Просим Вас заглянуть к нам позже :)</p>
    </div>
</div>

</body>
</html>