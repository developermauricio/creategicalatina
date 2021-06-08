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
            $('.incon-help-brief').addClass('dark-layout');
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
            $('.multiselect__tags').addClass('dark-layout');
            $('.multiselect__content-wrapper').addClass('dark-layout');
            $('.multiselect__single').addClass('dark-layout');
            $('.country-selector__input').addClass('dark-layout');

            $('.wizard-nav-pills').addClass('dark-layout');
            $('.input-tel__input').addClass('dark-layout');

            $('.link').removeClass('link-light');
            $('.link').addClass('link-dark');

            $('.btn-export-datatable').removeClass('theme-light');

            $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')

            $('.datatablescreategica').addClass('datatable-dark')
            $('.datatablescreategica').removeClass('datatable-light')

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
            $('.incon-help-brief').removeClass('dark-layout');

            $('.wizard-nav-pills').removeClass('dark-layout');
            $('.multiselect__tags').removeClass('dark-layout');
            $('.country-selector__input').removeClass('dark-layout');
            $('.multiselect__single').removeClass('dark-layout');

            $('.card-theme-change').removeClass('border-dark-card-change-theme');
            $('.card-dark').removeClass('active');
            $('.card-light').addClass('active');
            $('.card-system').removeClass('active');
            $('.multiselect__content-wrapper').removeClass('dark-layout');
            $('.vs-popup').removeClass('dark-layout');
            $('.multiselect__option--highlight').removeClass('dark-layout');
            $('.input-tel__input').removeClass('dark-layout');

            $('.link').removeClass('link-dark');
            $('.link').addClass('link-light');

            $('.datatablescreategica').addClass('datatable-light')
            $('.datatablescreategica').removeClass('datatable-dark')

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
                $('.incon-help-brief').addClass('dark-layout');
                $('.wizard-nav-pills').addClass('dark-layout');
                $('.info-card').removeClass('light-mode-cards-vue');
                $('.info-card').addClass('dark-mode-cards-vue');
                $('.btn-export-datatable').removeClass('theme-light');
                $('.vs-popup').addClass('dark-layout');
                $('.multiselect__option--highlight').addClass('dark-layout');
                $('.country-selector__input').addClass('dark-layout');
                $('.link').removeClass('link-light');
                $('.link').addClass('link-dark');
                $('.input-tel__input').addClass('dark-layout');
                $('.multiselect__single').addClass('dark-layout');

                $('.card-theme-change').addClass('border-dark-card-change-theme');
                $('.multiselect__content-wrapper').addClass('dark-layout');
                $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')
                $('.multiselect__tags').addClass('dark-layout');
                $('.datatablescreategica').addClass('datatable-dark')
                $('.datatablescreategica').removeClass('datatable-light')

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
                $('.incon-help-brief').removeClass('dark-layout');
                $('.body-cards-info-vue').removeClass('dark-mode-cards-text-vue')
                $('.datatablescreategica').addClass('datatable-light')
                $('.wizard-nav-pills').removeClass('dark-layout');
                $('.info-card').removeClass('dark-mode-cards-vue');
                $('.info-card').addClass('light-mode-cards-vue');
                $('.multiselect__tags').removeClass('dark-layout');
                $('.vs-popup').removeClass('dark-layout');
                $('.country-selector__input').removeClass('dark-layout');
                $('.multiselect__option--highlight').removeClass('dark-layout');
                $('.multiselect__single').removeClass('dark-layout');

                $('.multiselect__content-wrapper').removeClass('dark-layout');
                $('.link').removeClass('link-dark');
                $('.link').addClass('link-light');
                $('.input-tel__input').removeClass('dark-layout');

                $('.datatablescreategica').addClass('datatable-light')
                $('.datatablescreategica').removeClass('datatable-dark')

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
    if (window.themeSession == '3' || themeCurrent == '3' || window.themeSession == '4' || themeCurrent == '4' || window.themeSession == '1' || themeCurrent == '1'){
    window.matchMedia('(prefers-color-scheme: dark)')
        .addEventListener('change', event => {
            if (event.matches) {
                $html.removeClass('semi-dark');
                $html.addClass('dark-layout');
                $('.span-text-dark-mode').text('Light mode');
                mainMenu.removeClass('menu-light').addClass('menu-dark');
                $('.footer-main').addClass('color-text-links-footer-green');
                $('.footer-main').removeClass('color-text-links-footer-red');
                $('.wizard-nav-pills').addClass('dark-layout');
                $('.info-card').removeClass('light-mode-cards-vue');
                $('.info-card').addClass('dark-mode-cards-vue');
                $('.incon-help-brief').addClass('dark-layout');
                $('.card-theme-change').addClass('border-dark-card-change-theme');
                $('.vs-popup').addClass('dark-layout');
                $('.multiselect__single').addClass('dark-layout');
                $('.link').removeClass('link-light');
                $('.link').addClass('link-dark');
                $('.multiselect__tags').addClass('dark-layout');
                $('.datatablescreategica').addClass('datatable-dark')
                $('.datatablescreategica').removeClass('datatable-light')
                $('.multiselect__option--highlight').addClass('dark-layout');
                $('.country-selector__input').addClass('dark-layout');

                $('.multiselect__content-wrapper').addClass('dark-layout');
                $('.body-cards-info-vue').addClass('dark-mode-cards-text-vue')
                $('.input-tel__input').addClass('dark-layout');

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
                $('.wizard-nav-pills').removeClass('dark-layout');
                $('.card-theme-change').removeClass('border-dark-card-change-theme');
                $('.vs-popup').removeClass('dark-layout');
                $('.incon-help-brief').removeClass('dark-layout');
                $('.link').removeClass('link-dark');
                $('.link').addClass('link-light');
                $('.multiselect__tags').removeClass('dark-layout');
                $('.body-cards-info-vue').removeClass('dark-mode-cards-text-vue')
                $('.multiselect__option--highlight').removeClass('dark-layout');
                $('.country-selector__input').removeClass('dark-layout');
                $('.info-card').removeClass('dark-mode-cards-vue');
                $('.info-card').addClass('light-mode-cards-vue');
                $('.input-tel__input').removeClass('dark-layout');
                $('.multiselect__single').removeClass('dark-layout');

                $('.multiselect__content-wrapper').removeClass('dark-layout');

                $('.datatablescreategica').addClass('datatable-light')
                $('.datatablescreategica').removeClass('datatable-dark')

                navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({class: 'ficon'}));
                localStorage.setItem('theme', '4')
                $.post('/api/session-theme-change/'+4+'',function (data) {})
            }
        })
    }

    var win = window.location;
    var webPath = win.pathname;
    console.log(webPath);

    var $body= $('body')
    let menu =  window.sideBarMenu || '2'

    if (webPath === '/'+window.lang+'/new-project'){
        $body.addClass('menu-collapsed')
        $body.removeClass('menu-expanded')
        $('.logo-backend-vertical').css("display","block")
        $('.logo-backend-horizontal').css("display","none")
        return
    }
    if (webPath === '/'+window.lang+'/admin-projects' || window.rutaShowProject == '1'){
        $body.addClass('menu-collapsed')
        $body.removeClass('menu-expanded')
        $('.logo-backend-vertical').css("display","block")
        $('.logo-backend-horizontal').css("display","none")
        return
    }

    let changeMenu = (menuValue) => {
        console.log(menuValue)
        if (menuValue == '1'){
            $('.logo-backend-vertical').css("display","block")
            $('.logo-backend-horizontal').css("display","none")
            $body.removeClass('menu-expanded')
            $body.addClass('menu-collapsed')
            localStorage.setItem('menu-sidebar', '1')
            $.post('/api/session-sidebar-backend/'+1+'',function (data) {})
        }else{
            $body.removeClass('menu-collapsed')
            $body.addClass('menu-expanded')
            localStorage.setItem('menu-sidebar', '2')
            $('.logo-backend-vertical').css("display","none")
            $('.logo-backend-horizontal').css("display","block")
            $.post('/api/session-sidebar-backend/'+2+'',function (data) {})
        }
    }
    changeMenu(menu)
    $(".event-menu-sidebar").click(function () {

        let menuValueCurrent = localStorage.getItem('menu-sidebar')
        let menuValue = (menuValueCurrent == '1') ? '2' : '1'
        changeMenu(menuValue)
    });
    // $("#menu-backend").find(['expanded'])
})
