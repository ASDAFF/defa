<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("3D Офис, он лайн сервис для создания интерьеров");
$APPLICATION->SetPageProperty("description", "3D Офис – офисная мебель ДЭФО.");
$APPLICATION->SetPageProperty("keywords", "3D Офис мебель дэфо");
?><style>
.office_caption {
	font-size: 18px;
	margin: 20px 0;
}
.office_bold {
	font-weight: bold;
}
.office_red {
	font-weight: bold;
	color: #bc0000;
	text-align: left;
}
.office_line {
	margin: 20px 0;
}
.office_line img {
	display: block;
	margin: auto;
}
.office_center {
	text-align: center;
}
.launch_button {
	display: inline-block;
	width: 210px;
	height: 48px;
	background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANIAAAAwCAMAAABTy9T5AAAAb1BMVEW2ChezCxi5CRa8CBXBBROxDBnVABK+BxTTARLTBBXYBBbSARHQAxTVBBbXABLEBBPYARTXAhXZBhnaBBfXBRjYBhnaBhnvUmHvT13GBBLtS1nnQk7LBRTAGibIIi+8FyPOKTXWMD23Ex/eOEXDHipSPA0rAAAFIklEQVRo3uyU0XKbMBBF8+BhJMDFwpAEpy8Z//8/9u7VVRbLhnFm8tDp9Gi1WmEDe6y0L90Ooaq0b77Lr6dofogHSiGnEFSsxSjUYYTQrPGdgyYxChLTRX3CVH+RaQe+mjOwDqowmaB0eYZ3BKZVW7y9IX6Y92/DU7p02wRiq0r9MrnCinh4PJzM4qSMODEKjRd+1wZ6m7rAUEaITaXAYCLu1BQx96ltkCmAJAWXoo4K+6ASphKfw6gJRqm1Y2iDq5cQpLRPKKhaH1Kt5NDGSYyafGgu15S1wkV2oVKflXolOaBUxcFwIoViZYOZ0Ew6IXv/eySghXJFzc+qIoAdKzTJU+ovK5c+yCwg5BaE6xh3x5PoA3QkT5Jon1SQhlbJhRJt9s6puzml/tITGnEi8jYERuVEq68zshaYKaO10LZaOIkWbaoTw1gjr4SR4YtDbEKMagUFUavdJXRUEjSyFRF6nlPAivu6iKwnIOzhLpSEnNrUon9gDXNlCJSUY2WJA+hPsJI6puaIQSW812APwYLtqDnMjqfUBSk5ATOb8R5RZErVNEcj3dI6J3a6y6mqua511jWgWKzw9jpWlxih9NFvEKPNGvxqEQM+VDoiKJMwbjh70nJWjdgkFSY+HAMkm3qtW9X0GDifTaXyrXvwXITQz1nJnBFakUk7WqENP9gmn8s0IQHUIiLgBbQ4aJhOH1FKm9QyiJoJtNOND4DBiHAHR8KjYfnWb1LCM4+PiDYf0ZOPvVN65JQf6TLHFgktSGqcRwu5WLNnzEfgsyyTrXD3LCPAbEJti5dUPhZc7nRilNKyXH+Dx0fEVNs4EwKgH8Q8jRDCMM7bOnJiEuY1jdM0T2uOWmot9lL9G8pa8LguiyktolbTlwtrJ77RmUF2megkXg1rX3avmnKF+IrZnsJ5R6WEcKSygGExmeGFecCOwdLlopCSIxP3kZTD9gm96IZpIxfjmhkgkW0fUYlwDiqvw/AyDMi4lFm8ru1qJenQaMQA5Wy07HIu332lkk0JIam4UZIGRYZNrospfQ7PIEEZ2qHp3VpGC6lY3lUaGTnpzllOxadyeA7KvBwOn8PhgA0mkyav6SJrJL+qC/KUKPj6E6WqLGeX4LaAs/b/sNQ82mf/6slbUyMo1y0wiO6R0uEfAjL/lf56stKf9sg1N2IQBsI8NuIQVR5Nc/8zFo9HDEoqqv6pKtSPBdvDALH2eL2KjWISshpR4meTOSwW+wNQC33MGQEzv8SnQdkip26gr/TRl9I9qrstoX68SqhrmYijjFrKipLGyKYsDy2qMobBOHxAxkwBOVrK+SjZQTQf6TOVqkeMDeOD5amV0edQwzxytpbyRHhLW56I2kxI3lJyJSEmz5LX+DG1hYEJdkVSYOS8+SQkekAvJb3jj2MAVNru7ttyCiltaSK2NGlLV5qIy1oKtpJk00SjS1nxh9CLstETuPodyHtLGwwO3W1WmkhNyKhg1gvn1jARa/hv6e/jzex3OTIO5PGutF9nj77GEEUI0QZELFiphGa67baMNspeCJY8ratUSzVglcUDBQKbDYh79HUi/P8540Sc95YWLgtzbah6sNSh4qswKBDx3PAN2Z7X6wPVUi3rqOgUBMjMoAG28NR5DVQ5cSklRIBcIm+kobuWBqiGgmV6YeFptLQsZ/skRxmtz1054q0btd0LconnazLq8jHso51EM9bSTtbvuJytcZB38kHefgJO4PhBNkIuZ+3Ye84OtDQdE7b0CaxvQrqYFmbHAAAAAElFTkSuQmCC');
	background-repeat: none;
	background-color: #bc0000;
	line-height: 48px;
	text-align: center;
	color: #fff;
	margin: 20px 0;
}
.office_table {
	border-spacing: 0;
	table-layout: fixed;
	width: 100%;
	border-collapse: collapse;
	max-width: 1150px;
	margin: 0 auto;
}
.office_table td {
	padding: 20px 40px;
	position: relative;
}
.office_table td.office_next:after {
	content: ">";
	position: absolute;
	line-height: 60px;
	right: 60px;
	top: 0;
	bottom: 0;
	font-size: 16px;
	color: #9f9f9f;
}
.office_table td.office_img {
	padding: 20px 60px 0;
}
.office_table td img {
	width: 100%;
}

#detail_instruction .office_caption {
	margin-top: 0 !important;
}
</style>
<div style="background-color: #ffffff; padding: 12px 40px;">
	<h1>3D офис</h1>
	<div class="office_line">
		<b>3D ОФИС</b> - это онлайн сервис, использующий 3D технологии для создания интерьеров - от перепланировки помещения до расстановки мебели и выбора отделочных материалов. Мы не ограничиваем вашу фантазию, мы стремимся помочь в реализации ваших идей.
	</div>
	<div class="office_line">
		Вы можете сохранить любую готовую трехмерную сцену под своим логином и паролем для дальнейшего редактирования или создать сцену "с нуля" с помощью программы "Plan Editor". Созданные сцены вы можете сохранять в разделе для персональных сцен или делать их общедоступными. <br>
	</div>
	
	<div class="office_caption office_red">
		5 простых шагов, от начала работы до заказа мебели
	</div>
	<div class="office_line">
		<span class="office_bold office_red">1.</span> Для работы в online версии, проследуйте по ссылке. Рекомендуется использовать последние версии Internet Explorer или Firefox. Вам будет предложено установить необходимые плагины, последовательно установите их и приступите к работе.
	</div>
	<div class="office_line office_center">
		<a class="launch_button" href="http://www.outline3d.ru/main/check.php?ver=defo">ЗАПУСТИТЬ 3D ОФИС</a>
	</div>
</div>
<table class="office_table">
<tr style="border: 2px dashed #dfdfdf; background-color: #fff9f9;">
	<td class="office_next"><span class="office_bold office_red">2.</span> Создайте помещение/интерьер.</td>
	<td class="office_next"><span class="office_bold office_red">3.</span> Расставьте мебель.</td>
	<td><span class="office_bold office_red">4.</span> Оцените результат.</td>
</tr>
<tr>
	<td class="office_img"><img src="/images/about/3d/2.jpg" /></td>
	<td class="office_img"><img src="/images/about/3d/3.jpg" /></td>
	<td class="office_img"><img src="/images/about/3d/4.jpg" /></td>
</tr>
</table>
<div style="background-color: #ffffff; padding: 12px 40px;">
	<div class="office_line">
		<span class="office_bold office_red">5.</span> Сохраните изображение проекта и спецификацию у себя на компьютере, или ссылку на проект и отправьте нам по электронной почте ishop@defo.ru. Не забудьте указать контактные данные, наши менеджеры свяжутся с Вами для уточнения деталей заказа.
	</div>
	<div onclick="$('#detail_instruction').is(':visible')? $('#detail_instruction').hide(): $('#detail_instruction').show();" class="office_line" style="cursor: pointer;">
		<span class="office_bold office_red">&gt;</span> <span style="text-decoration: underline; font-size: 16px;">Подробная инструкция</span>
	</div>
</div>

<div id="detail_instruction" style="background-color: #ffffff; padding: 12px 40px; display: none;">
	<div class="office_caption office_red">
		 Инструкция по эксплуатации
	</div>
	<div class="office_line">
		<span class="office_bold office_red">1.</span> Для начала работы нажмите на кнопку <span class="office_bold">«ЗАПУСТИТЬ 3D ОФИС».</span>
	</div>
	<div class="office_line office_center">
		<a class="launch_button" href="http://www.outline3d.ru/main/check.php?ver=defo">ЗАПУСТИТЬ 3D ОФИС</a>
	</div>
	
	<div class="office_line">
		<span class="office_bold office_red">2.</span> В открывшемся окне нажмите на кнопку <span class="office_bold">«Установить Outline 3D».</span>
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/01.jpg" border="0">
	</div>
	
	<div class="office_line">
		 <span class="office_bold office_red">3.</span> Далее на экране появится всплывающее окно, в котором необходимо нажать на кнопку <span class="office_bold">«Выполнить».</span>
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/02.jpg" border="0">
	</div>

	<div class="office_line">
		 <span class="office_bold office_red">4.</span> На экране появится окно «Мастер Установки Outline3D». В появившемся окне нажмите на кнопку <span class="office_bold">«Установить компоненты Outline3D».</span>
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/03.jpg" border="0">
	</div>

	<div class="office_line">
		 <span class="office_bold office_red">5.</span> Далее на ваш компьютер будут установлены необходимые компоненты для работы с программой. Если вы решили прервать работу, то в любой момент можете остановить загрузку данных, нажав на кнопку <span class="office_bold">«Стоп».</span>
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/04.jpg" border="0">
	</div>

	<div class="office_line">
		 <span class="office_bold office_red">6.</span> После окончания установки нажмите на кнопку <span class="office_bold">«ОК»</span> , чтобы начать работу с программой.
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/05.jpg" border="0">
	</div>

	<div class="office_line">
		  <span class="office_bold office_red">7.</span> В окне браузера автоматически запустится программа «3D ОФИС». <span class="office_bold">Приятной работы!</span>
	</div>
	<div class="office_line office_center">
		<img src="/upload/common/3d/06.jpg" border="0">
	</div>

	<div class="office_caption office_red">
		 Предупреждение!
	</div>
	<div class="office_line">
		 Поскольку система работает через интернет, некоторые антивирусы и браузеры могут перестраховываться и блокировать её работу, если система OutLine не находится в доверенной области браузера/антивируса. Обычно антивирусы выводят предупреждение при блокировке программ и спрашивают разрешать или запрещать доступ. В этом случае надо разрешать или добавить сайт outline3d.ru в доверенную зону.
	</div>
	
	<div onclick="$('#detail_instruction').is(':visible')? $('#detail_instruction').hide(): $('#detail_instruction').show();" class="office_line" style="cursor: pointer;">
		<span class="office_bold office_red">&gt;</span> <span style="text-decoration: underline; font-size: 16px;">Скрыть подробную инструкцию</span>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>