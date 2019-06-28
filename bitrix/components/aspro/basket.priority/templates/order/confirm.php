<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?unset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']);?>
<div class="confirm border">
	<svg class="success_icon" xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90">
	  <path id="Ellipse_273_copy" data-name="Ellipse 273 copy" class="clsp-1" d="M1550,151a45,45,0,1,1-45,45A45,45,0,0,1,1550,151Zm0,2a43,43,0,1,1-43,43A43,43,0,0,1,1550,153Z" transform="translate(-1505 -151)"/>
	  <path class="clsp-2" d="M1539.82,207.4a4.45,4.45,0,0,0,2.9,1.609c0.9,0.014,1.66-.434,2.93-1.854,1.53-1.692,23.35-24.3,23.35-24.3l-1-.852h-2l-2,2-20,21-10-10h-2l-2,1v2l2,4,4.9,3.372Z" transform="translate(-1505 -151)"/>
	  <path id="Rounded_Rectangle_840_copy_2" data-name="Rounded Rectangle 840 copy 2" class="clsp-1" d="M1545.41,212.678a4.006,4.006,0,0,1-4.33-.877h0l-10.91-10.88a4,4,0,0,1,5.66-5.646l8.08,8.057,20.23-21.172a4,4,0,0,1,5.66,5.646L1546.74,211.8A3.924,3.924,0,0,1,1545.41,212.678Zm22.97-26.283a2,2,0,1,0-2.83-2.823l-20.23,21.172-1.41,1.411-1.42-1.411-8.07-8.057a2,2,0,0,0-2.83,0,1.976,1.976,0,0,0,0,2.822l8.45,8.438,2.45,2.443a2.05,2.05,0,0,0,.66.438,2.005,2.005,0,0,0,2.17-.438l2.44-2.432Z" transform="translate(-1505 -151)"/>
	</svg>
	
	<div class="description">
		<h4><?=GetMessage('T_CONFIRM_ORDER_TITLE');?></h4>
		<p><?=GetMessage('T_CONFIRM_ORDER_DESCRIPTION');?></p>
		<div class="buttons">
			<a class="btn btn-default btn-lg" href="<?=$arParams['PATH_TO_CATALOG'];?>"><?=GetMessage('T_HEAD_LINK_CATALOG');?></a>
			<a class="btn btn-default btn-transparent btn-lg" href="<?=SITE_DIR;?>"><?=GetMessage('T_HEAD_LINK_MAIN');?></a>
		</div>
	</div>
</div>
<script>

$(document).ready(function(){
	<?if(!isset($_SESSION['ORDERS'][$_REQUEST['RESULT_ID']])):?>
		if(arPriorityOptions['THEME']['YA_GOLAS'] == 'Y' && arPriorityOptions['THEME']['YA_COUNTER_ID'] && arPriorityOptions['THEME']['USE_SALE_GOALS'] !== 'N')
		{
			var eventdata = {goal: 'goal_order_success'};
			BX.onCustomEvent('onCounterGoals', [eventdata]);
		}
		<?$_SESSION['ORDERS'][$_REQUEST['RESULT_ID']] = $_REQUEST['RESULT_ID'];?>
	<?endif;?>
	if($('.basket_top').length){
		$.ajax({
			url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
			type: 'POST',
		}).success(function(html){
			$('.basket_top').html(html);
		});
	}
});
</script>
