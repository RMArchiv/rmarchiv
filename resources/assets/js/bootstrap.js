import { _ } from "lodash";

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
import { autocomplete } from "@algolia/autocomplete-js";
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// import "jquery-ui";
import * as bootstrap from 'bootstrap'
import Bloodhound from "bloodhound-js"

/**
 *
 * @param {string} domId
 * @param {string} emptyTemplate
 */
const addSearch = ({
    name = "",
    display = "",
    limit = 5,
    targetQuery = "",
    apiPath = "",
    emptyTemplate = "",
    suggestion,
    classNames = {},
    suggestionFunction = (data) => {
        return data.value;
    },
}) => {
    var sourcepath = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: "/" + apiPath + "/%QUERY",
            wildcard: "%QUERY",
        },
    });

    $(targetQuery).typeahead(null, {
        name: name,
        display: display,
        source: sourcepath,
        limit: limit,
        templates: {
            empty: emptyTemplate,
            suggestion: suggestionFunction,
        },
        classNames: {...classNames},
    });
};

window.addSearch = addSearch;

import qq from "fine-uploader";
window.qq = qq;
import "jqcloud2";
import "../js/commonmark";
import "matchheight";
import "bootstrap-rating";
import Dropzone from "dropzone";

// paths.bootstrap        + 'bootstrap.bundle.js',
// paths.typeahead        + 'typeahead.bundle.js',
// paths.fineuploader     + 'fine-uploader.js',
// paths.jqcloud2         + 'jqcloud.js',
// paths.inlineattachment + 'inline-attachment.js',
// paths.inlineattachment + 'jquery.inline-attachment.js',
// paths.js               + 'commonmark.js',
// paths.editormd         + 'editormd.js',
// paths.matchheight      + 'jquery.matchHeight.js',
// paths.bootstraprating  + 'bootstrap-rating.js',
// paths.dropzone         + 'dropzone.js'

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
