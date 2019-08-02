<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("3D планировщик мебели");?>
<?
$protocol = (array_reverse(explode('.', $_SERVER['HTTP_HOST']))[0] == "ru")?"https":"http";
$region = $arRegion["PROPERTY_REGION_TAG_TEST_VALUE"];
?>
    <div class="top_block">
        <h3 class="title_block big">3D планировщик мебели</h3>
    </div>
    <div class="row government">
        <div class="col-lg-12">
            <p class="text-all-width">
                Создайте офис своей мечты за несколько минут! 3D планировщик поможет легко и быстро создать дизайн офиса в режиме онлайн. Соберите ваш офис самостоятельно, выбирая из 40000 моделей мебели, или оставьте заявку на бесплатный дизайн-проект.
            </p>
        </div>
    </div>
    <div class="row text partners">
        <div class="col-md-12">
            <div class="row why-we why-we-partners">
                <ol class="why-we-list">
                    <li>
                        <div class="why-we-wrapper">
                            <h3>Выберите помещение</h3>
                            <p>Нажмите кнопку «создать новый проект» в нижнем меню и введите параметры помещения.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-we-wrapper">
                            <h3>Расставьте мебель</h3>
                            <p>Просто выбирайте мебель из каталога в правой части экрана и перетаскивайте ее в интерьер с помощью мышки. Используйте всплывающие подсказки.</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-we-wrapper">
                            <h3>Оцените результат</h3>
                            <p>Расставьте всю необходимую мебель, при желании добавьте декор. Ваш интерьер готов!</p>
                        </div>
                    </li>
                    <li>
                        <div class="why-we-wrapper">
                            <h3>Сохраните интерьер</h3>
                            <p>Сохраните готовый проект и спецификацию или ссылку на проект и отправьте нам по электронной почте <a href="mailto:ishop@defo.ru">ishop@defo.ru</a>. Наши менеджеры свяжутся с Вами для уточнения деталей заказа.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
<div class="o3d-online">
	<iframe src="https://o3d.ru/app/app_defo.php?domain=<?=$protocol?>://<?=$_SERVER['HTTP_HOST']?><?=($_GET["artcode"])?"&artcode=".urlencode($_GET["artcode"]):""?>&region=<?=$region;?>" allowfullscreen="allowfullscreen" style="width: 100%; height: 700px; border: 0; margin-left: 1%;"></iframe>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>