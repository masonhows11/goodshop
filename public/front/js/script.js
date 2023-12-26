/*----------------------- mobile menu --------------------*/

$('.mobile-menu-level-1 > li.has-mobile-submenu > a').on('click', function () {
    var _this = $(this).parent();

    if (_this.hasClass('open')) {

        _this.removeClass('open');
        _this.find('.mobile-menu-level-2').slideUp(200);

    }

    else {

        _this.addClass('open');
        _this.find('.mobile-menu-level-2').slideDown(200);
        _this.siblings('li').children('.mobile-menu-level-2').slideUp(200);
        _this.siblings('li').removeClass('open')

    }
})

$('.mobile-menu-level-2 > li.has-mobile-submenu-2 > a').on('click', function () {
    var _this1 = $(this).parent();

    if (_this1.hasClass('open')){

        _this1.removeClass('open');
        _this1.find('.mobile-menu-level-3').slideUp(200);
    }

    else {

        _this1.addClass('open');
        _this1.find('.mobile-menu-level-3').slideDown(200);
        _this1.siblings('li').children('.mobile-menu-level-3').slideUp(200);
        _this1.siblings('li').removeClass('open')

    }
})


/*----------------------- owl carousel slider --------------------*/

$(document).ready()
{
    $('.best-suggestion-slider').owlCarousel({
        items:4,
        navigation : true,
        rtl:true,
        nav:true,
        dots:true,
        margin:3,
        loop:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            800:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            }

        }
    });


    $('.custom-product-slider').owlCarousel({
        items:4,
        navigation : true,
        rtl:true,
        nav:true,
        dots:true,
        margin:3,
        loop:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            800:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            }

        }
    });
}

/*----------------------- count down timer --------------------*/

$(document).ready(function (){

    $(function(){
        $('.timer').startTimer();
    });

});


/*----------------------- tooltip --------------------*/

// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//   return new bootstrap.Tooltip(tooltipTriggerEl)
// })

/*----------------------- range slider --------------------*/

$(function () {
    var steps = $('.divv');
    steps.each(function () {
        var self = $(this);
        var step_title = self.attr('data-title')
        var slider = self.parent();
        var title;
        self.hover(function () {
            title = slider.attr('data-title');
            slider.attr('data-title', step_title);
        }, function () {
            slider.attr('data-title', title);
        })

        self.on('click', function () {
            slider.attr('data-title', step_title);
            title = slider.attr('data-title');

            slider.find('.divv').removeClass('is-active');
            self.addClass('is-active');

            var move = parseInt(self.attr('data-value'));

            console.log(move)
            slider.find('.time-line').css({'width': move + '%'});
            slider.find('.slidemove').animate({'right': 'calc('+move+'- ' + 10 + 'px)'}, 200);

        })

    })
})

/*-----------------------  increment & decrement cart --------------------*/

var incrementQty;
var decrementQty;
var plusBtn  = $(".cart-qty-plus");
var minusBtn = $(".cart-qty-minus");

var incrementQty = plusBtn.click(function(){
var $n = $(this)
  .parent(".button-container")
  .find(".qty");
$n.val(Number($n.val())+1 );
});

var decrementQty = minusBtn.click(function(){
    var $n = $(this)
    .parent(".button-container")
    .find(".qty");
  var QtyVal = Number($n.val());
  if (QtyVal > 0) {
    $n.val(QtyVal-1);
  }
});

/*----------------------- scroll to top --------------------*/

$(document).ready(function($){
    var offset = 100;
    var speed = 250;
    var duration = 500;
	   $(window).scroll(function(){
            if ($(this).scrollTop() < offset) {
			     $('.topbutton') .fadeOut(duration);
            } else {
			     $('.topbutton') .fadeIn(duration);
            }
        });
	$('.topbutton').on('click', function(){
		$('html, body').animate({scrollTop:0}, speed);
		return false;
		});
});



