<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обслуживание");
?>
    <div class="top_block">
        <h3 class="title_block big">Обслуживание</h3>
    </div>
    <br>
    <div class="row government">
        <div class="col-lg-12">
            <p class="text-no-all-width">
                Вы обратились в компанию "ДЭФО", являющуюся одним из лидеров на российском рынке офисной мебели! А это значит, что, независимо от объема заказа, Вас обслужат в соответствии со всеми стандартами, принятыми "Службой Высокого Сервиса ДЭФО". Вы хотите стать одним из наших клиентов? Нет ничего проще! Всего один шаг и Вы поймете, что такое настоящий профессионализм и Высокий Сервис "ДЭФО"! Позвоните в "ДЭФО" в Вашем городе или воспользуйтесь формой для вызова консультанта, дизайнера в офис!
            </p>
        </div>
    </div>
    <div class="top_block">
        <h3 class="title_block big">Наш менеджер приедет к вам в офис</h3>
    </div>
    <div class="row services about">
        <ol class="row services-steps">
            <li class="col-lg-3 services-step">
                <p class="about-text">
                    Менеджер "ДЭФО" приедет к Вам в офис с каталогами и образцами текстур и фактур
                </p>
            </li>
            <li class="col-lg-3 services-step">
                <p class="about-text">
                    Бесплатно и быстро дизайнер создаст проект расстановки мебели с учетом специфики работы каждого сотрудника
                </p>
            </li>
            <li class="col-lg-3 services-step">
                <p class="about-text">
                    Специалисты отдела послепродажного обслуживания помогут подобрать наиболее подходящие условия поставки
                </p>
            </li>
            <li class="col-lg-3 services-step">
                <p class="about-text">
                    Профессиональная служба доставки в кратчайшие сроки доставит заказанную мебель, соберет и установит, вывезет мусор
                </p>
            </li>
        </ol>

        <div class="row col-lg-12">
            <span class="animate-load red-btn red-btn-center" data-event="jqm" data-param-form_id="CALL_SPECIALIST" data-name="CALL_SPECIALIST" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Оставить заявку</span>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Мы открыты к общению</h3>
    </div>
    <div class="row government services tender advantages">
        <div class="col-lg-8 advantages-wrapper">
            <div class="advantage-item email">
                <p class="advantages-text">
                    Интерактивная система контроля качества услуг позволяет Вам оставить сообщение руководству компании «ДЭФО» и получить обратную связь в кратчайшие сроки.
                </p>
            </div>
            <div class="advantage-item feedback">
                <p class="advantages-text">
                    Вы можете оставить свой Отзыв о любом продукте, сервисе или сотруднике. Компания «ДЭФО» внимательно следит за потребностями и пожеланиями клиентов.
                </p>
            </div>
            <div class="advantage-item documentation">
                <p class="advantages-text">
                    Получайте необходимую техническую документацию по госзаказам согласно ФЗ-44 и ФЗ-223, а также помощь в составлении ТЗ с учетом требований госзаказчика.
                </p>
            </div>
            <div class="advantage-item full_support">
                <p class="advantages-text">
                    Онлайн-консультация позволяет Вам быстро получить ответ эксперта, задав свой вопрос в специальной всплывающей форме на сайте.
                </p>
            </div>
            <div class="advantage-item help_tz">
                <p class="advantages-text">
                    Ваш персональный менеджер координирует весь процесс сделки от приемки заявки до постгарантийного обслуживания.
                </p>
            </div>
        </div>
        <div class="col-lg-4 manager-card card">
            <h3 class="manager-card-text">Отдел по работе с клиентами</h3>
            <p class="manager-card-link-wrapp">
                <a class="manager-card-link tel" href="tel:+79650801101">+7 (965) 080 11 01</a> <a class="manager-card-link mail" href="mailto:govdeparment@defo.ru">govdeparment@defo.ru</a>
            </p>
            <p class="manager-card-text-small">
                Оставьте заявку и менеджер перезвонит в удобное для Вас время
            </p>
            <span class="animate-load red-btn" data-event="jqm" data-param-form_id="CALLBACK" data-name="CALLBACK" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Задать вопрос</span>
        </div>
    </div>

    <div class="row payment-page">
        <div class="why-buy">

            <h4>Почему покупают в "ДЭФО"</h4>
            <div class="row">
                <div class="col-md-4">
                    <a href="/company/" class="why-buy-item">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35" viewBox="0 0 40 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="40" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAjCAYAAADmOUiuAAAD8ElEQVRYhb2YeYhWZRTGfzouuYAjppKOhjYuietoNG4UpFKEYhIoiH+URCQuuVSChmEILoiISxv9JS5kSG6gqbngljYKLSpuqJCCCu4Lao48znPl8nHv/e43dueBYbj33Pe8z3fe9z3nOW+t8vJyUqIO8BYwGHgN6Ai0AGoDj4HLwEngMLAN2A78l9Z5HOqk+OZFYCLwMXAH2AgsA04A/5pEEdAa6Az0B5YDjYFvgSXA1eoSTIpgLWA88DWwB1gI7C7A9xvAVGAg8KV/VGWhBOMiqKitAl4GhgO7CnXsH6O/N4HvgaHA6EKjWTviXRtgH3AN6F1NcmFofBlw3X5LnoegNv1Ob/BRwO3nJBfgtv39ZsLNq0NQG30tcNB7r+D9kgfyN87+13q+ggh+DjQDPsqAXIBK+1cEPyuEoPbdDOBD4F5G5ALI/wfATKBtWoJKB5uAQxmTC3DI+XRKvg9FsKEjN6+GyAWYD4wFGiV9JILvAueBozVKr2q+c54/FiI4yLVzkvPUOZ80LXt9D6yXYz/g5Umyfxph3x+y63mra3ssVOoqgA7AGYf9uJ+nuc4OA34BXgDmAqctFHQKH9q+wVVpfsiurPAgZC+yXfN0Ar4ASv19WRLBa/5Vr9thgHqObKmdDoqwK6G/4kkGR9h3AO08PsqulWoPFCctsYxzcgbjZxX5Vk4J1bHPtMqJs2veJklLLILfOMVE4bDL1JEY+5/+/3eMvcLjK2LsmyzNYqtKGsFal6q9FoVii4qmFgNR0N58lG+SOKQRrHHk0iKXXH1rxe4WtVrqvywibuUOjpJbWaEBMBu45G3VyyvQyXtR7xd7NZ4hTQT/D+gkbwZuOO3sjfDZxWlM0RwRlN2aiGCgMdU2DIghJxwzebUWvwKvUkMRVOP0B/BJShm3yHJsJdAn6wiqQgwpgFyAr9wXvZ81wTHAGuBKnu+0kj9azOKTvVRNVtYEy73/wqib86yStw7o4ZofQGW0b9YEXwLOhp7f8WEIOjuR+xlo6VuLcKQvai9mTfB+Tq3dYoklWdY1RG6IU1AYEtL3syYo6dYt9FzpjnG163hxDDlcaU5lTVARGxnxfjrwHvB2DDk8bksagv/k6xsSxMBKd24jImzrgbsx43r5ymVpGoJNfcKi0MFqJu4GQu8nO1mXppgLJ+mffGl1IQ3B1U6cuZpNt1+zbE+Covgd8LtPcRLKrLIPui5TVFKS9y5HH0/wnjnrxrunb6x0+6VkrNOaBOVCqZUfnE4UGC2vLj6VivROSket7wL3O08rT5oI3nSRV5uoKznlKlUH5bN+XuI0WOFlVp+jiiGVrbFS4zo08qf+RASryiLwBCe58fT7hxqlAAAAAElFTkSuQmCC"/>
                            </svg>
                        </div>
                        <span>Надежность</span>
                        <p>25 лет на рынке, 48 филиалов по России</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/company/advantage/better_conditions/" class="why-buy-item">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="35" viewBox="0 0 27 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="27" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAjCAYAAABl/XGVAAAEUElEQVRIibWXb2xfUxjHP12nw6YznZhgik4zFsxa4cUSm4QbczeuP6+Iv1nUvCUjvCIjhFeM6BDxjjjCNbnEsgmJJcUQ1Vi62YqYWGdl7bLVNvnK9zR3zd3yq7YnObm/9t7zfM95vs/zfZ5TR8VI0mw6sBi4HLgEaAbOBk4FppdWDAJ7gV+AHcB3wNfAZ0UeBkdbHgFL0uwE4CbgPuAq4Bugy8+dwM/AHuBAkYf9SZqdBEwDTgPOAc4FLgPa/fwCeBUIRR6GR8CSNEuAl4FfgReBD4o8/FV16lpGkmaNwA3AKuAs4P4iD0Vdkma3GED/ePf/AhxrJGmWAS8BD9a3tM7fANxe5OHDiQbS6N3a09PSOl9UdE4B5gA/TAZQacj+nCn+uzNJsxmTgWK7nfodwRQt3ydpdleSZg0TBNIge7Jr+yhAjhR50PN6YDVwMbAe+Bj4Etha5OFwDca18QuBNuBaYBnQDTyteBDOf2DyZ5GH373ofCAFrvbC2UCf5z5goIQxE5Cb5nru9gY3AXmRh+22eQawK4LpJLcVeRiq2LEMagNnAk3AyYASer+nAH4Dthd5GKhYr+/f0knLYBcBjwNvF3k4OBGcAbcCT9qdy8qcLTdnLQb/CPhKqVLk4UgNxuu8dhFwnTnrNWfvlzmbVeRhrxfNA5abs3ZzErXxT2kjMGR3ShtnWRvnWpi7zNl7RR56bVPf7IlgrwErizwcqthx0yjOZpZei6P+Emf9FevrgVeAeyKY3KXwfrjIw6bx8lUCkneecT4vimAqLyuBh+yiYM62VNWl4xhXrVtozjK7+lmfbDiCNajmODEXm7MljtCdLowqkH+7WMahYnqKC2uza1oPsFGcuYgedq08ONWL7gTWWSk+9dROFQCtJc6U4Ce6Wg+arx+VwOJMv4s8HKg49N1EuQJUKF8A1ozFbTW69VHVMqAxnky9xvOSpCTNXgdURDdXRWcNAIq+K91i6ESf235vPNlUGU7STCJ8h7VRebPFs8951m8FlycaHVhNpTxb6Nln175Z5KE7STMdajiebIUbk26ryGqLZ5uDZJ6TPGpjHEPegHqXbbFSRFEvDQXcCGeKskfUK9RSTsbgUkV3B/CUojaCycdrrQ5rfcod4wBpdp49YJXRc3M5qRUM1zgNJKJ/uDZ961zrM1eK1n/Es1Og0Xwpxy6160+3mL8BqKGqP4qzIg/vAJ9o+vhx4QInetTGGd7csIvpiDZagJ9TY1umI0mzGxnF2WPKtUngTDn2hDwQwdrN1Ww3lOJs2zhALjBnHa7k4qwrgtVbw5aU8mzAnOmy8FMN2nieLyFtDrSYZxt9wkPibBewVFzphUTULxeUOLuipI3TzNs+F9LdJc6UZ2vUvo2iY2lseGKv31HkIYyPpUqX3myKVh3rFrO+qlMaA0D1Lab0gcJZpN47gfezdRL1o+5nFTurunlqh2pcRt881QTJI8e/eQL/ApZ20J8wb8inAAAAAElFTkSuQmCC"/>
                            </svg>
                        </div>
                        <span>Лучшие цены</span>
                        <p>Скидки и акции на эксклюзивные коллекции</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/company/advantage/10_years_warranty/" class="why-buy-item">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="35" viewBox="0 0 36 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="36" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAjCAYAAAD8BaggAAADHUlEQVRYhb2Ya2iOYRjHf9vkNHJIWRlDSVoOzWmYQ0giQqiVb5NDI7QvvmyKhGw5W0oiPiiHIjJqsZx9QYZI+ECJxHIcE131f/X27rmf93mf933ef72tvfe9e7/nvq/7uv7Xk1NaWopDvYH5rsGA+gqcDjh3EVDRwWfCAOAgcCUkTHdgeECg0cAJoNoPqBPwBlgQEigfaAH6AW995tmDXwCOA3W5PhOLgY8hYUzfgEvAWp85tovngUdApX3hAsoBlgO30gAyVQN5jjH7/iTQEVgCtNmXriOrAoYBS9MEeqCPl3YDY4FxOlpcQOuBrcBCxVAUqtQJTAdex68fD1QCbBHxHKAxBRA74j7AhwBzbe09wDLgduKgxVAD8BK4AbzSUaUCY5oLPAZmJZk3QnGzST/bKa+wsNCuWwWwCjgHfE8RxvQcaAWOAJ2BJuBvwpwC4Ko2oMq1kGVq+8NewOcQIImytH8KeAGUA+803lWQP4CZwC/XAn55KIzuKBbbdLtmKL7sFHroojhh8Ln26cgCe7bipEG5zErIhIREa/nnjz7/lekdisn+SY2K81DtzLOEOfWJMAjIklKXiMCsdBQpfuI1SNm5nQzok2pKVGr1WLfIVSdzdSOGRAjkpYHAUxdQs5JhNmVx9cQFdA+YmGWgScB1F5BdzakRpQAv9VS9vOYCsqB+qCSWDZXr1rW4gEyHgdVZAloJHHMNxoCs/owCBkcMY/6nL3A2GdBvYD+wLUIYq2nbgR3Az2RApn3AGKAsIqByWZBDfpPigSyjbtD5dsswTIEeeI0sSCAg1JI06SlsizMh6y6OApe1vq+8qv06WU1rYTKhWqA/sCLIWl7J8AswD7grb1OfBtRGmfky9fmhgFBrYlazUS1xbQiYGnnnKR5eKGUg1N5a3rio/rtK6SGZ8vWSwh5omqpAYCVzjM3qLkeqGBYnmV8iX23VfDxwPxUYAlrY99qpM2rs6vTuKF7WJB4Abirrl4XteoN6avO+O7UDdnwWY7tk3PfqdysJZuY3x14cRAkUk7lL88KTZSPMM1vMmL9ZrPHwAv4BfS+YMd6k4yYAAAAASUVORK5CYII="/>
                            </svg>
                        </div>
                        <span>Гарантия до 10 лет</span>
                        <p>Расширенная гарантия на часть ассортимента</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/services/dostavka/" class="why-buy-item">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="32" viewBox="0 0 58 32">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="58" height="32" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADoAAAAgCAYAAABD9mvVAAAEW0lEQVRYhe2Zf2iVVRjHP+/d2grapmt/FNYfTde0ZqtBUdQflaC5DoeC00+CCMN+gf8UFpEIiZhIK4RKLWxLwcoD5tlBw1rZ71mylglF/xYaWYGxlu6u3njme8e7u3vv9vrebRZ94eXynh/P9/2eH895znMDEkBp8ytQn6RPmfCYd7YjjanKhO1F5Crgk6lWFsOrQG1aI0mFCg57Z/enJZ4slDYD5bAzKjQMwweA60s17nl/P82XNK3o3r3z1jJw9wVBsLEMdiaF+IyKyPtKdVp00w3yc2OZuGcBMyK0IMIw5L2eDxgc/LMshG1tV3DRhXPKYisJJhR68uQQrnsPg4ODZSGsrq6aEaGjx0sYhp0TLd0yY3cQBBPudaVNPzAfOFGi2VfALd7ZorNxOl53JvAO8HYR3ipgLWCVNto7O/xvFtrvne0sVqm0+UYOBWCL0maZdzbMbzNO6LbtO/jyYB9DQ0McO/ZLqq+rqamhc+umVDYmA+/s50qbu4BdwA/A6vxu44RevrCF2tpastnsiNixkC09drDCQi/BqZaZTGbKRebgnXVKm0eATUqbH72zr8TrxwltbV048hAdLTkEwdiwWOqkOgz/LkgcBBkymUShdGp4ZzcrbeZEYo96Z33OZskhF3G5p1CdCKmoqCj4TLfIGGTZdgFvKW2uyRVXKm0aJWju7z9UX1t3KnYeGBjg+PHfEzMsmN9MQ8N5U/Hxk4Y4IqXNcuACoFtpc5139ntZul8D565avSY1yby5jTzfsX7aRBWDHDFKGwN8KEeT0uZaEXo+cFZX55aXqquq7pa+2ewwQ9l8RzQxZtXVzbjIHLyzfyht2oHPZGYrpUDq6mfvTK7sDId39melzVPAm3Gvu7FE9DGCtes27Gq7svXZpTcvPlAGiUenaZhGJnBUaBAEfXJHLNVDaUNv7xcH2pcuKTkgZyKm70SfYfwv9L+G1LcXpY2EQA8CjwKXAuLF90m20Dv77VSNl1zJgJXA1YDEoZ8Ca4ol7lLNaCSyK/LYHwF3Ao8DFwMHJSpJY78Er3DsBo5EyYLlkXftUdrcX6hP2hmV6OPe6Ha/N/Yhr0VH1TalTZN39q+UPKNQ2siqkfBrpXd2Q6zqdaXNc8CLSpu93tmf4v2SZurDaJnui4okuXzCO6sKtG0GvgMk2upNoW1PxPdC9C6zKXyN3tkxVyelzTmACOyIVppgMbA5qVBJBZ6dV7zeO/tkkfaS1qhIwjFJyIy1F+GUHFNrXvFw0qXbBDTE3mWULytCOC8SuWyiQCQhxOktUtpkCsxodeQfZGm/Eav6LdWlUWlzR2RwiXf23Vh5ZbRHZRCaiiWsTpOzBTgkSzj/jyeljQhcAcz1zh6J16UVKv23A7cDLwPi2mcDDwEt0QB8nIajCK9slXXAjihPJAN7T7R3JTm2Nb9P6jSA0kaW58OA5GsWALKPxXk87Z09nNZ+Cd7bgCeAq6JslZyjz3hnJRs4FsA/z8paLT/ZobUAAAAASUVORK5CYII="/>
                            </svg>

                        </div>
                        <span>Быстрая доставка в любой город</span>
                        <p>Доставка от 24 часов. Мебель в наличии на складе</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/help/payment/" class="why-buy-item">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAACmElEQVRYhe2YX4jMURTHP6tZ1EoRIn8itEspxKM/7Zu6Xf9uaUvJA0ryoF0UxYZ4IpR92H2QkuRKrpsXyQPx4MF4EltKHiwPKG2LsDrTGY1pfrOza34zHub7MjNnzr33c8+cOffcXxMpyFi3GjgDtAMPgI0x+C8jrTSumijGugXGumvAY+AFsAKYAhyrZHxVImOskwWPAvuAu8ChGPwr/W4NcB9oi8G/Tg3GWDdBAQTkJdAZg39Uwu8mMByDd1WHMdbJuA7gFPALOAz4GPxwgv9C/dnaS8H+BWOsWwvsBWZWyCN+04ATQE8M/nsFGzgLbAP61TQE3AL6YvCyITLGuq3AVTEC94CfCfMtAfbr+wvA6Rj85wrhUfAdwAfNqznASWAVsFscmox1QnopBn8uYUcShW5gJ3Bd8iMG/2YUEIVzyWY6gdYY/JCxbhnwXD/3Z4BFSirOB4GlBeObpUYALTpIotZtbNk8LCeZby4QjXVv1e+rrpmDEX3T109Acej7xrpygs4XmQfzuZsptMbge6u88Igy1q3P+1S1Av+rGjBJasAkKTO2YaOTsW6D9jbTSwycJ5XdWLcpVRhj3XjgBrAOuK11rFhXgMlS4dOOjDRVbdrLDJSBnl8LmF3AHgEx1q0EjgB3YvCXSzmnlsDGuhbNkaya5NTeAvQa60oGITWYGPyg9iyz8yZtxGIM/kdNYVQeOG6sa47B9wATY/Cbk5zTzpku4CHwxFgnp/9AQvsxI3WYGPx7vUMdALYDk0q4tQpkrl8y1g3rX6suMtZlpeDROJvKqAGTpP8Spp5Qf8qLQHwElteDwlgnrcNi4F2e6qJcV7UyZvX8qIVm6eH5DHiahxGDPD2QO9PUGgZGHhZIw9WRu/gDvwGbxr4u3XihWgAAAABJRU5ErkJggg=="/>
                            </svg>
                        </div>
                        <span>Любые способы оплаты</span>
                        <p>Безналичный и наличный расчет, оплата картой</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <span class="why-buy-item" data-event="jqm" data-param-form_id="CALLBACK" data-name="CALLBACK" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35" viewBox="0 0 40 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="40" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAjCAYAAADmOUiuAAAC50lEQVRYhdXYW4hVdRTH8U/jRGmoSAOCDlaKihI9lOhgBCUp1kOEiniDehB8CAoVQrygpF1AKAeqBx800SLIIIVEBX3xhiDqg5pFhRBIyFRY3sdCFqyTMpwz58xpzj72e9ls9t7/9f3/93+t9V/rgY6ODnVqGF7BNDyN0RiUQ13HTziFg9iN3+sx01rHN+OxCnPxYEIcwmf4Ld95NIGnYCFu4yu8h3ONAhyId/EmLmIlvsCvVb4bjvlYhnn4JL+9WovRWn/xWHyDx7EOnbhV07TuqjUn9w5+wav4vtpHLTUM/BSOxWTwDDbWASd/84c5xj855pT/ChgrdyA3/LM4XwdYT8WqTc3r3tzTdQHGntuFLszEH/0AV9LlHPNibp1BlV7sDXADnsCcfoa7F3I2HsP7fQUcmxt6Pc42AK6k8+l0b2BCXwBX5K/9qIFwJW3CJbxd7mE5wMEZrz7NjNBoRUT4OG0OrQQY1zG5WWfkdXsBcCWFrYfxUtoeU2KLQB0paU+6+xVcwEMYVyBg6LuMj+E0j2QYejkoN+NvPIeteBInC4YLncBEbEmWYNoc6ecFvI7DOI4lGZiL1oXcj8vRjQ/iANKS//qvhOlOx+hqAmBX2u7O+2BqqRRmGhGYq+lyuee1HBaaqv8t4H0DHiDX8ngeasMQjGgCy9W03Zb3wXQ9wswOrM0iaHoeTIsO0qH96cnfYh/eigwTK7gU27AgZ7EGk5oAGF78Ymazhcm0tFxNMiRLxFF5oGyqyjnDnziKWc2G04u3Rj5cXDBLWVUC/BIjs25oqioB3sjycmOd3Yd+U28BuTOfr24mYG+rczPd/XCeD3cXyPWvqqW003gNn2cnq3ANaG9vr2YzjuI/ZN0QBdWRbGMUolod4OusYSO6L8oqbCd+zhbc81lH9NQZ/FgEoCzgJ2c3YEm24iItxWqWEnxPRREUzae6i/++HqvCYDQiI2dGSox6JgqtKHDKKWqbUlOz78IdzaqVvjR9XmAAAAAASUVORK5CYII="/>
                            </svg>
                        </div>
                        <span>Бесплатный звонок по России</span>
                        <p>Консультация по любым вопросам по тел.: 8(800)505-45-79</p>
                    </span>
                </div>
            </div>

        </div>
    </div>

    <div class="maxwidth-theme inner-map">
        <div class="contacts-v5">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news",
                "contacts_custom",
                array(
                    "IBLOCK_TYPE" => "aspro_next_content",
                    "IBLOCK_ID" => "10",
                    "NEWS_COUNT" => "20",
                    "USE_SEARCH" => "N",
                    "USE_RSS" => "Y",
                    "USE_RATING" => "N",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "CHECK_DATES" => "Y",
                    "SEF_MODE" => "Y",
                    "SEF_FOLDER" => "/contacts/",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "100000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "SET_TITLE" => "Y",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "USE_PERMISSIONS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "LIST_ACTIVE_DATE_FORMAT" => "j F Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PREVIEW_PICTURE",
                        3 => "DATE_ACTIVE_FROM",
                        4 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "PERIOD",
                        2 => "REDIRECT",
                        3 => "",
                    ),
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "DISPLAY_NAME" => "N",
                    "META_KEYWORDS" => "-",
                    "META_DESCRIPTION" => "-",
                    "BROWSER_TITLE" => "-",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "PREVIEW_TEXT",
                        1 => "DETAIL_TEXT",
                        2 => "DETAIL_PICTURE",
                        3 => "DATE_ACTIVE_FROM",
                        4 => "",
                    ),
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "FORM_QUESTION",
                        2 => "FORM_ORDER",
                        3 => "PHOTOPOS",
                        4 => "LINK_GOODS",
                        5 => "LINK_SERVICES",
                        6 => "LINK_STUDY",
                        7 => "VIDEO",
                        8 => "PHOTOS",
                        9 => "DOCUMENTS",
                        10 => "",
                    ),
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "IMAGE_POSITION" => "left",
                    "USE_SHARE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "USE_REVIEW" => "N",
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "SHOW_DETAIL_LINK" => "Y",
                    "S_ASK_QUESTION" => "",
                    "S_ORDER_SERVISE" => "",
                    "T_GALLERY" => "",
                    "T_DOCS" => "",
                    "T_GOODS" => "",
                    "T_SERVICES" => "",
                    "T_STUDY" => "",
                    "COMPONENT_TEMPLATE" => "contacts",
                    "SET_LAST_MODIFIED" => "N",
                    "T_VIDEO" => "",
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "NUM_NEWS" => "20",
                    "NUM_DAYS" => "30",
                    "YANDEX" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "SECTIONS_TYPE_VIEW" => "sections_1",
                    "SECTION_TYPE_VIEW" => "section_1",
                    "SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_2",
                    "ELEMENT_TYPE_VIEW" => "element_1",
                    "S_ORDER_SERVICE" => "",
                    "T_PROJECTS" => "",
                    "T_REVIEWS" => "",
                    "T_STAFF" => "",
                    "IMAGE_CATALOG_POSITION" => "left",
                    "SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
                    "SHOW_SECTION_DESCRIPTION" => "Y",
                    "LINE_ELEMENT_COUNT" => "3",
                    "LINE_ELEMENT_COUNT_LIST" => "3",
                    "SHOW_CHILD_SECTIONS" => "N",
                    "GALLERY_TYPE" => "small",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "FORM_ID_ORDER_SERVISE" => "",
                    "T_NEXT_LINK" => "",
                    "T_PREV_LINK" => "",
                    "SHOW_NEXT_ELEMENT" => "N",
                    "IMAGE_WIDE" => "N",
                    "SHOW_FILTER_DATE" => "Y",
                    "FILTER_NAME" => "arFilterNews",
                    "FILTER_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_STRICT_SECTION_CHECK" => "N",
                    "VIEW_TYPE" => "list",
                    "SHOW_TABS" => "Y",
                    "SHOW_ASK_QUESTION_BLOCK" => "Y",
                    "SEF_URL_TEMPLATES" => array(
                        "news" => "",
                        "section" => "",
                        "detail" => "stores/#ELEMENT_ID#/",
                        "rss" => "rss/",
                        "rss_section" => "#SECTION_ID#/rss/",
                    ),
                    "TITLE_BLOCK" => "Наши салоны",
                    "ALL_URL" => "contacts/stores/"
                ),
                false
            );?>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>