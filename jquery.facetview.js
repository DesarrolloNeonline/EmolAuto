/*
 * jquery.facetview.js
 *
 * displays faceted browse results by querying a specified elasticsearch index
 * can read config locally or can be passed in as variable when executed
 * or a config variable can point to a remote config
 * 
 * created by Mark MacGillivray - mark@cottagelabs.com
 *
 * http://cottagelabs.com
 *
 * There is an explanation of the options below.
 *
 */

// first define the bind with delay function from (saves loading it separately) 
// https://github.com/bgrins/bindWithDelay/blob/master/bindWithDelay.js





if (typeof console == "undefined") var console = { log: function() {} }; 

if (typeof JSON !== 'object') {
    JSON = {};
}

(function () { 
    'use strict';

    function f(n) {
        // Format integers to have at least two digits.
        return n < 10 ? '0' + n : n;
    }

    if (typeof Date.prototype.toJSON !== 'function') {

        Date.prototype.toJSON = function (key) {

            return isFinite(this.valueOf())
                ? this.getUTCFullYear()     + '-' +
                    f(this.getUTCMonth() + 1) + '-' +
                    f(this.getUTCDate())      + 'T' +
                    f(this.getUTCHours())     + ':' +
                    f(this.getUTCMinutes())   + ':' +
                    f(this.getUTCSeconds())   + 'Z'
                : null;
        };

        String.prototype.toJSON      =
            Number.prototype.toJSON  =
            Boolean.prototype.toJSON = function (key) {
                return this.valueOf();
            };
    }

    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap,
        indent,
        meta = {    // table of character substitutions
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },
        rep;


    function quote(string) {

// If the string contains no control characters, no quote characters, and no
// backslash characters, then we can safely slap some quotes around it.
// Otherwise we must also replace the offending characters with safe escape
// sequences.

        escapable.lastIndex = 0;
        return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
            var c = meta[a];
            return typeof c === 'string'
                ? c
                : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
        }) + '"' : '"' + string + '"';
    }


    function str(key, holder) {

// Produce a string from holder[key].

        var i,          // The loop counter.
            k,          // The member key.
            v,          // The member value.
            length,
            mind = gap,
            partial,
            value = holder[key];

// If the value has a toJSON method, call it to obtain a replacement value.

        if (value && typeof value === 'object' &&
                typeof value.toJSON === 'function') {
            value = value.toJSON(key);
        }

// If we were called with a replacer function, then call the replacer to
// obtain a replacement value.

        if (typeof rep === 'function') {
            value = rep.call(holder, key, value);
        }

// What happens next depends on the value's type.

        switch (typeof value) {
        case 'string':
            return quote(value);

        case 'number':

// JSON numbers must be finite. Encode non-finite numbers as null.

            return isFinite(value) ? String(value) : 'null';

        case 'boolean':
        case 'null':

// If the value is a boolean or null, convert it to a string. Note:
// typeof null does not produce 'null'. The case is included here in
// the remote chance that this gets fixed someday.

            return String(value);

// If the type is 'object', we might be dealing with an object or an array or
// null.

        case 'object':

// Due to a specification blunder in ECMAScript, typeof null is 'object',
// so watch out for that case.

            if (!value) {
                return 'null';
            }

// Make an array to hold the partial results of stringifying this object value.

            gap += indent;
            partial = [];

// Is the value an array?

            if (Object.prototype.toString.apply(value) === '[object Array]') {

// The value is an array. Stringify every element. Use null as a placeholder
// for non-JSON values.

                length = value.length;
                for (i = 0; i < length; i += 1) {
                    partial[i] = str(i, value) || 'null';
                }

// Join all of the elements together, separated with commas, and wrap them in
// brackets.

                v = partial.length === 0
                    ? '[]'
                    : gap
                    ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']'
                    : '[' + partial.join(',') + ']';
                gap = mind;
                return v;
            }

// If the replacer is an array, use it to select the members to be stringified.

            if (rep && typeof rep === 'object') {
                length = rep.length;
                for (i = 0; i < length; i += 1) {
                    if (typeof rep[i] === 'string') {
                        k = rep[i];
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            } else {

// Otherwise, iterate through all of the keys in the object.

                for (k in value) {
                    if (Object.prototype.hasOwnProperty.call(value, k)) {
                        v = str(k, value);
                        if (v) {
                            partial.push(quote(k) + (gap ? ': ' : ':') + v);
                        }
                    }
                }
            }

// Join all of the member texts together, separated with commas,
// and wrap them in braces.

            v = partial.length === 0
                ? '{}'
                : gap
                ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}'
                : '{' + partial.join(',') + '}';
            gap = mind;
            return v;
        }
    }

// If the JSON object does not yet have a stringify method, give it one.

    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function (value, replacer, space) {

// The stringify method takes a value and an optional replacer, and an optional
// space parameter, and returns a JSON text. The replacer can be a function
// that can replace values, or an array of strings that will select the keys.
// A default replacer method can be provided. Use of the space parameter can
// produce text that is more easily readable.

            var i;
            gap = '';
            indent = '';

// If the space parameter is a number, make an indent string containing that
// many spaces.

            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' ';
                }

// If the space parameter is a string, it will be used as the indent string.

            } else if (typeof space === 'string') {
                indent = space;
            }

// If there is a replacer, it must be a function or an array.
// Otherwise, throw an error.

            rep = replacer;
            if (replacer && typeof replacer !== 'function' &&
                    (typeof replacer !== 'object' ||
                    typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }

// Make a fake root object containing our value under the key of ''.
// Return the result of stringifying the value.

            return str('', {'': value});
        };
    }


// If the JSON object does not yet have a parse method, give it one.

    if (typeof JSON.parse !== 'function') {
        JSON.parse = function (text, reviver) {

// The parse method takes a text and an optional reviver function, and returns
// a JavaScript value if the text is a valid JSON text.

            var j;

            function walk(holder, key) {

// The walk method is used to recursively walk the resulting structure so
// that modifications can be made.

                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.prototype.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v;
                            } else {
                                delete value[k];
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value);
            }


// Parsing happens in four stages. In the first stage, we replace certain
// Unicode characters with escape sequences. JavaScript handles many characters
// incorrectly, either silently deleting them, or treating them as line endings.

            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' +
                        ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
                });
            }

// In the second stage, we run the text against regular expressions that look
// for non-JSON patterns. We are especially concerned with '()' and 'new'
// because they can cause invocation, and '=' because it can cause mutation.
// But just to be safe, we want to reject all unexpected forms.

// We split the second stage into 4 regexp operations in order to work around
// crippling inefficiencies in IE's and Safari's regexp engines. First we
// replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
// replace all simple value tokens with ']' characters. Third, we delete all
// open brackets that follow a colon or comma or that begin the text. Finally,
// we look to see that the remaining characters are only whitespace or ']' or
// ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.

            if (/^[\],:{}\s]*$/
                    .test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                        .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
                        .replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

// In the third stage we use the eval function to compile the text into a
// JavaScript structure. The '{' operator is subject to a syntactic ambiguity
// in JavaScript: it can begin a block or an object literal. We wrap the text
// in parens to eliminate the ambiguity.

                j = eval('(' + text + ')');

// In the optional fourth stage, we recursively walk the new structure, passing
// each name/value pair to a reviver function for possible transformation.

                return typeof reviver === 'function'
                    ? walk({'': j}, '')
                    : j;
            }

// If the text is not JSON parseable, then a SyntaxError is thrown.

            throw new SyntaxError('JSON.parse');
        };
    }
}());


(function($) {
    $.fn.bindWithDelay = function( type, data, fn, timeout, throttle ) {
        var wait = null;
        var that = this;

        if ( $.isFunction( data ) ) {
            throttle = timeout;
            timeout = fn;
            fn = data;
            data = undefined;
        }

        function cb() {
            var e = $.extend(true, { }, arguments[0]);
            var throttler = function() {
                wait = null;
                fn.apply(that, [e]);
            };

            if (!throttle) { clearTimeout(wait); }
            if (!throttle || !wait) { wait = setTimeout(throttler, timeout); }
        }

        return this.bind(type, data, cb);
    };
})(jQuery);

// add extension to jQuery with a function to get URL parameters
jQuery.extend({
    getUrlVars: function() {
        var params = new Object;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for ( var i = 0; i < hashes.length; i++ ) {
            hash = hashes[i].split('=');
            if ( hash.length > 1 ) {
                if ( hash[1].replace(/%22/gi,"")[0] == "[" || hash[1].replace(/%22/gi,"")[0] == "{" ) {
                    hash[1] = hash[1].replace(/^%22/,"").replace(/%22$/,"");
                    var newval = JSON.parse(unescape(hash[1].replace(/%22/gi,'"')));
                } else {
                    var newval = unescape(hash[1].replace(/%22/gi,'"'));
                }
                params[hash[0]] = newval;
            }
        }
        return params;
    },
    getUrlVar: function(name){
        return jQuery.getUrlVars()[name];
    }
});

function checkvalidate(checks) {
    for (i = 0; lcheck = checks[i]; i++) {
        if (lcheck.checked) {
            return true;
        }
    }
    return false;
}

function procesa(id_auto){

    var grupo = document.getElementById("frm1").autoselect;
    if (checkvalidate(grupo)) 
    {
           
       var parametros = {
                        "id_auto" : id_auto
                        };
                $.ajax({
                        data:  parametros,
                        url:    'procesa_guardado.php',
                        type:   'post',
                        beforeSend: function () {
                        },
                        success:  function (response) {
                                $("#resultado").append(response);
                        }
                    });


    }   else  {
                document.getElementById("resultado").innerHTML="";
              }
}

function getUrlVars() 
{
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function sortNumber(a,b) {
    return a - b;
}

// Deal with indexOf issue in <IE9
// provided by commentary in repo issue - https://github.com/okfn/facetview/issues/18
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(searchElement /*, fromIndex */ ) {
        "use strict";
        if (this == null) {
            throw new TypeError();
        }
        var t = Object(this);
        var len = t.length >>> 0;
        if (len === 0) {
            return -1;
        }
        var n = 0;
        if (arguments.length > 1) {
            n = Number(arguments[1]);
            if (n != n) { // shortcut for verifying if it's NaN
                n = 0;
            } else if (n != 0 && n != Infinity && n != -Infinity) {
                n = (n > 0 || -1) * Math.floor(Math.abs(n));
            }
        }
        if (n >= len) {
            return -1;
        }
        var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
        for (; k < len; k++) {
            if (k in t && t[k] === searchElement) {
                return k;
            }
        }
        return -1;
    }
}

function str_replace (search, replace, subject, count) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Gabriel Paderni
  // +   improved by: Philip Peterson
  // +   improved by: Simon Willison (http://simonwillison.net)
  // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +   bugfixed by: Anton Ongson
  // +      input by: Onno Marsman
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +    tweaked by: Onno Marsman
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   input by: Oleg Eremeev
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Oleg Eremeev
  // %          note 1: The count parameter must be passed as a string in order
  // %          note 1:  to find a global variable in which the result will be given
  // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
  // *     returns 1: 'Kevin.van.Zonneveld'
  // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
  // *     returns 2: 'hemmo, mars'
  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp).split(f[j]).join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}

/* EXPLAINING THE FACETVIEW OPTIONS

Facetview options can be set on instantiation. The list below details which options are available.

Options can also be set and retrieved externally via $.fn.facetview.options.

Query values can also be read from the query parameters of the current page, or provided in
the "source" option for initial search.

Also, whilst facetview is executing a query, it will "show" any element with the "notify-loading" class.
So that class can be applied to any element on a page that can be used to signify loading is taking place.

Once facetview has executed a query, the querystring used is available under "options.querystring".
And the result object as retrieved directly from the index is available under "options.rawdata".

searchbox_class
---------------
This should only be set if embedded_search is set to false, and if an alternative search box on the page should 
be used as the source of search terms. If so, this should be set to 
the class name (including preceding .) of the text input that should be used as the source of the search terms.
It is only a class instead of an ID so that it can be applied to fields that may already have an ID - 
it should really identify a unique box on the page for entering search terms for this instance of facetview.
So an ID could actually also be used - just precede with # instead of .
This makes it possible to embed a search box anywhere on a page and have it be used as the source of simple 
search parameters for the facetview. Only the last text box with this clas will be used.

embedded_search
---------------
Default to true, in which case full search term functionality is created and displayed on the page.
If this is false, the search term text box and options will be hidden, so that new search terms cannot 
be provided by the user.
It is possible to set an alternative search term input box on the page instead, by setting this to false and 
also setting a searchbox_class value to identify the basic source of search terms, in which case such a box 
must be manually created elsewhere on the page.

searchbox_shade
---------------
The background colour to apply to the search box

sharesave_link
--------------
Default to true, in which case the searchbox - if drawn by facetview - will be appended with a button that 
shows the full current search parameters as a URL.

config_file
-----------
Specify as a URL from which to pull a JSON config file specifying these options.

facets
------
A list of facet objects which should be created as filter options on the page.
As per elasticsearch facets settings, plus "display" as a display name for the facet, instead of field name.
If these should be nested, define them with full scope e.g. nestedobj.nestedfield.

extra_facets
------------
An object of named extra facet objects that should be submitted and executed on each query.
These will NOT be used to generate filters on the page, but the result object can be queried 
for their content for other purposes.

searchbox_fieldselect
---------------------
A list of objects specifying fields to which search terms should be restricted.
Each object should have a "display" value for displaying as the name of the option, 
and a "field" option specifying the field to restrict the search to.

search_sortby
----------------
A list of objects describing sort option dropdowns. 
Each object requires a "display" value, and "field" value upon which to sort results.
NOTE sort fields must be unique on the ES index, NOT lists. Otherwise it will fail silently. Choose wisely.

enable_rangeselect
------------------
RANGES NEED SOME WORK AFTER RECENT UPDATE, KEEP DISABLED FOR NOW
Enable or disable the ability to select a range of filter values

include_facets_in_querystring
-----------------------------
Default to false.
Whether or not to include full facet settings in the querystring when it is requested for display.
This makes it easier to get the querystring for other purposes, but does not change the query that is 
sent to the index.

result_display
--------------
A display template for search results. It is a list of lists.
Each list specifies a line. Within each list, specify the contents of the line using objects to describe 
them. Each content piece should pertain to a particular "field" of the result set, and should specify what 
to show "pre" and "post" the given field

display_images
--------------
Default to true, in which case any image found in a given result object will be displayed to the left 
in the result object output.

description
-----------
Just an option to provide a human-friendly description of the functionality of the instantiated facetview.
Like "search my shop". Will be displayed on the page. 

search_url
----------
The URL at the index to which searches should be submitted in order to retrieve JSON results.

datatype
--------
The datatype that should be used when submitting a search to the index - e.g. JSON for local, JSONP for remote.

initialsearch
-------------
Default to true, in which case a search-all will be submitted to the index on page load.
Set to false to wait for user input before issuing the first search.

fields
------
A list of which fields the index should return in result objects (by default elasticsearch returns them all).

partial_fields
--------------
A definition of which fields to return, as per elasticsearch docs http://www.elasticsearch.org/guide/reference/api/search/fields.html

nested
------
A list of keys for which the content should be considered nested for query and facet purposes.
NOTE this requires that such keys be referenced with their full scope e.g. nestedobj.nestedfield.
Only works on top-level keys so far.

default_url_params
------------------
Any query parameters that the index search URL needs by default.

freetext_submit_delay
---------------------
When search terms are typed in the search box, they are automatically submitted to the index.
This field specifies in milliseconds how long to wait before sending another query - e.g. waiting
for the user to finish typing a word.

q
-
Specify a query value to start with when the page is loaded. Will be submitted as the initial search value 
if initialsearch is enabled. Will also be set as the value of the searchbox on page load.

predefined_filters
------------------
Facet / query values to apply to all searches. Give each one a reference key, then in each object define it 
as per an elasticsearch query for appending to the bool must. 
If these filters should be applied at the nested level, then prefix the name with the relevant nesting prefix. 
e.g. if the nested object is called stats, call the filter stats.MYFILTER.

paging
------
An object defining the paging settings:

    from
    ----
    Which result number to start displaying results from

    size
    ----
    How many results to get and display per "page" of results

pager_on_top
------------
Default to false, in which case the pager - e.g. result count and prev / next page buttons - only appear 
at the bottom of the search results.
Set to true to show the pager at the top of the search results as well.

pager_slider
------------
If this is set to true, then the paging options will be a left and right arrow at the bottom, with the 
count in between, but a bit bigger and more slider-y than the standard one. Works well for displaying 
featured content, for example.

sort
----
A list of objects defining how to sort the results, as per elasticsearch sorting.

searchwrap_start
searchwrap_end
----------------
HTML values in which to wrap the full result set, to style them into the page they are being injected into.

resultwrap_start
resultwrap_end
----------------
HTML values in which to wrap each result object

result_box_colours
------------------
A list of background colours that will be randomly assigned to each result object that has the "result_box" 
class. To use this, specify the colours in this list and ensure that the "result_display" option uses the 
"result_box" class to wrap the result objects.

fadein
------
Define a fade-in delay in milliseconds so that whenever a new list of results is displays, it uses the fade-in effect.

post_search_callback
--------------------
This can define or reference a function that will be executed any time new search results are retrieved and presented on the page.

pushstate
---------
Updates the URL string with the current query when the user changes the search terms

linkify
-------
Makes any URLs in the result contents into clickable links

default_operator
----------------
Sets the default operator in text search strings - elasticsearch uses OR by default, but can also be AND

default_freetext_fuzzify
------------------------
If this exists and is not false, it should be either * or ~. If it is * then * will be prepended and appended
to each string in the freetext search term, and if it is ~ then ~ will be appended to each string in the freetext 
search term. If * or ~ or : are already in the freetext search term, it will be assumed the user is already trying 
to do a complex search term so no action will be taken. NOTE these changes are not replicated into the freetext 
search box - the end user will not know they are happening.

*/
//Variable filter

if(getUrlVars()["busqueda"]){

    localStorage.setItem("sortQuery", null);
}

if(getUrlVars()["busqueda"]){
    localStorage.setItem("typeSearch", getUrlVars()["busqueda"]);
    localStorage.setItem("typeGet", getUrlVars()["type"]);
    localStorage.setItem("priceUpGet", getUrlVars()["priceUp"]);
    localStorage.setItem("priceDownGet", getUrlVars()["priceDown"]);
    localStorage.setItem("annoGet", getUrlVars()["anno"]);
}
var counterClick = null;
var counterRangePrice = null;
var counterClick2 = null;

// now the facetview function
(function($){
    $.fn.facetview = function(options) {

        // a big default value (pulled into options below)
        // demonstrates how to specify an output style based on the fields that can be found in the result object
        // where a specified field is not found, the pre and post for it are just ignored
        var resdisplay = [
                [
                    {
                        "field": "author.name"
                    },
                    {
                        "pre": "(",
                        "field": "year",
                        "post": ")"
                    }
                ],
                [
                    {
                        "pre": "<strong>",
                        "field": "title",
                        "post": "</strong>"
                    }
                ],
                [
                    {
                        "field": "howpublished"
                    },
                    {
                        "pre": "in <em>",
                        "field": "journal.name",
                        "post": "</em>,"
                    },
                    {
                        "pre": "<em>",
                        "field": "booktitle",
                        "post": "</em>,"
                    },
                    {
                        "pre": "vol. ",
                        "field": "volume",
                        "post": ","
                    },
                    {
                        "pre": "p. ",
                        "field": "pages"
                    },
                    {
                        "field": "publisher"
                    }
                ],
                [
                    {
                        "field": "link.url"
                    }
                ]
            ];

        // get today date
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        
        if(dd<10)
        {
            dd='0'+dd
        }
        if(mm<10)
        {
            mm='0'+mm
        } 
        today = dd+'-'+mm+"-"+yyyy;

        // specify the defaults
        var defaults = {
            "config_file": false,
            "embedded_search": true,
            "searchbox_class": "",
            "searchbox_fieldselect": [],
            "searchbox_shade": "#ecf4ff",
            "search_sortby": [],
            "sharesave_link": true,
            "description":"",
            "facets":[],
            "extra_facets": {},
            "enable_rangeselect": true,
            "include_facets_in_querystring": true,
            "result_display": resdisplay,
            "display_images": true,
            "search_url":"",
            "datatype":"jsonp",
            "initialsearch":true,
            "fields": false,
            "partial_fields": false,
            "nested": [],
            "default_url_params":{},
            "freetext_submit_delay":"500",
            "q":"",
            "sort":[],
            "predefined_filters":{},
            "paging":{
                "from":0,
                "size":10
            },
            "pager_on_top": false,
            "pager_slider": false,
            "searchwrap_start": '<form id ="frm1"><div id="content_result_busq"><ul class="List_result" id="facetview_results" style="list-style: none;">',
            "searchwrap_end": "</ul></div></form>",
            "resultwrap_start": "", // XXX was "<tr><td>"
            "resultwrap_end": "", // XXX was "</td></tr>"
            "result_box_colours":[],
            "fadein":100,
            "post_search_callback": false,
            "pushstate": true,
            "linkify": true,
            "default_operator": "OR",
            "default_freetext_fuzzify": false
        };


        // and add in any overrides from the call
        // these options are also overridable by URL parameters
        // facetview options are declared as a function so they are available externally
        // (see bottom of this file)
        var provided_options = $.extend(defaults, options);
        var url_options = $.getUrlVars();
        $.fn.facetview.options = $.extend(provided_options,url_options);
        var options = $.fn.facetview.options;


        // ===============================================
        // functions to do with filters
        // ===============================================
        
        // show the filter values
        var showfiltervals = function(event) {
            event.preventDefault();
            if ( $(this).hasClass('facetview_open') ) {
                $(this).children('i').removeClass('icon-minus');
                $(this).children('i').addClass('icon-plus');
                $(this).removeClass('facetview_open');
                $('#facetview_' + $(this).attr('rel'), obj ).children().find('.facetview_filtervalue').hide();
                $(this).siblings('.facetview_filteroptions').hide();
            } else {
                $(this).children('i').removeClass('icon-plus');
                $(this).children('i').addClass('icon-minus');
                $(this).addClass('facetview_open');
                $('#facetview_' + $(this).attr('rel'), obj ).children().find('.facetview_filtervalue').show();
                $(this).siblings('.facetview_filteroptions').show();
            }
        };

        // function to switch filters to OR instead of AND
        var orfilters = function(event) {
            event.preventDefault();
            if ( $(this).attr('rel') == 'AND' ) {
                $(this).attr('rel','OR');
                $(this).css({'color':'#333'});
                $('.facetview_filterselected[rel="' + $(this).attr('href') + '"]', obj).addClass('facetview_logic_or');
            } else {
                $(this).attr('rel','AND');
                $(this).css({'color':'#aaa'});
                $('.facetview_filterselected[rel="' + $(this).attr('href') + '"]', obj).removeClass('facetview_logic_or');
            }
            dosearch();
        }

        // function to perform for sorting of filters
        var sortfilters = function(event) {
            event.preventDefault();
            var sortwhat = $(this).attr('href');
            var which = 0;
            for ( var i = 0; i < options.facets.length; i++ ) {
                var item = options.facets[i];
                if ('field' in item) {
                    if ( item['field'] == sortwhat) {
                        which = i;
                    }
                }
            }
            // iterate to next sort type on click. order is term, rterm, count, rcount
            if ( $(this).hasClass('facetview_term') ) {
                options.facets[which]['order'] = 'reverse_term';
                $(this).html('a-z <i class="icon-arrow-up"></i>');
                $(this).removeClass('facetview_term').addClass('facetview_rterm');
            } else if ( $(this).hasClass('facetview_rterm') ) {
                options.facets[which]['order'] = 'count';
                $(this).html('count <i class="icon-arrow-down"></i>');
                $(this).removeClass('facetview_rterm').addClass('facetview_count');
            } else if ( $(this).hasClass('facetview_count') ) {
                options.facets[which]['order'] = 'reverse_count';
                $(this).html('count <i class="icon-arrow-up"></i>');
                $(this).removeClass('facetview_count').addClass('facetview_rcount');
            } else if ( $(this).hasClass('facetview_rcount') ) {
                options.facets[which]['order'] = 'term';
                $(this).html('a-z <i class="icon-arrow-down"></i>');
                $(this).removeClass('facetview_rcount').addClass('facetview_term');
            }
            dosearch();
        };
        
        // adjust how many results are shown
        var morefacetvals = function(event) {
            event.preventDefault();
            var morewhat = options.facets[ $(this).attr('rel') ];
            if ('size' in morewhat ) {
                var currentval = morewhat['size'];
            } else {
                var currentval = 10;
            }
            var newmore = prompt('Currently showing ' + currentval + '. How many would you like instead?');
            if (newmore) {
                options.facets[ $(this).attr('rel') ]['size'] = parseInt(newmore);
                $(this).html(newmore);
                dosearch();
            }
        };

        // insert a facet range once selected
        // TODO: UPDATE
        var dofacetrange = function(rel) {
            $('#facetview_rangeresults_' + rel, obj).remove();
            var range = $('#facetview_rangechoices_' + rel, obj).html();
            range = str_replace('$', '', range);
            range = str_replace('.', '', range);
            var newobj = '<div style="display:none;" class="btn-group" id="facetview_rangeresults_' + rel + '"> \
                <a class="facetview_filterselected facetview_facetrange facetview_clear \
                btn btn-info" rel="' + rel + 
                    '" alt="remove" title="eliminar"' +
                ' href="' + $(this).attr("href") + '">' +
                range + ' <i class="icon-white icon-remove"></i></a></div>';
            $('#facetview_selectedfilters', obj).append(newobj);
            $('.facetview_filterselected', obj).unbind('click',clearfilter);
            $('.facetview_filterselected', obj).bind('click',clearfilter);
            options.paging.from = 0;
            dosearch();
        };
        // clear a facet range
        var clearfacetrange = function(event) {
            event.preventDefault();
            var rel = $(this).attr('rel');
            var tipe_search = localStorage.getItem("typeSearch");
            $('#facetview_rangeresults_' + $(this).attr('rel'), obj).remove();
            $('#facetview_rangeplaceholder_' + $(this).attr('rel'), obj).remove();

            if(tipe_search == 'inteligente'){
                if(rel == 3){
                    document.getElementById('rango_price_3').style.display ="block";
                }
                if(rel == 4){
                    document.getElementById('rango_anno_4').style.display ="block";
                }
            }
             else {

                if(rel == 1){
                    document.getElementById('rango_price_3').style.display ="block";
                }
                if(rel == 2){
                    document.getElementById('rango_anno_4').style.display ="block";
                }
            }
            dosearch();
        };

        // build a facet range selector
        var facetrange = function(event) {
            // TODO: when a facet range is requested, should hide the facet list from the menu
            // should perhaps also remove any selections already made on that facet
            event.preventDefault();
            var rel = $(this).attr('rel');
            var tipe_search = localStorage.getItem("typeSearch");

            //Nombre de Rangos y logica de Display Bottones
            if(tipe_search == 'inteligente'){
                if(rel == 3){
                    var  name = "Precio";
                    document.getElementById('rango_price_3').style.display ="none";
                }
                if(rel == 4){
                    var  name = "A&ntilde;o";
                    document.getElementById('rango_anno_4').style.display ="none";
                }
            } else {
           
                    if(rel == 1){
                        var  name = "Precio";
                        document.getElementById('rango_price_3').style.display ="none";
                    }
                    if(rel == 2){
                        var  name = "A&ntilde;o";
                        document.getElementById('rango_anno_4').style.display ="none";
                    }
            }
            var rangeselect = '<div id="facetview_rangeplaceholder_' + rel + '" class="facetview_rangecontainer clearfix"> \
                <div class="clearfix" style="margin-bottom:10px;"> \
                <h3 id="facetview_rangechoices_' + rel + '" class="clearfix"> \
                <strong>' + name + ':</strong> <span class="facetview_lowrangeval_' + rel + '">...</span> \
                a \
                <span class="facetview_highrangeval_' + rel + '">...</span></h3> \
                <div class="btn-group">';
            rangeselect += '<a class="facetview_facetrange_remove btn_close_filter" rel="' + rel + '" alt="remove" title="eliminar" \
                 href="#"></a> \
                </div></div> \
                <div class="clearfix" id="facetview_slider_' + rel + '"></div> \
                </div>';
            $('#facetview_selectedfilters_filter', obj).after(rangeselect);
            $('.facetview_facetrange_remove', obj).unbind('click',clearfacetrange);
            $('.facetview_facetrange_remove', obj).bind('click',clearfacetrange);
            var values = [];
            var valsobj = $( '#facetview_' + $(this).attr('href').replace(/\./gi,'_'), obj );
            valsobj.find('.facetview_filterchoice', obj).each(function() {
                values.push( $(this).attr('href') );
            });


            var tipe_search = localStorage.getItem("typeSearch");
            var priceUp = localStorage.getItem("priceUpGet");
            var priceDown = localStorage.getItem("priceDownGet");

            if((rel == 1)&&(tipe_search === "categoria")){
                var priceAux = parseInt(priceDown);
                values[0]=parseInt(priceDown);
                for(i=1;i<20;i++){
                    priceAux +=  (parseInt(priceUp)-parseInt(priceDown))/20;
                    values[i]=parseInt(priceAux);
                }
                values[20]=parseInt(priceUp);
                $( "#facetview_slider_" + rel, obj ).slider({
                    range: true,
                    min: 0,
                    max: values.length-1,
                    values: [0,values.length-1],
                    slide: function( event, ui ) {
                        $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( accounting.formatMoney(values[ ui.values[0] ]) );
                        $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( accounting.formatMoney(values[ ui.values[1] ]) );
                        dofacetrange( rel );
                    }
                });
                $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( accounting.formatMoney(values[0]) );
                $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( accounting.formatMoney(values[ values.length-1]) );

            }else 
                if((rel == 2)&&(tipe_search === "categoria")){

                    var values=[];
                    var anno = localStorage.getItem("annoGet");
                    var annoMax = 2014;
                    var range = annoMax - parseInt(anno);
                    values[0]=parseInt(anno);
                    for(i=1;i<range;i++){
                        values[i]=parseInt(anno)+i;
                    }
                    $( "#facetview_slider_" + rel, obj ).slider({
                        range: true,
                        min: 0,
                        max: values.length-1,
                        values: [0,values.length-1],
                        slide: function( event, ui ) {
                            $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( values[ ui.values[0] ] );
                            $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( values[ ui.values[1] ] );
                            dofacetrange( rel );
                        }
                    });
                    $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( values[0] );
                    $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( values[ values.length-1] );

                }else
                    if((rel == 3)&&(tipe_search === "inteligente")){

                        values = values.sort(sortNumber);
                        $( "#facetview_slider_" + rel, obj ).slider({
                            range: true,
                            min: 0,
                            max: values.length-1,
                            values: [0,values.length-1],
                            slide: function( event, ui ) {
                                $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( accounting.formatMoney(values[ui.values[0]]));
                                $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( accounting.formatMoney(values[ ui.values[1]]));
                                dofacetrange( rel );
                            }
                        });
                        $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( accounting.formatMoney(values[0]));
                        $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( accounting.formatMoney(values[ values.length-1]));
                   
                    }else{
                        values = values.sort(sortNumber);
                        $( "#facetview_slider_" + rel, obj ).slider({
                            range: true,
                            min: 0,
                            max: values.length-1,
                            values: [0,values.length-1],
                            slide: function( event, ui ) {
                                $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( values[ ui.values[0] ] );
                                $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( values[ ui.values[1] ] );
                                dofacetrange( rel );
                            }
                        });
                        $('#facetview_rangechoices_' + rel + ' .facetview_lowrangeval_' + rel, obj).html( values[0] );
                        $('#facetview_rangechoices_' + rel + ' .facetview_highrangeval_' + rel, obj).html( values[ values.length-1] ); 
                    }
        };

        // pass a list of filters to be displayed
        var buildfilters = function() {
            if ( options.facets.length > 0 ) {
                var filters = options.facets;
                var thefilters = '';
                var tipe_search = localStorage.getItem("typeSearch");
                for ( var idx = 0; idx < filters.length; idx++ ) {
                  if(tipe_search=='inteligente'){
                  
              
                    var fast = '{{FILTER_NAME}}';
                    var test = fast.replace(/{{FILTER_NAME}}/g, filters[idx]['field'].replace(/\./gi, '').replace(/\:/gi, '')).replace(/{{FILTER_EXACT}}/g, filters[idx]['field']);
                    
                    if((test == 'avisoMarca') || (test == 'avisoModelo')){
                         var _filterTmpl = '<table id="facetview_{{FILTER_NAME}}" class="facetview_filters table table-bordered table-condensed " style="display:none;"> \
                        <tr bgcolor="#e9e7e7"><td onclick="ilumina(this)"><a class="facetview_filtershow facetview_open" title="Filtrar por {{FILTER_DISPLAY}}" rel="{{FILTER_NAME}}" \
                        style="color:#333; font-weight:bold;" href=""> <span class="List_filter">{{FILTER_DISPLAY}}</span> <i class="icon-minus"></i> \
                         </a> \
                        <div class="btn-group facetview_filteroptions" style="display:none; margin-top:5px;">';
                         }
                         else

                            if(test == 'avisoComuna'){
                                 var _filterTmpl = '<table id="facetview_{{FILTER_NAME}}" class="facetview_filters table table-bordered table-condensed"> \
                                <tr bgcolor="#e9e7e7"><td onclick="ilumina(this)"><a class="facetview_filtershow " title="Filtrar por {{FILTER_DISPLAY}}" rel="{{FILTER_NAME}}" \
                                style="color:#333; font-weight:bold;" href=""> <span class="List_filter">{{FILTER_DISPLAY}}</span> \
                                 </a> \
                                <div class="btn-group facetview_filteroptions" style="display:none; margin-top:5px;">';
                             }
                                else
                                {
                                    var _filterTmpl = '<table id="facetview_{{FILTER_NAME}}" class="facetview_filters table table-bordered table-condensed " style="display:none;"> \
                                    <tr bgcolor="#e9e7e7"><td onclick="ilumina(this)"><a class="facetview_filtershow" title="Filtrar por {{FILTER_DISPLAY}}" rel="{{FILTER_NAME}}" \
                                    style="color:#333; font-weight:bold;" href=""> <span class="List_filter">{{FILTER_DISPLAY}}</span> <i class="icon-plus"></i> \
                                     </a> \
                                    <div class="btn-group facetview_filteroptions" style="display:none; margin-top:5px;">'; 
                                  
                                }

                    //Botton Rango Facet
                    /*
                    (options.enable_rangeselect)&&((test == 'avisoprecio')||(test == 'avisoAnno'))
                    if (false) {
                        _filterTmpl += '<a class="btn btn-small facetview_facetrange" title="make a range selection on this filter" rel="{{FACET_IDX}}" href="{{FILTER_EXACT}}" style="color:#aaa;">rango</a>';
                    }
                    */
                    _filterTmpl +='</div> \
                        </td></tr> \
                        </table>';
                    _filterTmpl = _filterTmpl.replace(/{{FILTER_NAME}}/g, filters[idx]['field'].replace(/\./gi,'_').replace(/\:/gi,'_')).replace(/{{FILTER_EXACT}}/g, filters[idx]['field']);
                    thefilters += _filterTmpl;
                    if ('size' in filters[idx] ) {
                        thefilters = thefilters.replace(/{{FILTER_HOWMANY}}/gi, filters[idx]['size']);
                    } else {
                        thefilters = thefilters.replace(/{{FILTER_HOWMANY}}/gi, 10);
                    };
                    if ( 'order' in filters[idx] ) {
                        if ( filters[idx]['order'] == 'term' ) {
                            thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_term');
                            thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'a-z <i class="icon-arrow-down"></i>');
                        } else if ( filters[idx]['order'] == 'reverse_term' ) {
                            thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_rterm');
                            thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'a-z <i class="icon-arrow-up"></i>');
                        } else if ( filters[idx]['order'] == 'count' ) {
                            thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_count');
                            thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-down"></i>');
                        } else if ( filters[idx]['order'] == 'reverse_count' ) {
                            thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_rcount');
                            thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-up"></i>');
                        };
                    } else {
                        thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_count');
                        thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-down"></i>');
                    };
                    thefilters = thefilters.replace(/{{FACET_IDX}}/gi,idx);
                    if ('display' in filters[idx]) {
                        thefilters = thefilters.replace(/{{FILTER_DISPLAY}}/g, filters[idx]['display']);
                    } else {
                        thefilters = thefilters.replace(/{{FILTER_DISPLAY}}/g, filters[idx]['field']);
                    };
                    }
             
                    else      {
                                var fast = '{{FILTER_NAME}}';
                                var test = fast.replace(/{{FILTER_NAME}}/g, filters[idx]['field'].replace(/\./gi, '').replace(/\:/gi, '')).replace(/{{FILTER_EXACT}}/g, filters[idx]['field']);
                                
                                //(test == 'avisoCategoria') || (test == 'avisoprecio') || (test == 'avisoAnno')
                                if(false){
                                     var _filterTmpl = '<table id="facetview_{{FILTER_NAME}}" class="facetview_filters table table-bordered table-condensed "> \
                                    <tr bgcolor="#e9e7e7"><td onclick="ilumina(this)"><a class="facetview_filtershow facetview_open" title="Filtrar por {{FILTER_DISPLAY}}" rel="{{FILTER_NAME}}" \
                                    style="color:#333; font-weight:bold;" href=""> <span class="List_filter">{{FILTER_DISPLAY}}</span> <i class="icon-minus"></i> \
                                     </a> \
                                    <div class="btn-group facetview_filteroptions" style="display:block; margin-top:5px;"> \
                                    ';
                                     }
                                         else
                                            {
                                                var _filterTmpl = '<table id="facetview_{{FILTER_NAME}}" class="facetview_filters table table-bordered table-condensed " style="display:none;"> \
                                                <tr bgcolor="#e9e7e7"><td onclick="ilumina(this)"><a class="facetview_filtershow" title="Filtrar por {{FILTER_DISPLAY}}" rel="{{FILTER_NAME}}" \
                                                style="color:#333; font-weight:bold;" href=""> <span class="List_filter">{{FILTER_DISPLAY}}</span> <i class="icon-plus"></i> \
                                                 </a> \
                                                <div class="btn-group facetview_filteroptions" style="display:none; margin-top:5px;">'; 
                                              
                                            }
                                //(options.enable_rangeselect)&&((test == 'avisoprecio')||(test == 'avisoAnno'))
                                if (false) {
                                    _filterTmpl += '<a class="btn btn-info facetview_facetrange" title="make a range selection on this filter" rel="{{FACET_IDX}}" href="{{FILTER_EXACT}}" style="color:#aaa;">rango</a>';
                                }
                                _filterTmpl += '</div> \
                                    </td></tr> \
                                    </table>';
                                _filterTmpl = _filterTmpl.replace(/{{FILTER_NAME}}/g, filters[idx]['field'].replace(/\./gi, '_').replace(/\:/gi, '_')).replace(/{{FILTER_EXACT}}/g, filters[idx]['field']);
                                thefilters += _filterTmpl;
                                if ('size' in filters[idx]) {
                                    thefilters = thefilters.replace(/{{FILTER_HOWMANY}}/gi, filters[idx]['size']);
                                } else {
                                    thefilters = thefilters.replace(/{{FILTER_HOWMANY}}/gi, 10);
                                }
                                ;
                                if ('order' in filters[idx]) {
                                    if (filters[idx]['order'] == 'term') {
                                        thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_term');
                                        thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'a-z <i class="icon-arrow-down"></i>');
                                    } else if (filters[idx]['order'] == 'reverse_term') {
                                        thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_rterm');
                                        thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'a-z <i class="icon-arrow-up"></i>');
                                    } else if (filters[idx]['order'] == 'count') {
                                        thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_count');
                                        thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-down"></i>');
                                    } else if (filters[idx]['order'] == 'reverse_count') {
                                        thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_rcount');
                                        thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-up"></i>');
                                    }
                                    ;
                                } else {
                                    thefilters = thefilters.replace(/{{FILTER_SORTTERM}}/g, 'facetview_count');
                                    thefilters = thefilters.replace(/{{FILTER_SORTCONTENT}}/g, 'count <i class="icon-arrow-down"></i>');
                                }
                                ;
                                thefilters = thefilters.replace(/{{FACET_IDX}}/gi, idx);
                                if ('display' in filters[idx]) {
                                    thefilters = thefilters.replace(/{{FILTER_DISPLAY}}/g, filters[idx]['display']);
                                } else {
                                    thefilters = thefilters.replace(/{{FILTER_DISPLAY}}/g, filters[idx]['field']);
                                }
                                ;

                        }
                };
                $('#facetview_filters', obj).html("").append(thefilters);
                $('.facetview_morefacetvals', obj).bind('click',morefacetvals);
                $('.facetview_facetrange', obj).bind('click',facetrange);
                $('.facetview_sort', obj).bind('click',sortfilters);
                $('.facetview_or', obj).bind('click',orfilters);
                $('.facetview_filtershow', obj).bind('click',showfiltervals);
                $('.facetview_learnmore', obj).unbind('click',learnmore);
                $('.facetview_learnmore', obj).bind('click',learnmore);
                $('.sortDesc', obj).bind('click',sortDesc);
                $('.sortAsd', obj).bind('click',sortAsd);

                options.description ? $('#facetview_filters', obj).append('<div>' + options.description + '</div>') : "";
            };
        };

        // trigger a search when a filter choice is clicked
        // or when a source param is found and passed on page load
        var clickfilterchoice = function(event,rel,href) {
            if ( event ) {
                event.preventDefault();
                var rel = $(this).attr("rel");
                var href = $(this).attr("href");
            }
            var relclean = rel.replace(/\./gi,'_').replace(/\:/gi,'_');

            // Do nothing if element already exists.
            if( $('a.facetview_filterselected[href="'+href+'"][rel="'+rel+'"]').length ){
                return null;
            }

            var newobj = '<a class="facetview_filterselected facetview_clear btn btn-info';
            if ( $('.facetview_or[href="' + rel + '"]', obj).attr('rel') == 'OR' ) {
                newobj += ' facetview_logic_or';
            }
            newobj += '" rel="' + rel + 
                    '" alt="remove" title="eliminar"' +
                    ' href="' + href + '"><span style="line-height:35px; float:left; margin-right:5px;">' +
                    href + ' </span><i class="icon-white icon-remove"></i></a>';

            if ( $('#facetview_group_' + relclean, obj).length ) {
                $('#facetview_group_' + relclean, obj).append(newobj);
            } else {
                var pobj = '<div id="facetview_group_' + relclean + '" class="btn-group">';
                pobj += newobj + '</div>';
                $('#facetview_selectedfilters', obj).append(pobj);
            };



            $('.facetview_filterselected', obj).unbind('click',clearfilter);
            $('.facetview_filterselected', obj).bind('click',clearfilter);
            if ( event ) {
                options.paging.from = 0;
                dosearch();
            };
        };

        // clear a filter when clear button is pressed, and re-do the search
        var clearfilter = function(event) {
            event.preventDefault();
            if ( $(this).siblings().length == 0 ) {
                $(this).parent().remove();
            } else {
                $(this).remove();
            }
            dosearch();
        };
        
        // ===============================================
        // functions to do with building results
        // ===============================================


        var sortAsd = function(event) {
            sortQuery = "asd";   
            localStorage.setItem("sortQuery", sortQuery);
            dosearch();
        };

        var sortDesc = function(event) {
            sortQuery = "desc";  
            localStorage.setItem("sortQuery", sortQuery); 
            dosearch();
        };

        // read the result object and return useful vals
        // returns an object that contains things like ["data"] and ["facets"]
        var parseresults = function(dataobj) {
            var resultobj = new Object();
            resultobj["records"] = new Array();
            resultobj["start"] = "";
            resultobj["found"] = "";
            resultobj["facets"] = new Object();
            for ( var item = 0; item < dataobj.hits.hits.length; item++ ) {
                if ( options.fields ) {
                    resultobj["records"].push(dataobj.hits.hits[item].fields);
                } else if ( options.partial_fields ) {
                    var keys = [];
                    for(var key in options.partial_fields){
                        keys.push(key);
                    }
                    resultobj["records"].push(dataobj.hits.hits[item].fields[keys[0]]);
                } else {
                    dataobj.hits.hits[item]._source["_id"] = dataobj.hits.hits[item]._id; // XXX agregar _id al "aviso"
                    resultobj["records"].push(dataobj.hits.hits[item]._source);
                }
            }
            resultobj["start"] = "";
            resultobj["found"] = dataobj.hits.total;
            for (var item in dataobj.facets) {
                var facetsobj = new Object();
                for (var thing in dataobj.facets[item]["terms"]) {
                    facetsobj[ dataobj.facets[item]["terms"][thing]["term"] ] = dataobj.facets[item]["terms"][thing]["count"];
                }
                resultobj["facets"][item] = facetsobj;
            }
            return resultobj;
        };

        // decrement result set
        var decrement = function(event) {
            event.preventDefault();
            if ( $(this).html() != '..' ) {
                options.paging.from = options.paging.from - options.paging.size;
                options.paging.from < 0 ? options.paging.from = 0 : "";
                dosearch();
            }
        };
        // increment result set
        var increment = function(event) {
            event.preventDefault();
            if ( $(this).html() != '..' ) {
                options.paging.from = parseInt($(this).attr('href'));
                dosearch();
            }
        };

        // given a result record, build how it should look on the page
        var buildrecord = function(index) {
            var record = options.data['records'][index];
            var result = "";
            result += options.resultwrap_start;
            var urlFichaAuto = window.location.protocol + "//" + window.location.host + "/" + "emol_automovil_merge/despliegue.php?id=" + record._id;
            
            result += '<li>'; 

            // add first image where available
            if (options.display_images) {
                var recstr = JSON.stringify(record);
                var regex = /(http:\/\/\S+?\.(jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG))/;
                var img = regex.exec(recstr);
                if (img) 
                {
                    if((img[0] =="http://imgclasificados.emol.com/Publicador/imgNoDisponible.gif") || 
                        (img[0] =="http://imgclasificados.emol.com/13026258_0/860/F222271962247614949249271444220810815860.jpg") ||
                       (img[0].indexOf("imagen_no_disponible.gif") !='-1') ||
                       (img[0].indexOf("Empresas") !='-1'))
                    {
                        
                    }
                    else{
                            result += ' <div class="img_Auto_list"><a href="'+urlFichaAuto+'"><img src="' + img[0] + '"  alt="Auto" /></a></div>';
                          }
                }
            }
            // add the record based on display template if available
            var display = options.result_display;
            var lines = '<div class="Txt_Resul"><a href="'+urlFichaAuto+'" style="text-decoration: none; color: #000;">';
            for ( var lineitem = 0; lineitem < display.length; lineitem++ ) {
                line = "";
                    if(display[lineitem]){
                        for ( var object = 0; object < display[lineitem].length; object++ ) {
                            var thekey = display[lineitem][object]['field'];
                            parts = thekey.split('.');

                            if(parts =='aviso,Marca'){
                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '</span> ';
                                }

                                line_marca = line;

                                if (line) {
                                    lines += '<strong>'+line.replace(/^\s/,'').replace(/\s$/,'').replace(/\,$/,'') + "&nbsp";
                                }
                            }

                            if(parts =='aviso,Modelo'){
                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }

                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '</span> ';
                                }

                                line_modelo = line;

                                var  Modelo = line;  
                                if(Modelo == "Otro</span> "){
                                    var  sino = false; 
                                }else {
                                    var sino = true;
                                }
                                if ( line && sino ){

                                    lines += line.replace(/^\s/,'').replace(/\s$/,'').replace(/\,$/,'') + "</strong>";
                                }else{

                                    lines += '</strong>';
                                }
                            } 

                            if(parts =='aviso,precio'){
                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }

                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '</span> ';
                                }
                                
                                var n =  accounting.formatMoney(line);

                                line_precio = line;

                                if (line) {
                                    lines += "<span class='precio'>"+n.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '')+"</span>";
                                }
                                else{

                                    lines += "";
                                }
                            }

                            if(parts =='aviso,Anno'){
                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '';
                                }
                                if (line) {
                                    lines +="<span class='anno'>A&ntilde;o "+line.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '')+"&nbsp;";
                                }

                                line_anno = line;

                                if(line_anno =='Otro'){
                                    line = '';
                                }
                            }
                                
                            if(parts =='aviso,Kilometraje'){

                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '';
                                }

                                var  Kilometraje =  accounting.formatMoney(line); 
                                var Kilometraje = Kilometraje.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '').replace('$', '');

                                if(Kilometraje == "-1"){
                                    var  sino = false; 
                                }else {
                                    var sino = true;
                                }

                                line_kilometraje = line;

                                if( line && sino ) {
                                    if(line_anno){
                                        lines +=' | &nbsp;'+Kilometraje.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '').replace('$', '')+" Kms</span>";
                                    } else{
                                        lines +=Kilometraje.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '').replace('$', '')+" Kms</span>";
                                    }

                                } else {
                                        lines +="</span>";
                                }
                            }    

                            if(parts =='aviso,Transmision'){

                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '';
                                }

                                var  Transmision = line;  

                                if(Transmision == "Otro"){
                                    var  sino = false; 
                                }else {
                                    var sino = true;
                                }

                                line_transmision = line;

                                if(line_transmision =='Otro'){
                                    line_transmision =''
                                }

                                if ( line && sino ){

                                    lines +="<span class='anno'>T.&nbsp;"+line.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '').replace('Manual', 'Mec&aacute;nica')+"&nbsp;";
                                }
                                else {
                                        lines +="<span class='anno'>";
                                }
                            } 

                            if(parts =='aviso,Combustible'){

                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '';
                                }

                                var valorCombustible = line;
                                if(valorCombustible == 'Otro'){
                                    var  sino = false; 
                                }else {
                                    var sino = true;
                                }

                                line_combustible = line;

                                if ( line && sino ){
                                    if(line_transmision){
                                        lines +=' | &nbsp;'+line.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '')+"</span>";
                                    }
                                    else
                                        {
                                            lines +=line.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '')+"</span>";
                                        }
                                }
                                 else {
                                        lines +="</span>";
                                }

                            } 

                            if(parts =='aviso,logo_operador'){

                                if (parts.length == 1) {
                                    var res = record;
                                } else if (parts.length == 2) {
                                    var res = record[parts[0]];
                                } else if (parts.length == 3) {
                                    var res = record[parts[0]][parts[1]];
                                }
                                var counter = parts.length - 1;
                                if (res && res.constructor.toString().indexOf("Array") == -1) {
                                    var thevalue = res[parts[counter]];  // if this is a dict
                                } else {
                                    var thevalue = [];
                                    if ( res !== undefined ) {
                                        for ( var row = 0; row < res.length; row++ ) {
                                            thevalue.push(res[row][parts[counter]]);
                                        }
                                    }
                                }
                                if (thevalue && thevalue.toString().length) {
                                    display[lineitem][object]['pre']
                                        ? line += display[lineitem][object]['pre'] : false;
                                    if ( typeof(thevalue) == 'object' ) {
                                        for ( var val = 0; val < thevalue.length; val++ ) {
                                            val != 0 ? line += ', ' : false;
                                            line += thevalue[val];
                                        }
                                    } else {
                                        line += thevalue;
                                    }
                                    display[lineitem][object]['post'] 
                                        ? line += display[lineitem][object]['post'] : line += '';
                                }

                                var valorCombustible = line;
                                if(valorCombustible == 'Otro'){
                                    var  sino = false; 
                                }else {
                                    var sino = true;
                                }

                                if ( line && sino ){

                                    lines +="<div class='img_Conse_resul'><img src='upload/concesionarios/"+line.replace(/^\s/, '').replace(/\s$/, '').replace(/\,$/, '')+"'></div>";
                                }
                            }

                        }
                    }
                
            }
            lines ? result += lines : result += JSON.stringify(record,"","    ");
            result += '</a></div><div class="content_Select_send" style="z-index:0;"><input onclick="procesa('+record._id+')" type="checkbox" id="'+record._id+'" name="autoselect" value="'+record._id+'"><label for="'+record._id+'">&nbsp;</label></div></li>';
            result += options.resultwrap_end;
            return result;
        };

        // view a full record when selected
        var viewrecord = function(event) {
            event.preventDefault();
            var record = options.data['records'][$(this).attr('href')];
            alert(JSON.stringify(record,"","    "));
        }

        // put the results on the page
        var showresults = function(sdata) {
            options.rawdata = sdata;
            // get the data and parse from the es layout
            var data = parseresults(sdata);
            options.data = data;
            
            // for each filter setup, find the results for it and append them to the relevant filter
            for ( var each = 0; each < options.facets.length; each++ ) {
                var facet = options.facets[each]['field'];
                var facetclean = options.facets[each]['field'].replace(/\./gi,'_').replace(/\:/gi,'_');
                $('#facetview_' + facetclean, obj).children().find('.facetview_filtervalue').remove();
                var records = data["facets"][ facet ];
                var typeSearch = localStorage.getItem("typeSearch");
                for ( var item in records ) {
                    if(records[item] != undefined){
                        if(typeSearch=='inteligente')
                        {
                                if(facet == "aviso.precio")
                                {
                                    var price = accounting.formatMoney(item);

                                    var append = '<tr class="facetview_filtervalue" style="display:none;"><td><a class="facetview_filterchoice' +
                                    '" rel="' + facet + '" href="' + item + '">' + price +
                                    ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                    $('#facetview_' + facetclean, obj).append(append);
                                } 
                                if(facet == "aviso.Marca")
                                {
                                    var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                    '" rel="' + facet + '" href="' + item + '">' + item +
                                    ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                    $('#facetview_' + facetclean, obj).append(append);
                                } 
                                if(facet == "aviso.Comuna")
                                {
                                    var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                    '" rel="' + facet + '" href="' + item + '">' + item +
                                    ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                    $('#facetview_' + facetclean, obj).append(append);
                                }  
                                if(facet == "aviso.Modelo")
                                {
                                    var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                    '" rel="' + facet + '" href="' + item + '">' + item +
                                    ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                    $('#facetview_' + facetclean, obj).append(append);
                                }  
                                if((facet !== "aviso.precio") && (facet !== "aviso.Marca") && (facet !== "aviso.Modelo") && (facet !== "aviso.Comuna")) {
                                            var append = '<tr class="facetview_filtervalue" style="display:none;"><td><a class="facetview_filterchoice' +
                                            '" rel="' + facet + '" href="' + item + '">' + item +
                                            ' &nbsp;<span>(' + records[item] + ')</span></a></td></tr>';
                                            $('#facetview_' + facetclean, obj).append(append);
                                }
                        } 
                        else {
                            if(facet == "aviso.precio")
                            {
                                var price = accounting.formatMoney(item);
            
                                var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                '" rel="' + facet + '" href="' + item + '">' + price +
                                ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                $('#facetview_' + facetclean, obj).append(append);
                            } 
                            if(facet == "aviso.Categoria")
                            {
                                var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                '" rel="' + facet + '" href="' + item + '">' + item +
                                ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                $('#facetview_' + facetclean, obj).append(append);
                            } 
                            if(facet == "aviso.Anno")
                            {
                                var append = '<tr class="facetview_filtervalue" style="display:block;"><td><a class="facetview_filterchoice' +
                                '" rel="' + facet + '" href="' + item + '">' + item +
                                ' &nbsp;<span>(' + records[item]  + ')</span></a></td></tr>';
                                $('#facetview_' + facetclean, obj).append(append);
                            }  
                            if((facet !== "aviso.precio") && (facet !== "aviso.Categoria") && (facet !== "aviso.Anno")) {
                                        var append = '<tr class="facetview_filtervalue" style="display:none;"><td><a class="facetview_filterchoice' +
                                        '" rel="' + facet + '" href="' + item + '">' + item +
                                        ' &nbsp;<span>(' + records[item] + ')</span></a></td></tr>';
                                        $('#facetview_' + facetclean, obj).append(append);
                            }
                        }
                    }
                }
               
                if ( $('.facetview_filtershow[rel="' + facetclean + '"]', obj).hasClass('facetview_open') ) {
                    $('#facetview_' + facetclean, obj ).children().find('.facetview_filtervalue').show();
                }
            }
            $('.facetview_filterchoice', obj).bind('click',clickfilterchoice);
            $('.facetview_filters', obj).each(function() {
                $(this).find('.facetview_filtershow').css({'color': '#333', 'font-weight': 'normal' }).children('i').show();
                if ( $(this).children().find('.facetview_filtervalue').length > 1 ) {
                    $(this).show();
                } else {
                    //$(this).hide();
                    //$(this).find('.facetview_filtershow').css({'color': '#333', 'font-weight': 'normal' }).children('i').hide();
                }
            });

            // put result metadata on the page
            if ( typeof(options.paging.from) != 'number' ) {
                options.paging.from = parseInt(options.paging.from);
            }
            if ( typeof(options.paging.size) != 'number' ) {
                options.paging.size = parseInt(options.paging.size);
            }
            if ( options.pager_slider ) {
                var metaTmpl = '<div style="font-size:20px;font-weight:bold;margin:5px 0 10px 0;padding:5px 0 5px 0;border:1px solid #eee;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;"> \
                    <a alt="previous" title="previous" class="facetview_decrement" style="color:#333;float:left;padding:0 40px 20px 20px;" href="{{from}}">&lt;</a> \
                    <span style="margin:30%;">{{from}} &ndash; {{to}} of {{total}}</span> \
                    <a alt="next" title="next" class="facetview_increment" style="color:#333;float:right;padding:0 20px 20px 40px;" href="{{to}}">&gt;</a> \
                </div>';
            } else {
                var metaTmpl = '<div class="pagination"> \
                    <ul> \
                        <li class="prev"><a class="facetview_decrement" href="{{from}}">&laquo; Anterior</a></li> \
                        <li class="active"><a>{{from}} &ndash; {{to}} de {{total}}</a></li> \
                        <li class="next"><a class="facetview_increment" href="{{to}}">Siguiente &raquo;</a></li> \
                    </ul> \
                </div> \
                ';
            }
            ;
            $('.facetview_metadata', obj).first().html("No hay resultados para la b&uacute;squeda.");
            if (data.found) {
                var from = options.paging.from + 1;
                var size = options.paging.size;
                !size ? size = 10 : "";
                var to = options.paging.from+size;
                data.found < to ? to = data.found : "";
                var meta = metaTmpl.replace(/{{from}}/g, from);
                meta = meta.replace(/{{to}}/g, to);
                meta = meta.replace(/{{total}}/g, data.found);
                $('.facetview_metadata', obj).html("").append(meta);
                $('.facetview_decrement', obj).bind('click',decrement);
                from < size ? $('.facetview_decrement', obj).html('..') : "";
                $('.facetview_increment', obj).bind('click',increment);
                data.found <= to ? $('.facetview_increment', obj).html('..') : "";
            }

            // put the filtered results on the page
            $('#facetview_results',obj).html("");
            var infofiltervals = new Array();
            $.each(data.records, function(index, value) {
                // write them out to the results div
                 $('#facetview_results', obj).append( buildrecord(index) );
                 options.linkify ? $('#facetview_results tr:last-child', obj).linkify() : false;
            });
            if ( options.result_box_colours.length > 0 ) {
                jQuery('.result_box', obj).each(function () {
                    var colour = options.result_box_colours[Math.floor(Math.random()*options.result_box_colours.length)] ;
                    jQuery(this).css("background-color", colour);
                });
            }
            $('#facetview_results', obj).children().hide().fadeIn(options.fadein);
            $('.facetview_viewrecord', obj).bind('click',viewrecord);
            jQuery('.notify_loading').hide();
            // if a post search callback is provided, run it
            if (typeof options.post_search_callback == 'function') {
                options.post_search_callback.call(this);
            }
        };

        // ===============================================
        // functions to do with searching
        // ===============================================

        // fuzzify the freetext search query terms if required
        var fuzzify = function(querystr) {
            var rqs = querystr
            if ( options.default_freetext_fuzzify !== undefined ) {
                if ( options.default_freetext_fuzzify == "*" || options.default_freetext_fuzzify == "~" ) {
                    if ( querystr.indexOf('*') == -1 && querystr.indexOf('~') == -1 && querystr.indexOf(':') == -1 ) {
                        var optparts = querystr.split(' ');
                        pq = "";
                        for ( var oi = 0; oi < optparts.length; oi++ ) {
                            var oip = optparts[oi];
                            if ( oip.length > 0 ) {
                                oip = oip + options.default_freetext_fuzzify;
                                options.default_freetext_fuzzify == "*" ? oip = "*" + oip : false;
                                pq += oip + " ";
                            }
                        };
                        rqs = pq;
                    };

                };
            };
            return rqs;
        };

        // build the search query URL based on current params
        var elasticsearchquery = function() {
            var qs = {};
            var bool = false;
            var nested = false;
            var seenor = []; // track when an or group are found and processed

            $('.facetview_filterselected',obj).each(function() {
                !bool ? bool = {'must': [] } : "";
                if ( $(this).hasClass('facetview_facetrange') ) {
                    var rngs = {
                        'from': $('.facetview_lowrangeval_' + $(this).attr('rel'), this).html(),
                        'to': $('.facetview_highrangeval_' + $(this).attr('rel'), this).html()
                    };
                    var rel = options.facets[ $(this).attr('rel') ]['field'];
                    var robj = {'range': {}};
                    robj['range'][ rel ] = rngs;
                    // check if this should be a nested query
                    var parts = rel.split('.');
                    if ( options.nested.indexOf(parts[0]) != -1 ) {
                        !nested ? nested = {"nested":{"_scope":parts[0],"path":parts[0],"query":{"bool":{"must":[robj]}}}} : nested.nested.query.bool.must.push(robj);
                    } else {
                        bool['must'].push(robj);
                    }
                } else {
                    // TODO: check if this has class facetview_logic_or
                    // if so, need to build a should around it and its siblings
                    if ( $(this).hasClass('facetview_logic_or') ) {
                        if ( !($(this).attr('rel') in seenor) ) {
                            seenor.push($(this).attr('rel'));
                            var bobj = {'bool':{'should':[]}};
                            $('.facetview_filterselected[rel="' + $(this).attr('rel') + '"]').each(function() {
                                if ( $(this).hasClass('facetview_logic_or') ) {
                                    var ob = {'term':{}};
                                    ob['term'][ $(this).attr('rel') ] = $(this).attr('href');
                                    bobj.bool.should.push(ob);
                                };
                            });
                            if ( bobj.bool.should.length == 1 ) {
                                var spacer = {'match_all':{}};
                                bobj.bool.should.push(spacer);
                            }
                        }
                    } else {
                        var bobj = {'term':{}};
                        bobj['term'][ $(this).attr('rel') ] = $(this).attr('href');
                    }
                    
                    // check if this should be a nested query
                    var parts = $(this).attr('rel').split('.');
                    if ( options.nested.indexOf(parts[0]) != -1 ) {
                        !nested ? nested = {"nested":{"_scope":parts[0],"path":parts[0],"query":{"bool":{"must":[bobj]}}}} : nested.nested.query.bool.must.push(bobj);
                    } else {
                        bool['must'].push(bobj);
                    }
                }
            });
            for (var item in options.predefined_filters) {
                !bool ? bool = {'must': [] } : "";
                var pobj = options.predefined_filters[item];
                var parts = item.split('.');
                if ( options.nested.indexOf(parts[0]) != -1 ) {
                    !nested ? nested = {"nested":{"_scope":parts[0],"path":parts[0],"query":{"bool":{"must":[pobj]}}}} : nested.nested.query.bool.must.push(pobj);
                } else {
                    bool['must'].push(pobj);
                }
            }
            if (bool) {
                if ( options.q != "" ) {
                    var qryval = { 'query': fuzzify(options.q) };
                    $('.facetview_searchfield', obj).val() != "" ? qryval.default_field = $('.facetview_searchfield', obj).val() : "";
                    options.default_operator !== undefined ? qryval.default_operator = options.default_operator : false;
                    bool['must'].push( {'query_string': qryval } );
                };
                nested ? bool['must'].push(nested) : "";
                qs['query'] = {'bool': bool};
            } else {
                if ( options.q != "" ) {
                    var qryval = { 'query': fuzzify(options.q) };
                    $('.facetview_searchfield', obj).val() != "" ? qryval.default_field = $('.facetview_searchfield', obj).val() : "";
                    options.default_operator !== undefined ? qryval.default_operator = options.default_operator : false;
                    qs['query'] = {'query_string': qryval };
                } else {
                    qs['query'] = {'match_all': {}};
                };
            };
            // set any paging
            options.paging.from != 0 ? qs['from'] = options.paging.from : "";
            options.paging.size != 10 ? qs['size'] = options.paging.size : "";
            // set any sort or fields options
            options.sort.length > 0 ? qs['sort'] = options.sort : "";
            options.fields ? qs['fields'] = options.fields : "";
            options.partial_fields ? qs['partial_fields'] = options.partial_fields : "";
            // set any facets
            qs['facets'] = {};
            for ( var item = 0; item < options.facets.length; item++ ) {
                var fobj = jQuery.extend(true, {}, options.facets[item] );
                delete fobj['display'];
                var parts = fobj['field'].split('.');
                qs['facets'][fobj['field']] = {"terms":fobj};
                if ( options.nested.indexOf(parts[0]) != -1 ) {
                    nested ? qs['facets'][fobj['field']]["scope"] = parts[0] : qs['facets'][fobj['field']]["nested"] = parts[0];
                }
            }
            jQuery.extend(true, qs['facets'], options.extra_facets );
            //alert(JSON.stringify(qs,"","    "));
            qy = JSON.stringify(qs);
            if ( options.include_facets_in_querystring ) {
                options.querystring = qy;
            } else {
                delete qs.facets;
                options.querystring = JSON.stringify(qs)
            }
            options.sharesave_link ? $('.facetview_sharesaveurl', obj).val('http://' + window.location.host + window.location.pathname + '?source=' + options.querystring) : "";

            var sortQuery = localStorage.getItem("sortQuery");
            if(sortQuery==="desc"){
                var query = '"sort":[{"aviso.precio":{"order":"desc"}},"_score"],';
                var position = 1;
                qy = qy.substr(0, position) + query + " " + qy.substr(position);
            }else
                if(sortQuery==="asd"){
                    var query = '"sort":[{"aviso.precio":{"order":"asd"}},"_score"],';
                    var position = 1;
                    qy = qy.substr(0, position) + query + " " + qy.substr(position);
                }

            return qy;
        };

        // execute a search
        var dosearch = function() {

            jQuery('.notify_loading').show();
            // update the options with the latest q value
            if ( options.searchbox_class.length == 0 ) {
                options.q = $('.facetview_freetext', obj).val();
            } else {
                options.q = $(options.searchbox_class).last().val();
            };
            // make the search query
            var qrystr = elasticsearchquery();
            // augment the URL bar if possible
            var is_ie = navigator.userAgent.toLowerCase().indexOf('msie ') > -1;

            if (is_ie ){
                var posicion = navigator.userAgent.toLowerCase().lastIndexOf('msie ');
                var ver_ie = navigator.userAgent.toLowerCase().substring(posicion+5, posicion+8);
                //Comprobar version
                ver_chrome = parseFloat(ver_ie);
            
                if((ver_ie=='9.') || (ver_ie=='10.') || (ver_ie=='11.') || (ver_ie=='12.')){
                    if ( options.pushstate ) {
                        var currurl = '?source=' + qrystr;
                        window.history.pushState("","search",currurl);
                    }
                } 
            }
            if (!is_ie ){
                if ( options.pushstate ) {
                    var currurl = '?source=' + qrystr;
                    window.history.pushState("","search",currurl);
                };
            }
            var typeSearch = localStorage.getItem("typeSearch");
            if(typeSearch === "categoria"){
                if (counterClick === null) {
                    $("#rango_anno_4").click();
                    $("#rango_price_3").click();
                    counterClick = 0;
                    counterClick2 = 0;
                    dofacetrange( 1 );
                }    
                if (counterClick2 === 0) {
                    counterClick2 = 1;
                    dofacetrange( 2 );
                }
            }
            $.ajax({
                type: "get",
                url: options.search_url,
                data: {source: qrystr},
                // processData: false,
                dataType: options.datatype,
                success: showresults
            });

        };

        // show search help
        var learnmore = function(event) {
            event.preventDefault();
            $('#facetview_learnmore', obj).toggle();
        };

        // adjust how many results are shown
        var howmany = function(event) {
            event.preventDefault();
            var newhowmany = prompt('Currently displaying ' + options.paging.size + 
                ' results per page. How many would you like instead?');
            if (newhowmany) {
                options.paging.size = parseInt(newhowmany);
                options.paging.from = 0;
                $('.facetview_howmany', obj).html(options.paging.size);
                dosearch();
            }
        };
        
        // change the search result order
        var order = function(event) {
            event.preventDefault();
            if ( $(this).attr('href') == 'desc' ) {
                $(this).html('<i class="icon-arrow-up"></i>');
                $(this).attr('href','asc');
                $(this).attr('title','current order ascending. Click to change to descending');
            } else {
                $(this).html('<i class="icon-arrow-down"></i>');
                $(this).attr('href','desc');
                $(this).attr('title','current order descending. Click to change to ascending');
            };
            orderby();
        };
        var orderby = function(event) {
            event ? event.preventDefault() : "";
            var sortchoice = $('.facetview_orderby', obj).val();
            if ( sortchoice.length != 0 ) {
                var sorting = {};
                var sorton = sortchoice;
                sorting[sorton] = {'order': $('.facetview_order', obj).attr('href')};
                options.sort = [sorting];
            } else {
                options.sort = [];
            }
            options.paging.from = 0;
            dosearch();
        };
        
        // parse any source params out for an initial search
        var parsesource = function() {
            var qrystr = options.source.query;
            if ( 'bool' in qrystr ) {
                var qrys = [];
                // TODO: check for nested
                if ( 'must' in qrystr.bool ) {
                    qrys = qrystr.bool.must;
                } else if ( 'should' in qrystr.bool ) {
                    qrys = qrystr.bool.should;
                };
                for ( var qry = 0; qry < qrys.length; qry++ ) {
                    for ( var key in qrys[qry] ) {
                        if ( key == 'term' ) {
                            for ( var t in qrys[qry][key] ) {
                                if ( !(t in options.predefined_filters) ) {
                                    clickfilterchoice(false,t,qrys[qry][key][t]);
                                };
                            };
                        } else if ( key == 'query_string' ) {
                            typeof(qrys[qry][key]['query']) == 'string' ? options.q = qrys[qry][key]['query'] : "";
                        } else if ( key == 'bool' ) {
                            // TODO: handle sub-bools
                        };
                    };
                };
            } else if ( 'query_string' in qrystr ) {
                typeof(qrystr.query_string.query) == 'string' ? options.q = qrystr.query_string.query : "";
            };
        }
        
        // show the current url with the result set as the source param
        var sharesave = function(event) {
            event.preventDefault();
            $('.facetview_sharesavebox', obj).toggle();
        };
        
        // adjust the search field focus
        var searchfield = function(event) {
            event.preventDefault();
            options.paging.from = 0;
            dosearch();
        };

        // a help box for embed in the facet view object below
        var thehelp = '<div id="facetview_learnmore" class="well" style="margin-top:10px; display:none;">'
        options.sharesave_link ? thehelp += '<p><b>Share</b> or <b>save</b> the current search by clicking the share/save arrow button on the right.</p>' : "";
        thehelp += '<p><b>Remove all</b> search values and settings by clicking the <b>X</b> icon at the left of the search box above.</p> \
            <p><b>Partial matches with wildcard</b> can be performed by using the asterisk <b>*</b> wildcard. For example, <b>einste*</b>, <b>*nstei*</b>.</p> \
            <p><b>Fuzzy matches</b> can be performed using tilde <b>~</b>. For example, <b>einsten~</b> may help find <b>einstein</b>.</p> \
            <p><b>Exact matches</b> can be performed with <b>"</b> double quotes. For example <b>"einstein"</b> or <b>"albert einstein"</b>.</p> \
            <p>Match all search terms by concatenating them with <b>AND</b>. For example <b>albert AND einstein</b>.</p> \
            <p>Match any term by concatenating them with <b>OR</b>. For example <b>albert OR einstein</b>.</p> \
            <p><b>Combinations</b> will work too, like <b>albert OR einste~</b>, or <b>"albert" "einstein"</b>.</p> \
            <p><b>Result set size</b> can be altered by clicking on the result size number preceding the search box above.</p>';
        if ( options.searchbox_fieldselect.length > 0 ) {
            thehelp += '<p>By default, terms are searched for across entire record entries. \
                This can be restricted to particular fields by selecting the field of interest from the <b>search field</b> dropdown</p>';
        };
        if ( options.search_sortby.length > 0 ) {
            thehelp += '<p>Choose a field to <b>sort the search results</b> by clicking the double arrow above.</p>';
        };
        if ( options.facets.length > 0 ) {
            thehelp += '<hr></hr>';
            thehelp += '<p>Use the <b>filters</b> on the left to directly select values of interest. \
                Click the filter name to open the list of available terms and show further filter options.</p> \
                <p><b>Filter list size</b> can be altered by clicking on the filter size number.</p> \
                <p><b>Filter list order </b> can be adjusted by clicking the order options - \
                from a-z ascending or descending, or by count ascending or descending.</p> \
                <p>Filters search for unique values by default; to do an <b>OR</b> search - e.g. to look for more than one value \
                for a particular filter - click the OR button for the relevant filter then choose your values.</p> \
                <p>To further assist discovery of particular filter values, use in combination \
                with the main search bar - search terms entered there will automatically adjust the available filter values.</p>';
            if ( options.enable_rangeselect ) {
                thehelp += '<p><b>Apply a filter range</b> rather than just selecting a single value by clicking on the <b>range</b> button. \
                    This enables restriction of result sets to within a range of values - for example from year 1990 to 2012.</p> \
                    <p>Filter ranges are only available across filter values already in the filter list; \
                    so if a wider filter range is required, first increase the filter size then select the filter range.</p>';
            }
        };
        thehelp += '<p><a class="facetview_learnmore label" href="#">close the help</a></p></div>';
        
        // the facet view object to be appended to the page
        var thefacetview = '<div id="facetview"><div class="row-fluid">';
        if (options.facets.length > 0) {
            thefacetview += '<div class="span3"><div class="btn_Azul" id="filtros"><a>Filtros</a></div><div id="facetview_filters"></div></div>';
            thefacetview += '<div class="span9" id="facetview_rightcol">';
        } else {
            thefacetview += '<div class="span12" id="facetview_rightcol">';
        }
        thefacetview += '<div class="facetview_search_options_container">';
        thefacetview += '<div class="btn-group" style="display:inline-block; float:left;">';
        if ( options.search_sortby.length > 0 ) {
            thefacetview += '<a class="btn btn-small facetview_order" title="current order descending. Click to change to ascending" \
                href="desc"><i class="icon-arrow-down"></i></a>';
            thefacetview += '</div>';
            thefacetview += '<select class="facetview_orderby" style="border-radius:5px; \
                -moz-border-radius:5px; -webkit-border-radius:5px; width:100px; background:#eee; margin:0 5px 21px 0;"> \
                <option value="">order by</option>';
            for ( var each = 0; each < options.search_sortby.length; each++ ) {
                var obj = options.search_sortby[each];
                thefacetview += '<option value="' + obj['field'] + '">' + obj['display'] + '</option>';
            };
            thefacetview += '</select>';
        } else {
            thefacetview += '</div>';
        };
        if ( options.searchbox_fieldselect.length > 0 ) {
            thefacetview += '<select class="facetview_searchfield" style="border-radius:5px 0px 0px 5px; \
                -moz-border-radius:5px 0px 0px 5px; -webkit-border-radius:5px 0px 0px 5px; width:100px; margin:0 -2px 21px 0; background:' + options.searchbox_shade + ';">';
            thefacetview += '<option value="">search all</option>';
            for ( var each = 0; each < options.searchbox_fieldselect.length; each++ ) {
                var obj = options.searchbox_fieldselect[each];
                thefacetview += '<option value="' + obj['field'] + '">' + obj['display'] + '</option>';
            };
            thefacetview += '</select>';
        }
        
        thefacetview += '<input type="text" class="facetview_freetext span4" style="display:inline-block;" name="q" \
            value="" placeholder="Busque su auto" /> \
            <p class="Filtrar_por">\
        <strong>Ordenar por precio:</strong> &nbsp;\
          <a  class="sortAsd">Ascendente</a> &nbsp;|&nbsp;\
          <a class="sortDesc">Descendente</a>\
        </p>';
        thefacetview +=  '<div id="Content_option_view"><span>Ver como:</span><div id ="styleTwo" style="opacity:0.3;filter:alpha(opacity=30)" class="Listado" onclick="setActiveStyleSheet(\'normal2\'); mostrarTwo(); return false;"></div><div id ="styleOne" style="opacity:1.0;filter:alpha(opacity=100)" class="Cuadricula" onclick="setActiveStyleSheet(\'normal1\'); mostrarOne(); return false;"></div></div>';
        thefacetview += '</div>';
        thefacetview += '<div class="content_btn_enviar">\
          <span style="float:left; width:77px; font-size:11px; color:#000; text-align:left; padding-top:6px;">Avisos seleccionados</span>\
          <div class="btn_Save_select"><a onclick="setVisibility();" title="enviar selecci&oacute;n de autos">enviar</a></div>\
        </div>\
        ';


        //Botones Rango
        var tipe_search = localStorage.getItem("typeSearch");
        if(tipe_search=='inteligente'){
          thefacetview += '<a id="rango_price_3" class="btn btn-info facetview_facetrange" title="make a range selection on this filter" rel="3" href="aviso.precio" style="float: right;padding: 12px 9px;margin-right: 10px;display:block;">rango de precio</a>\
                          <a id="rango_anno_4" class="btn btn-info facetview_facetrange" title="make a range selection on this filter" rel="4" href="aviso.Anno" style="float: right;padding: 12px 9px;margin-right: 10px;display:block;">rango de a&ntilde;o</a>';
        } else {
                  thefacetview += '<a id="rango_price_3" class="btn btn-info facetview_facetrange" title="make a range selection on this filter" rel="1" href="aviso.precio" style="float: right;padding: 12px 9px;margin-right: 10px;display:block;">rango de precio</a>\
                                   <a id="rango_anno_4" class="btn btn-info facetview_facetrange" title="make a range selection on this filter" rel="2" href="aviso.Anno" style="float: right;padding: 12px 9px;margin-right: 10px;display:block;">rango de a&ntilde;o</a>';
        }

        thefacetview += thehelp;
        thefacetview += '<div class="btn-toolbar" id="facetview_selectedfilters"></div><div id="facetview_selectedfilters_filter"></div>';
        options.pager_on_top ? thefacetview += '<div class="facetview_metadata" style="margin-top:20px;"></div>' : "";
        thefacetview += options.searchwrap_start + options.searchwrap_end;
        thefacetview += '<div class="facetview_metadata" style="float:left; text-align:center; width:100%;"></div></div></div></div>';

        var obj = undefined;

        // ===============================================
        // now create the plugin on the page
        return this.each(function() {
            // get this object
            obj = $(this);
            
            // what to do when ready to go
            var whenready = function() {
                        $('#rango_price_3').trigger('click');
                // append the facetview object to this object
                thefacetview = thefacetview.replace(/{{HOW_MANY}}/gi,options.paging.size);
                obj.append(thefacetview);
                !options.embedded_search ? $('.facetview_search_options_container', obj).hide() : "";


                // bind learn more and how many triggers
                $('.facetview_learnmore', obj).bind('click',learnmore);
                $('.facetview_howmany', obj).bind('click',howmany);
                $('.facetview_searchfield', obj).bind('change',searchfield);
                $('.facetview_orderby', obj).bind('change',orderby);
                $('.facetview_order', obj).bind('click',order);
                $('.facetview_sharesave', obj).bind('click',sharesave);

                // check paging info is available
                !options.paging.size && options.paging.size != 0 ? options.paging.size = 10 : "";
                !options.paging.from ? options.paging.from = 0 : "";

                // handle any source options
                if ( options.source ) {
                    parsesource();
                    delete options.source;
                }

                // set any default search values into the search bar and create any required filters
                if ( options.searchbox_class.length == 0 ) {
                    options.q != "" ? $('.facetview_freetext', obj).val(options.q) : "";
                    buildfilters();
                    $('.facetview_freetext', obj).bindWithDelay('keyup',dosearch,options.freetext_submit_delay);
                } else {
                    options.q != "" ? $(options.searchbox_class).last().val(options.q) : "";
                    buildfilters();
                    $(options.searchbox_class).bindWithDelay('keyup',dosearch,options.freetext_submit_delay);
                }

                options.source || options.initialsearch ? dosearch() : "";

            };
            
            // check for remote config options, then do first search
            if (options.config_file) {
                $.ajax({
                    type: "get",
                    url: options.config_file,
                    dataType: "jsonp",
                    success: function(data) {
                        options = $.extend(options, data);
                        whenready();
                    },
                    error: function() {
                        $.ajax({
                            type: "get",
                            url: options.config_file,
                            success: function(data) {
                                options = $.extend(options, $.parseJSON(data));
                                whenready();
                            },
                            error: function() {
                                whenready();
                            }
                        });
                    }
                });
            } else {
                whenready();
            }

        }); // end of the function  


    };


    // facetview options are declared as a function so that they can be retrieved
    // externally (which allows for saving them remotely etc)
    $.fn.facetview.options = {};
    
})(jQuery);






