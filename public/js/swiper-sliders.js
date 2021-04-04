$(function () {
    var mySwiper = new Swiper('.swiper-default');
    // centered slides option-1
    var mySwiperOpt1 = new Swiper('.swiper-centered-slides', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
    var swiperLength = $('.swiper-slide').length;
    // activeSlide(swiperLength);
    // Active slide change on swipe
    // mySwiper.on('slideChange', function () {
    //     activeSlide(mySwiper.realIndex);
    // });

    //add class active content of active slide
    // function activeSlide(index) {
    //     var slideEl = mySwiper.slides[index];
    //     var slideId = $(slideEl).attr('id');
    //     $('.wrapper-content').removeClass('active');
    //     $('[data-faq=' + slideId + ']').addClass('active');
    // }
})
