$(document).ready(function () {
	$('body.product .thumbs').simpleGal({
		mainImage: '.preview'
	});

	$('body.product .add-to-cart .controls').on('click', '.arrow', function() {
		var form     = $(this).closest('form');
		var amount   = form.find('input[name="amt"]');
		var price    = form.find('input[name="price"]');

		var delta = $(this).hasClass("up") ? +1 : -1;
		amount.val(Math.min(Math.max(amount.val()*1 + delta, 1), 10));
		
		form.find('.price').text(parseFloat(Math.round(price.val() * amount.val() * 100) / 100).toFixed(2) + " \u20AC");
		form.find('.quantity').text(amount.val());
	});
});