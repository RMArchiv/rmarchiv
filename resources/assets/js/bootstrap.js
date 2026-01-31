import * as bootstrap from 'bootstrap'
import { createAutocomplete } from "./autocomplete.js";
import $ from 'jquery';
import * as qq from "fine-uploader";
import { filterInput, removeRecipient, selectedRecipient, setupCheckBoxes } from './recipientList.js';

window["bootstrap"] = bootstrap;
window["createAutocomplete"] = createAutocomplete;
window["setupCheckBoxes"] = setupCheckBoxes;
window["selectedRecipient"] = selectedRecipient;
window["removeRecipient"] = removeRecipient;
window["filterInput"] = filterInput;
window["$"] = $;
window["jQuery"] = $;
window["qq"] = qq;

function randomHexColor( ) {
  function randomHex() {
    return Math.floor(Math.random() * 16).toString(16)
  }
  return randomHex() + "" + randomHex() + "" + randomHex() + "" + randomHex() + "" + randomHex() + "" + randomHex()
}
window["randomHexColor"] = randomHexColor

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

// Vue.http.interceptors.push(function(request, next) {
//     request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

//     next();
// });

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
