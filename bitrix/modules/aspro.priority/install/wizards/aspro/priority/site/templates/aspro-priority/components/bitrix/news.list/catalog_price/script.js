BX.addCustomEvent('onWindowResize', function(eventdata) {
	ignoreResize.push(true);
	checkTable();
	ignoreResize.pop();
});

$(document).ready(function(){
	setBasketItemsClasses();
	checkTable();
});