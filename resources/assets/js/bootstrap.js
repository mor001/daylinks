import router from './router'
import store from './store'

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.interceptors.response.use( (response) => {
    return response
}, (error) => {
  if (error.response.status === 401) {
    console.log('response status is 401')
    let path = location.pathname
    if ( path.match(/admin/)) {
      //store.dispatch('admin/logout')
      router.push('/admin/login')
    } else {
      //store.dispatch('auth/logout')
      router.push('/login')
    }
  } else if (error.response.status === 500) {
    console.log('response status is 500')
    window.location = "/500"
  }
  return Promise.reject(error)
  //return error
})

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

if (localStorage.getItem('token')) {
  window.axios.defaults.headers.common['Authorization'] = localStorage.getItem('token')
}

window.moment = require('moment')

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     cluster: 'mt1',
//     encrypted: true
// });
