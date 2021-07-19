$(function (){
    $('.openMenu').addClass('hide');
    $('.hamburgerMenu').on('click', function(){
        $(this).parent().next('.openMenu').toggleClass('show');
        $('.hamburgerMenu span:nth-child(1)').toggleClass('openArrowTop')
        $('.hamburgerMenu span:nth-child(2)').toggleClass('arrowHide');
        $('.hamburgerMenu span:nth-child(3)').toggleClass('openArrowBottom')
    });
});