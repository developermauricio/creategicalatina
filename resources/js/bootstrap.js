window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    // window.Popper = require('popper.js').default;
    // window.$ = window.jQuery = require('jquery');
    //
    // require('bootstrap');
} catch (e) { }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

let echo = null;

try {
    echo = new Echo({
        broadcaster: 'socket.io',
        host: `${window.location.hostname}:${window.laravelEchoPort}`,
        // host: "creategicalatina.test:6001",
        transports: ['websocket']
    });

    let init = false;

    echo.connector.socket.on('connect', function () {
        if (init) {
            setTimeout(() => {
                Pace.stop();
            }, 500)
        } else {
            init = true;
        }
    });

    // echo.connector.socket.on('disconnect', function () {
    //     console.log('disconnected');
    // });

    // echo.connector.socket.on('reconnecting', function (attemptNumber) {
    //     console.log('reconnecting', attemptNumber);
    // });
} catch (error) {
    console.log('init echo: ', error);
}

window.Echo = echo;

const channels = {};

export const EchoPrivate = (channel_name, listen_name, callback) => {
    if (!echo) {
        return;
    }
    const key_channel = btoa(channel_name);
    if (!channels[key_channel]) {
        channels[key_channel] = {
            socket: null,
            listens: {}
        }
        try {
            channels[key_channel] = {
                socket: echo.private(channel_name),
                listens: {}
            }
        } catch (error) {
            console.log('channel: ', error);
        }
    }
    const channel = channels[key_channel];
    if (!channel.socket) {
        return;
    }

    const key_listen = btoa(listen_name);
    if (!channel.listens[key_listen]) {
        channel.listens[key_listen] = {
            callbacks: [],
            listen: function (e) {
                this.callbacks.forEach(c => c(e));
            }
        };

        try {
            channel.socket.listen(listen_name, (e) => {
                channel.listens[key_listen].listen(e);
            })
        } catch (error) {
            console.log('listing: ', error);
        }
    }

    channel.listens[key_listen].callbacks.push(callback);
}
