$(function () {
    var $html = $('html');
    var navLinkStyle = $('.nav-link-style'),
        mainMenu = $('.main-menu'),
        navbar = $('.header-navbar');
    let theme = localStorage.getItem('theme') || '2';
    let changeTheme = (value) => {
        if (value == '1') {
            $html.removeClass('semi-dark');
            $html.addClass('dark-layout');
            $('.span-text-dark-mode').text('Light mode');
            mainMenu.removeClass('menu-light').addClass('menu-dark');
            $('.footer-main').addClass('color-text-links-footer-green');
            $('.footer-main').removeClass('color-text-links-footer-red');

            $('.info-card').removeClass('light-mode-cards-vue');
            $('.info-card').addClass('dark-mode-cards-vue');

            $('.card-theme-change').addClass('border-dark-card-change-theme');
            $('.card-dark').addClass('active');
            $('.card-light').removeClass('active');
            $('.card-system').removeClass('active');

            $('.vs-popup').addClass('dark-layout');

            $('.link').removeClass('link-light');
            $('.link').addClass('link-dark');


            $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')

            navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({class: 'ficon'}));
            localStorage.setItem('theme', '1')
            $.post('/api/session-theme-change/'+1+'',function (data) {})
        } else if (value == '2') {
            $html.removeClass('dark-layout');
            $html.addClass('semi-dark');
            $('.span-text-dark-mode').text('Dark mode');
            mainMenu.removeClass('menu-dark').addClass('menu-dark');

            $('.footer-main').addClass('color-text-links-footer-red');
            $('.footer-main').removeClass('color-text-links-footer-green');

            $('.body-cards-info-vue').removeClass('dark-mode-cards-text-vue')

            $('.info-card').removeClass('dark-mode-cards-vue');
            $('.info-card').addClass('light-mode-cards-vue');

            $('.card-theme-change').removeClass('border-dark-card-change-theme');
            $('.card-dark').removeClass('active');
            $('.card-light').addClass('active');
            $('.card-system').removeClass('active');

            $('.vs-popup').removeClass('dark-layout');

            $('.link').removeClass('link-dark');
            $('.link').addClass('link-light');

            navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({class: 'ficon'}));
            localStorage.setItem('theme', '2')
            $.post('/api/session-theme-change/'+2+'',function (data) {})
        }else{
            $('.card-dark').removeClass('active');
            $('.card-light').removeClass('active');
            $('.card-system').addClass('active');
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                $html.removeClass('semi-dark');
                $html.addClass('dark-layout');
                $('.span-text-dark-mode').text('Light mode');
                mainMenu.removeClass('menu-light').addClass('menu-dark');
                $('.footer-main').addClass('color-text-links-footer-green');
                $('.footer-main').removeClass('color-text-links-footer-red');

                $('.info-card').removeClass('light-mode-cards-vue');
                $('.info-card').addClass('dark-mode-cards-vue');

                $('.vs-popup').addClass('dark-layout');

                $('.link').removeClass('link-light');
                $('.link').addClass('link-dark');

                $('.card-theme-change').addClass('border-dark-card-change-theme');

                $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')

                navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({class: 'ficon'}));

                localStorage.setItem('theme', '3')
                $.post('/api/session-theme-change/'+3+'',function (data) {})
            }else{
                $html.removeClass('dark-layout');
                $html.addClass('semi-dark');
                $('.span-text-dark-mode').text('Dark mode');
                mainMenu.removeClass('menu-dark').addClass('menu-dark');

                $('.footer-main').addClass('color-text-links-footer-red');
                $('.footer-main').removeClass('color-text-links-footer-green');

                $('.card-theme-change').removeClass('border-dark-card-change-theme');

                $('.body-cards-info-vue').removeClass('dark-mode-cards-text-vue')

                $('.info-card').removeClass('dark-mode-cards-vue');
                $('.info-card').addClass('light-mode-cards-vue');

                $('.vs-popup').removeClass('dark-layout');

                $('.link').removeClass('link-dark');
                $('.link').addClass('link-light');

                navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({class: 'ficon'}));

                localStorage.setItem('theme', '4')
                $.post('/api/session-theme-change/'+4+'',function (data) {})
            }

        }
    }

    changeTheme(theme)

    $(".icon-theme").click(function () {
        let dataChangeValue = $(this).attr('value-theme')
        // let themeCurrent = localStorage.getItem('theme')
        let value = dataChangeValue
        changeTheme(value)
    });
     let themeCurrent = localStorage.getItem('theme')
    if (window.themeSession == '3' || themeCurrent == '3'){
    window.matchMedia('(prefers-color-scheme: dark)')
        .addEventListener('change', event => {
            if (event.matches) {
                $html.removeClass('semi-dark');
                $html.addClass('dark-layout');
                $('.span-text-dark-mode').text('Light mode');
                mainMenu.removeClass('menu-light').addClass('menu-dark');
                $('.footer-main').addClass('color-text-links-footer-green');
                $('.footer-main').removeClass('color-text-links-footer-red');

                $('.info-card').removeClass('light-mode-cards-vue');
                $('.info-card').addClass('dark-mode-cards-vue');

                $('.card-theme-change').addClass('border-dark-card-change-theme');
                $('.vs-popup').addClass('dark-layout');

                $('.link').removeClass('link-light');
                $('.link').addClass('link-dark');

                $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')

                navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({class: 'ficon'}));
                localStorage.setItem('theme', '3')
                $.post('/api/session-theme-change/'+3+'',function (data) {})
            } else {
                $html.removeClass('dark-layout');
                $html.addClass('semi-dark');
                $('.span-text-dark-mode').text('Dark mode');
                mainMenu.removeClass('menu-dark').addClass('menu-dark');

                $('.footer-main').addClass('color-text-links-footer-red');
                $('.footer-main').removeClass('color-text-links-footer-green');

                $('.card-theme-change').removeClass('border-dark-card-change-theme');
                $('.vs-popup').removeClass('dark-layout');

                $('.link').removeClass('link-dark');
                $('.link').addClass('link-light');

                $('.body-cards-info-vue').removeClass('dark-mode-cards-text-vue')

                $('.info-card').removeClass('dark-mode-cards-vue');
                $('.info-card').addClass('light-mode-cards-vue');

                navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({class: 'ficon'}));
                localStorage.setItem('theme', '4')
                $.post('/api/session-theme-change/'+4+'',function (data) {})
            }
        })
    }


    var $body= $('body')
    let menu = localStorage.getItem('menu-sidebar') || '2'

    let changeMenu = (menuValue) => {
        if (menuValue == '1'){
            $body.removeClass('menu-expanded')
            $body.addClass('menu-collapsed')
            localStorage.setItem('menu-sidebar', '1')
            $.post('/api/session-sidebar-backend/'+1+'',function (data) {})
        }else{
            $body.removeClass('menu-collapsed')
            $body.addClass('menu-expanded')
            localStorage.setItem('menu-sidebar', '2')
            $.post('/api/session-sidebar-backend/'+2+'',function (data) {})
        }
    }
    changeMenu(menu)
    $("#event-menu-sidebar").click(function () {
        let menuValueCurrent = localStorage.getItem('menu-sidebar')
        let menuValue = (menuValueCurrent == '1') ? '2' : '1'
        changeMenu(menuValue)
    });

})
