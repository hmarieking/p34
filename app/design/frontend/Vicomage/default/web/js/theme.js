/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
require([
    'jquery',
    'mage/smart-keyboard-handler',
    'mage/mage',
    'mage/ie-class-fixer',
    'domReady!'
], function ($, keyboardHandler) {
    'use strict';

    if ($('body').hasClass('checkout-cart-index')) {
        if ($('#co-shipping-method-form .fieldset.rates').length > 0 && $('#co-shipping-method-form .fieldset.rates :checked').length === 0) {
            $('#block-shipping').on('collapsiblecreate', function () {
                $('#block-shipping').collapsible('forceActivate');
            });
        }
    }
    $('.cart-summary').mage('sticky', {
        container: '#maincontent'
    });
    $('.page-header .header.links').clone().appendTo('#store\\.links');
    keyboardHandler.apply();
});

/******************** Js Custom ***********************/
require([
    'jquery',
    'parallax'
], function ($) {
	
	//ScrollTop
	$('#backtotop').hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 350) {
            $('#backtotop').show();
        }
        else{
            $('#backtotop').hide();
        }
        return false;
    });
	$(document).ready(function($) {
		$('#backtotop').click(function(e) {
			$('html,body').animate({scrollTop:0}, 500);
			return false;
			e.preventDefault();
		});
	});
	
	//parallax
    $(document).ready(function($) {
		if($('.bg-parallax').length >0){
			$('.bg-parallax').each(function(){
				$(this).parallax("50%",0.1);
			})  
		}	
	});
});

