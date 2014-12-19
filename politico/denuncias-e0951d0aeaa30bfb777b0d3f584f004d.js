;(function ($, window, document, undefined) {

    var pluginName = "cycleCarousel",
        defaults = {
        animation: 'flipInX',
        time: 5, // in seconds
        count: 0,
        display: 'block'
    };

    function Plugin (element, options) {
        this.element = element;
        this.settings = $.extend( {}, defaults, options );
        this.element = element;
        this.$element = $(element);
        this.$child = this.$element.find('.cycle');
        this.lenght_child = this.count = this.$child.length;
        this.animation = this.settings.animation;
        this.display = this.settings.display;
        this.time = this.settings.time
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function () {
            this.doTheInterval(defaults.count);
        },
        increment: function (scope){
            if (defaults.count < scope.$child.length && scope.lenght_child > 1){
                scope.$element.find('.cycle').eq(defaults.count+1).addClass(''+scope.animation+' animated').css('display', scope.display).siblings().removeClass('animated'+scope.animation+' active').css('display','none');
                scope.count--;
                defaults.count++;
            }
            if(scope.count == 0){
               scope.count = scope.$child.length;
               defaults.count = -1;
            }
            return defaults.count;
        },
        doTheInterval: function () {
            var scope = this;
            var teste = setInterval(this.increment, scope.time*1000, scope);
        },
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function() {
            if ( !$.data( this, "plugin_" + pluginName)) {
                $.data( this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);
(function(e){"use strict";if(typeof define==="function"&&define.amd){define(["jquery"],e)}else{e(jQuery)}})(function(e){"use strict";function r(t,n){var i=function(){},s=this,o={autoSelectFirst:false,appendTo:"body",serviceUrl:null,lookup:null,onSelect:null,width:"auto",minChars:1,maxHeight:300,deferRequestBy:0,params:{},formatResult:r.formatResult,delimiter:null,zIndex:9999,type:"GET",noCache:false,onSearchStart:i,onSearchComplete:i,onSearchError:i,containerClass:"autocomplete-suggestions",tabDisabled:false,dataType:"text",currentRequest:null,triggerSelectOnValidInput:true,preventBadQueries:true,lookupFilter:function(e,t,n){return e.value.toLowerCase().indexOf(n)!==-1},paramName:"query",transformResult:function(t){return typeof t==="string"?e.parseJSON(t):t}};s.element=t;s.el=e(t);s.suggestions=[];s.badQueries=[];s.selectedIndex=-1;s.currentValue=s.element.value;s.intervalId=0;s.cachedResponse={};s.onChangeInterval=null;s.onChange=null;s.isLocal=false;s.suggestionsContainer=null;s.options=e.extend({},o,n);s.classes={selected:"autocomplete-selected",suggestion:"autocomplete-suggestion"};s.hint=null;s.hintValue="";s.selection=null;s.initialize();s.setOptions(n)}var t=function(){return{escapeRegExChars:function(e){return e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},createNode:function(e){var t=document.createElement("div");t.className=e;t.style.position="absolute";t.style.display="none";return t}}}(),n={ESC:27,TAB:9,RETURN:13,LEFT:37,UP:38,RIGHT:39,DOWN:40};r.utils=t;e.Autocomplete=r;r.formatResult=function(e,n){var r="("+t.escapeRegExChars(n)+")";return e.value.replace(new RegExp(r,"gi"),"<strong>$1</strong>")};r.prototype={killerFn:null,initialize:function(){var t=this,n="."+t.classes.suggestion,i=t.classes.selected,s=t.options,o;t.element.setAttribute("autocomplete","off");t.killerFn=function(n){if(e(n.target).closest("."+t.options.containerClass).length===0){t.killSuggestions();t.disableKillerFn()}};t.suggestionsContainer=r.utils.createNode(s.containerClass);o=e(t.suggestionsContainer);o.appendTo(s.appendTo);if(s.width!=="auto"){o.width(s.width)}o.on("mouseover.autocomplete",n,function(){t.activate(e(this).data("index"))});o.on("mouseout.autocomplete",function(){t.selectedIndex=-1;o.children("."+i).removeClass(i)});o.on("click.autocomplete",n,function(){t.select(e(this).data("index"))});t.fixPosition();t.fixPositionCapture=function(){if(t.visible){t.fixPosition()}};e(window).on("resize.autocomplete",t.fixPositionCapture);t.el.on("keydown.autocomplete",function(e){t.onKeyPress(e)});t.el.on("keyup.autocomplete",function(e){t.onKeyUp(e)});t.el.on("blur.autocomplete",function(){t.onBlur()});t.el.on("focus.autocomplete",function(){t.onFocus()});t.el.on("change.autocomplete",function(e){t.onKeyUp(e)})},onFocus:function(){var e=this;e.fixPosition();if(e.options.minChars<=e.el.val().length){e.onValueChange()}},onBlur:function(){this.enableKillerFn()},setOptions:function(t){var n=this,r=n.options;e.extend(r,t);n.isLocal=e.isArray(r.lookup);if(n.isLocal){r.lookup=n.verifySuggestionsFormat(r.lookup)}e(n.suggestionsContainer).css({"max-height":r.maxHeight+"px",width:r.width+"px","z-index":r.zIndex})},clearCache:function(){this.cachedResponse={};this.badQueries=[]},clear:function(){this.clearCache();this.currentValue="";this.suggestions=[]},disable:function(){var e=this;e.disabled=true;if(e.currentRequest){e.currentRequest.abort()}},enable:function(){this.disabled=false},fixPosition:function(){var t=this,n,r;if(t.options.appendTo!=="body"){return}n=t.el.offset();r={top:n.top+t.el.outerHeight()+"px",left:n.left+"px"};if(t.options.width==="auto"){r.width=t.el.outerWidth()-2+"px"}e(t.suggestionsContainer).css(r)},enableKillerFn:function(){var t=this;e(document).on("click.autocomplete",t.killerFn)},disableKillerFn:function(){var t=this;e(document).off("click.autocomplete",t.killerFn)},killSuggestions:function(){var e=this;e.stopKillSuggestions();e.intervalId=window.setInterval(function(){e.hide();e.stopKillSuggestions()},50)},stopKillSuggestions:function(){window.clearInterval(this.intervalId)},isCursorAtEnd:function(){var e=this,t=e.el.val().length,n=e.element.selectionStart,r;if(typeof n==="number"){return n===t}if(document.selection){r=document.selection.createRange();r.moveStart("character",-t);return t===r.text.length}return true},onKeyPress:function(e){var t=this;if(!t.disabled&&!t.visible&&e.which===n.DOWN&&t.currentValue){t.suggest();return}if(t.disabled||!t.visible){return}switch(e.which){case n.ESC:t.el.val(t.currentValue);t.hide();break;case n.RIGHT:if(t.hint&&t.options.onHint&&t.isCursorAtEnd()){t.selectHint();break}return;case n.TAB:if(t.hint&&t.options.onHint){t.selectHint();return};case n.RETURN:if(t.selectedIndex===-1){t.hide();return}t.select(t.selectedIndex);if(e.which===n.TAB&&t.options.tabDisabled===false){return}break;case n.UP:t.moveUp();break;case n.DOWN:t.moveDown();break;default:return}e.stopImmediatePropagation();e.preventDefault()},onKeyUp:function(e){var t=this;if(t.disabled){return}switch(e.which){case n.UP:case n.DOWN:return}clearInterval(t.onChangeInterval);if(t.currentValue!==t.el.val()){t.findBestHint();if(t.options.deferRequestBy>0){t.onChangeInterval=setInterval(function(){t.onValueChange()},t.options.deferRequestBy)}else{t.onValueChange()}}},onValueChange:function(){var t=this,n=t.options,r=t.el.val(),i=t.getQuery(r),s;if(t.selection){t.selection=null;(n.onInvalidateSelection||e.noop).call(t.element)}clearInterval(t.onChangeInterval);t.currentValue=r;t.selectedIndex=-1;if(n.triggerSelectOnValidInput){s=t.findSuggestionIndex(i);if(s!==-1){t.select(s);return}}if(i.length<n.minChars){t.hide()}else{t.getSuggestions(i)}},findSuggestionIndex:function(t){var n=this,r=-1,i=t.toLowerCase();e.each(n.suggestions,function(e,t){if(t.value.toLowerCase()===i){r=e;return false}});return r},getQuery:function(t){var n=this.options.delimiter,r;if(!n){return t}r=t.split(n);return e.trim(r[r.length-1])},getSuggestionsLocal:function(t){var n=this,r=n.options,i=t.toLowerCase(),s=r.lookupFilter,o=parseInt(r.lookupLimit,10),u;u={suggestions:e.grep(r.lookup,function(e){return s(e,t,i)})};if(o&&u.suggestions.length>o){u.suggestions=u.suggestions.slice(0,o)}return u},getSuggestions:function(t){var n,r=this,i=r.options,s=i.serviceUrl,o,u;i.params[i.paramName]=t;o=i.ignoreParams?null:i.params;if(r.isLocal){n=r.getSuggestionsLocal(t)}else{if(e.isFunction(s)){s=s.call(r.element,t)}u=s+"?"+e.param(o||{});n=r.cachedResponse[u]}if(n&&e.isArray(n.suggestions)){r.suggestions=n.suggestions;r.suggest()}else if(!r.isBadQuery(t)){if(i.onSearchStart.call(r.element,i.params)===false){return}if(r.currentRequest){r.currentRequest.abort()}r.currentRequest=e.ajax({url:s,data:o,type:i.type,dataType:i.dataType}).done(function(e){var n;r.currentRequest=null;n=i.transformResult(e);r.processResponse(n,t,u);i.onSearchComplete.call(r.element,t,n.suggestions)}).fail(function(e,n,s){i.onSearchError.call(r.element,t,e,n,s)})}},isBadQuery:function(e){if(!this.options.preventBadQueries){return false}var t=this.badQueries,n=t.length;while(n--){if(e.indexOf(t[n])===0){return true}}return false},hide:function(){var t=this;t.visible=false;t.selectedIndex=-1;e(t.suggestionsContainer).hide();t.signalHint(null)},suggest:function(){if(this.suggestions.length===0){this.hide();return}var t=this,n=t.options,r=n.formatResult,i=t.getQuery(t.currentValue),s=t.classes.suggestion,o=t.classes.selected,u=e(t.suggestionsContainer),a=n.beforeRender,f="",l,c;if(n.triggerSelectOnValidInput){l=t.findSuggestionIndex(i);if(l!==-1){t.select(l);return}}e.each(t.suggestions,function(e,t){f+='<div class="'+s+'" data-index="'+e+'">'+r(t,i)+"</div>"});if(n.width==="auto"){c=t.el.outerWidth()-2;u.width(c>0?c:300)}u.html(f);if(n.autoSelectFirst){t.selectedIndex=0;u.children().first().addClass(o)}if(e.isFunction(a)){a.call(t.element,u)}u.show();t.visible=true;t.findBestHint()},findBestHint:function(){var t=this,n=t.el.val().toLowerCase(),r=null;if(!n){return}e.each(t.suggestions,function(e,t){var i=t.value.toLowerCase().indexOf(n)===0;if(i){r=t}return!i});t.signalHint(r)},signalHint:function(t){var n="",r=this;if(t){n=r.currentValue+t.value.substr(r.currentValue.length)}if(r.hintValue!==n){r.hintValue=n;r.hint=t;(this.options.onHint||e.noop)(n)}},verifySuggestionsFormat:function(t){if(t.length&&typeof t[0]==="string"){return e.map(t,function(e){return{value:e,data:null}})}return t},processResponse:function(e,t,n){var r=this,i=r.options;e.suggestions=r.verifySuggestionsFormat(e.suggestions);if(!i.noCache){r.cachedResponse[n]=e;if(i.preventBadQueries&&e.suggestions.length===0){r.badQueries.push(t)}}if(t!==r.getQuery(r.currentValue)){return}r.suggestions=e.suggestions;r.suggest()},activate:function(t){var n=this,r,i=n.classes.selected,s=e(n.suggestionsContainer),o=s.children();s.children("."+i).removeClass(i);n.selectedIndex=t;if(n.selectedIndex!==-1&&o.length>n.selectedIndex){r=o.get(n.selectedIndex);e(r).addClass(i);return r}return null},selectHint:function(){var t=this,n=e.inArray(t.hint,t.suggestions);t.select(n)},select:function(e){var t=this;t.hide();t.onSelect(e)},moveUp:function(){var t=this;if(t.selectedIndex===-1){return}if(t.selectedIndex===0){e(t.suggestionsContainer).children().first().removeClass(t.classes.selected);t.selectedIndex=-1;t.el.val(t.currentValue);t.findBestHint();return}t.adjustScroll(t.selectedIndex-1)},moveDown:function(){var e=this;if(e.selectedIndex===e.suggestions.length-1){return}e.adjustScroll(e.selectedIndex+1)},adjustScroll:function(t){var n=this,r=n.activate(t),i,s,o,u=25;if(!r){return}i=r.offsetTop;s=e(n.suggestionsContainer).scrollTop();o=s+n.options.maxHeight-u;if(i<s){e(n.suggestionsContainer).scrollTop(i)}else if(i>o){e(n.suggestionsContainer).scrollTop(i-n.options.maxHeight+u)}n.el.val(n.getValue(n.suggestions[t].value));n.signalHint(null)},onSelect:function(t){var n=this,r=n.options.onSelect,i=n.suggestions[t];n.currentValue=n.getValue(i.value);n.el.val(n.currentValue);n.signalHint(null);n.suggestions=[];n.selection=i;if(e.isFunction(r)){r.call(n.element,i)}},getValue:function(e){var t=this,n=t.options.delimiter,r,i;if(!n){return e}r=t.currentValue;i=r.split(n);if(i.length===1){return e}return r.substr(0,r.length-i[i.length-1].length)+e},dispose:function(){var t=this;t.el.off(".autocomplete").removeData("autocomplete");t.disableKillerFn();e(window).off("resize.autocomplete",t.fixPositionCapture);e(t.suggestionsContainer).remove()}};e.fn.autocomplete=function(t,n){var i="autocomplete";if(arguments.length===0){return this.first().data(i)}return this.each(function(){var s=e(this),o=s.data(i);if(typeof t==="string"){if(o&&typeof o[t]==="function"){o[t](n)}}else{if(o&&o.dispose){o.dispose()}o=new r(this,t);s.data(i,o)}})}})
;
/*!
 * Pikaday
 *
 * Copyright © 2013 David Bushell | BSD & MIT license | https://github.com/dbushell/Pikaday
 */


(function (root, factory)
{
    'use strict';

    var moment;
    if (typeof exports === 'object') {
        // CommonJS module
        // Load moment.js as an optional dependency
        try { moment = require('moment'); } catch (e) {}
        module.exports = factory(moment);
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(function (req)
        {
            // Load moment.js as an optional dependency
            var id = 'moment';
            moment = req.defined && req.defined(id) ? req(id) : undefined;
            return factory(moment);
        });
    } else {
        root.Pikaday = factory(root.moment);
    }
}(this, function (moment)
{
    'use strict';

    /**
     * feature detection and helper functions
     */
    var hasMoment = typeof moment === 'function',

    hasEventListeners = !!window.addEventListener,

    document = window.document,

    sto = window.setTimeout,

    addEvent = function(el, e, callback, capture)
    {
        if (hasEventListeners) {
            el.addEventListener(e, callback, !!capture);
        } else {
            el.attachEvent('on' + e, callback);
        }
    },

    removeEvent = function(el, e, callback, capture)
    {
        if (hasEventListeners) {
            el.removeEventListener(e, callback, !!capture);
        } else {
            el.detachEvent('on' + e, callback);
        }
    },

    fireEvent = function(el, eventName, data)
    {
        var ev;

        if (document.createEvent) {
            ev = document.createEvent('HTMLEvents');
            ev.initEvent(eventName, true, false);
            ev = extend(ev, data);
            el.dispatchEvent(ev);
        } else if (document.createEventObject) {
            ev = document.createEventObject();
            ev = extend(ev, data);
            el.fireEvent('on' + eventName, ev);
        }
    },

    trim = function(str)
    {
        return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g,'');
    },

    hasClass = function(el, cn)
    {
        return (' ' + el.className + ' ').indexOf(' ' + cn + ' ') !== -1;
    },

    addClass = function(el, cn)
    {
        if (!hasClass(el, cn)) {
            el.className = (el.className === '') ? cn : el.className + ' ' + cn;
        }
    },

    removeClass = function(el, cn)
    {
        el.className = trim((' ' + el.className + ' ').replace(' ' + cn + ' ', ' '));
    },

    isArray = function(obj)
    {
        return (/Array/).test(Object.prototype.toString.call(obj));
    },

    isDate = function(obj)
    {
        return (/Date/).test(Object.prototype.toString.call(obj)) && !isNaN(obj.getTime());
    },

    isLeapYear = function(year)
    {
        // solution by Matti Virkkunen: http://stackoverflow.com/a/4881951
        return year % 4 === 0 && year % 100 !== 0 || year % 400 === 0;
    },

    getDaysInMonth = function(year, month)
    {
        return [31, isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
    },

    setToStartOfDay = function(date)
    {
        if (isDate(date)) date.setHours(0,0,0,0);
    },

    compareDates = function(a,b)
    {
        // weak date comparison (use setToStartOfDay(date) to ensure correct result)
        return a.getTime() === b.getTime();
    },

    extend = function(to, from, overwrite)
    {
        var prop, hasProp;
        for (prop in from) {
            hasProp = to[prop] !== undefined;
            if (hasProp && typeof from[prop] === 'object' && from[prop].nodeName === undefined) {
                if (isDate(from[prop])) {
                    if (overwrite) {
                        to[prop] = new Date(from[prop].getTime());
                    }
                }
                else if (isArray(from[prop])) {
                    if (overwrite) {
                        to[prop] = from[prop].slice(0);
                    }
                } else {
                    to[prop] = extend({}, from[prop], overwrite);
                }
            } else if (overwrite || !hasProp) {
                to[prop] = from[prop];
            }
        }
        return to;
    },


    /**
     * defaults and localisation
     */
    defaults = {

        // bind the picker to a form field
        field: null,

        // automatically show/hide the picker on `field` focus (default `true` if `field` is set)
        bound: undefined,

        // the default output format for `.toString()` and `field` value
        format: 'DD/MM/YYYY',

        // the initial date to view when first opened
        defaultDate: null,

        // make the `defaultDate` the initial selected value
        setDefaultDate: false,

        // first day of week (0: Domingo, 1: Segunda etc)
        firstDay: 0,

        // the minimum/earliest date that can be selected
        minDate: null,
        // the maximum/latest date that can be selected
        maxDate: new Date(),

        // number of years either side, or array of upper/lower range
        yearRange: 10,

        // used internally (don't config outside)
        minYear: 2012,
        maxYear: new Date().getFullYear(),
        minMonth: undefined,
        maxMonth: undefined,

        isRTL: false,

        // Additional text to append to the year in the calendar title
        yearSuffix: '',

        // Render the month after year in the calendar title
        showMonthAfterYear: false,

        // how many months are visible (not implemented yet)
        numberOfMonths: 1,

        // internationalization
        i18n: {
            previousMonth : '',
            nextMonth     : '',
            months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julhor','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            weekdays      : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            weekdaysShort : ['Dom','Seg','Ter','Qua','Qui','Sex','Sab']
        },

        // callback function
        onSelect: null,
        onOpen: null,
        onClose: null,
        onDraw: null
    },


    /**
     * templating functions to abstract HTML rendering
     */
    renderDayName = function(opts, day, abbr)
    {
        day += opts.firstDay;
        while (day >= 7) {
            day -= 7;
        }
        return abbr ? opts.i18n.weekdaysShort[day] : opts.i18n.weekdays[day];
    },

    renderDay = function(i, isSelected, isToday, isDisabled, isEmpty)
    {
        if (isEmpty) {
            return '<td class="is-empty"></td>';
        }
        var arr = [];
        if (isDisabled) {
            arr.push('is-disabled');
        }
        if (isToday) {
            arr.push('is-today');
        }
        if (isSelected) {
            arr.push('is-selected');
        }
        return '<td data-day="' + i + '" class="pika-td' + arr.join(' ') + '"><a class="pika-button">' + i + '</a>' + '</td>';
    },

    renderRow = function(days, isRTL)
    {
        return '<tr>' + (isRTL ? days.reverse() : days).join('') + '</tr>';
    },

    renderBody = function(rows)
    {
        return '<tbody>' + rows.join('') + '</tbody>';
    },

    renderHead = function(opts)
    {
        var i, arr = [];
        for (i = 0; i < 7; i++) {
            arr.push('<th scope="col"><abbr title="' + renderDayName(opts, i) + '">' + renderDayName(opts, i, true) + '</abbr></th>');
        }
        return '<thead>' + (opts.isRTL ? arr.reverse() : arr).join('') + '</thead>';
    },

    renderTitle = function(instance)
    {
        var i, j, arr,
            opts = instance._o,
            month = instance._m,
            year  = instance._y,
            isMinYear = year === opts.minYear,
            isMaxYear = year === opts.maxYear,
            html = '<div class="pika-title">',
            monthHtml,
            yearHtml,
            prev = true,
            next = true;

        for (arr = [], i = 0; i < 12; i++) {
            arr.push('<option value="' + i + '"' +
                (i === month ? ' selected': '') +
                ((isMinYear && i < opts.minMonth) || (isMaxYear && i > opts.maxMonth) ? 'disabled' : '') + '>' +
                opts.i18n.months[i] + '</option>');
        }
        monthHtml = '<div class="pika-label">' + opts.i18n.months[month] + '<select class="pika-select pika-select-month">' + arr.join('') + '</select></div>';

        if (isArray(opts.yearRange)) {
            i = opts.yearRange[0];
            j = opts.yearRange[1] + 1;
        } else {
            i = year - opts.yearRange;
            j = 1 + year + opts.yearRange;
        }

        for (arr = []; i < j && i <= opts.maxYear; i++) {
            if (i >= opts.minYear) {
                arr.push('<option value="' + i + '"' + (i === year ? ' selected': '') + '>' + (i) + '</option>');
            }
        }
        yearHtml = '<div class="pika-label">' + year + opts.yearSuffix + '<select class="pika-select pika-select-year">' + arr.join('') + '</select></div>';

        if (opts.showMonthAfterYear) {
            html += yearHtml + monthHtml;
        } else {
            html += monthHtml + yearHtml;
        }

        if (isMinYear && (month === 0 || opts.minMonth >= month)) {
            prev = false;
        }

        if (isMaxYear && (month === 11 || opts.maxMonth <= month)) {
            next = false;
        }

        html += '<a class="pika-prev' + (prev ? '' : ' is-disabled') + '">' + opts.i18n.previousMonth + '</a>';
        html += '<a class="pika-next' + (next ? '' : ' is-disabled') + '">' + opts.i18n.nextMonth + '</a>';

        return html += '</div>';
    },

    renderTable = function(opts, data)
    {
        return '<table cellpadding="0" cellspacing="0" class="pika-table">' + renderHead(opts) + renderBody(data) + '</table>';
    },


    /**
     * Pikaday constructor
     */
    Pikaday = function(options)
    {
        var self = this,
            opts = self.config(options);

        self._onMouseDown = function(e)
        {
            if (!self._v) {
                return;
            }
            e = e || window.event;
            var target = e.target || e.srcElement;
            if (!target) {
                return;
            }

            if (!hasClass(target, 'is-disabled')) {
                if (hasClass(target, 'pika-button') && !hasClass(target, 'is-empty')) {
                    self.setDate(new Date(self._y, self._m, parseInt(target.innerHTML, 10)));
                    if (opts.bound) {
                        sto(function() {
                            self.hide();
                        }, 100);
                    }
                    return;
                }
                else if (hasClass(target, 'pika-prev')) {
                    self.prevMonth();
                }
                else if (hasClass(target, 'pika-next')) {
                    self.nextMonth();
                }
            }
            if (!hasClass(target, 'pika-select')) {
                if (e.preventDefault) {
                    e.preventDefault();
                } else {
                    e.returnValue = false;
                    return false;
                }
            } else {
                self._c = true;
            }
        };

        self._onChange = function(e)
        {
            e = e || window.event;
            var target = e.target || e.srcElement;
            if (!target) {
                return;
            }
            if (hasClass(target, 'pika-select-month')) {
                self.gotoMonth(target.value);
            }
            else if (hasClass(target, 'pika-select-year')) {
                self.gotoYear(target.value);
            }
        };

        self._onInputChange = function(e)
        {
            var date;

            if (e.firedBy === self) {
                return;
            }
            if (hasMoment) {
                date = moment(opts.field.value, opts.format);
                date = (date && date.isValid()) ? date.toDate() : null;
            }
            else {
                date = new Date(Date.parse(opts.field.value));
            }
            self.setDate(isDate(date) ? date : null);
            if (!self._v) {
                self.show();
            }
        };

        self._onInputFocus = function()
        {
            self.show();
        };

        self._onInputClick = function()
        {
            self.show();
        };

        self._onInputBlur = function()
        {
            if (!self._c) {
                self._b = sto(function() {
                    self.hide();
                }, 50);
            }
            self._c = false;
        };

        self._onClick = function(e)
        {
            e = e || window.event;
            var target = e.target || e.srcElement,
                pEl = target;
            if (!target) {
                return;
            }
            if (!hasEventListeners && hasClass(target, 'pika-select')) {
                if (!target.onchange) {
                    target.setAttribute('onchange', 'return;');
                    addEvent(target, 'change', self._onChange);
                }
            }
            do {
                if (hasClass(pEl, 'pika-single')) {
                    return;
                }
            }
            while ((pEl = pEl.parentNode));
            if (self._v && target !== opts.trigger) {
                self.hide();
            }
        };

        self.el = document.createElement('div');
        self.el.className = 'pika-single' + (opts.isRTL ? ' is-rtl' : '');

        addEvent(self.el, 'mousedown', self._onMouseDown, true);
        addEvent(self.el, 'change', self._onChange);

        if (opts.field) {
            if (opts.bound) {
                document.body.appendChild(self.el);
            } else {
                opts.field.parentNode.insertBefore(self.el, opts.field.nextSibling);
            }
            addEvent(opts.field, 'change', self._onInputChange);

            if (!opts.defaultDate) {
                if (hasMoment && opts.field.value) {
                    opts.defaultDate = moment(opts.field.value, opts.format).toDate();
                } else {
                    opts.defaultDate = new Date(Date.parse(opts.field.value));
                }
                opts.setDefaultDate = true;
            }
        }

        var defDate = opts.defaultDate;

        if (isDate(defDate)) {
            if (opts.setDefaultDate) {
                self.setDate(defDate, true);
            } else {
                self.gotoDate(defDate);
            }
        } else {
            self.gotoDate(new Date());
        }

        if (opts.bound) {
            this.hide();
            self.el.className += ' is-bound';
            addEvent(opts.trigger, 'click', self._onInputClick);
            addEvent(opts.trigger, 'focus', self._onInputFocus);
            addEvent(opts.trigger, 'blur', self._onInputBlur);
        } else {
            this.show();
        }

    };


    /**
     * public Pikaday API
     */
    Pikaday.prototype = {


        /**
         * configure functionality
         */
        config: function(options)
        {
            if (!this._o) {
                this._o = extend({}, defaults, true);
            }

            var opts = extend(this._o, options, true);

            opts.isRTL = !!opts.isRTL;

            opts.field = (opts.field && opts.field.nodeName) ? opts.field : null;

            opts.bound = !!(opts.bound !== undefined ? opts.field && opts.bound : opts.field);

            opts.trigger = (opts.trigger && opts.trigger.nodeName) ? opts.trigger : opts.field;

            var nom = parseInt(opts.numberOfMonths, 10) || 1;
            opts.numberOfMonths = nom > 4 ? 4 : nom;

            if (!isDate(opts.minDate)) {
                opts.minDate = false;
            }
            if (!isDate(opts.maxDate)) {
                opts.maxDate = false;
            }
            if ((opts.minDate && opts.maxDate) && opts.maxDate < opts.minDate) {
                opts.maxDate = opts.minDate = false;
            }
            if (opts.minDate) {
                setToStartOfDay(opts.minDate);
                opts.minYear  = opts.minDate.getFullYear();
                opts.minMonth = opts.minDate.getMonth();
            }
            if (opts.maxDate) {
                setToStartOfDay(opts.maxDate);
                opts.maxYear  = opts.maxDate.getFullYear();
                opts.maxMonth = opts.maxDate.getMonth();
            }

            if (isArray(opts.yearRange)) {
                var fallback = new Date().getFullYear() - 10;
                opts.yearRange[0] = parseInt(opts.yearRange[0], 10) || fallback;
                opts.yearRange[1] = parseInt(opts.yearRange[1], 10) || fallback;
            } else {
                opts.yearRange = Math.abs(parseInt(opts.yearRange, 10)) || defaults.yearRange;
                if (opts.yearRange > 100) {
                    opts.yearRange = 100;
                }
            }

            return opts;
        },

        /**
         * return a formatted string of the current selection (using Moment.js if available)
         */
        toString: function(format)
        {
            return !isDate(this._d) ? '' : hasMoment ? moment(this._d).format(format || this._o.format) : this._d.toDateString();
        },

        /**
         * return a Moment.js object of the current selection (if available)
         */
        getMoment: function()
        {
            return hasMoment ? moment(this._d) : null;
        },

        /**
         * set the current selection from a Moment.js object (if available)
         */
        setMoment: function(date)
        {
            if (hasMoment && moment.isMoment(date)) {
                this.setDate(date.toDate());
            }
        },

        /**
         * return a Date object of the current selection
         */
        getDate: function()
        {
            return isDate(this._d) ? new Date(this._d.getTime()) : null;
        },

        /**
         * set the current selection
         */
        setDate: function(date, preventOnSelect)
        {
            if (!date) {
                this._d = null;
                return this.draw();
            }
            if (typeof date === 'string') {
                date = new Date(Date.parse(date));
            }
            if (!isDate(date)) {
                return;
            }

            var min = this._o.minDate,
                max = this._o.maxDate;

            if (isDate(min) && date < min) {
                date = min;
            } else if (isDate(max) && date > max) {
                date = max;
            }

            this._d = new Date(date.getTime());
            setToStartOfDay(this._d);
            this.gotoDate(this._d);

            if (this._o.field) {
                this._o.field.value = this.toString();
                fireEvent(this._o.field, 'change', { firedBy: this });
            }
            if (!preventOnSelect && typeof this._o.onSelect === 'function') {
                this._o.onSelect.call(this, this.getDate());
            }
        },

        /**
         * change view to a specific date
         */
        gotoDate: function(date)
        {
            if (!isDate(date)) {
                return;
            }
            this._y = date.getFullYear();
            this._m = date.getMonth();
            this.draw();
        },

        gotoToday: function()
        {
            this.gotoDate(new Date());
        },

        /**
         * change view to a specific month (zero-index, e.g. 0: Janeiro)
         */
        gotoMonth: function(month)
        {
            if (!isNaN( (month = parseInt(month, 10)) )) {
                this._m = month < 0 ? 0 : month > 11 ? 11 : month;
                this.draw();
            }
        },

        nextMonth: function()
        {
            if (++this._m > 11) {
                this._m = 0;
                this._y++;
            }
            this.draw();
        },

        prevMonth: function()
        {
            if (--this._m < 0) {
                this._m = 11;
                this._y--;
            }
            this.draw();
        },

        /**
         * change view to a specific full year (e.g. "2012")
         */
        gotoYear: function(year)
        {
            if (!isNaN(year)) {
                this._y = parseInt(year, 10);
                this.draw();
            }
        },

        /**
         * change the minDate
         */
        setMinDate: function(value)
        {
            this._o.minDate = value;
        },

        /**
         * change the maxDate
         */
        setMaxDate: function(value)
        {
            this._o.maxDate = value;
        },

        /**
         * refresh the HTML
         */
        draw: function(force)
        {
            if (!this._v && !force) {
                return;
            }
            var opts = this._o,
                minYear = opts.minYear,
                maxYear = opts.maxYear,
                minMonth = opts.minMonth,
                maxMonth = opts.maxMonth;

            if (this._y <= minYear) {
                this._y = minYear;
                if (!isNaN(minMonth) && this._m < minMonth) {
                    this._m = minMonth;
                }
            }
            if (this._y >= maxYear) {
                this._y = maxYear;
                if (!isNaN(maxMonth) && this._m > maxMonth) {
                    this._m = maxMonth;
                }
            }

            this.el.innerHTML = renderTitle(this) + this.render(this._y, this._m);

            if (opts.bound) {
                this.adjustPosition();
                if(opts.field.type !== 'hidden') {
                    sto(function() {
                        opts.trigger.focus();
                    }, 1);
                }
            }

            if (typeof this._o.onDraw === 'function') {
                var self = this;
                sto(function() {
                    self._o.onDraw.call(self);
                }, 0);
            }
        },

        adjustPosition: function()
        {
            var field = this._o.trigger, pEl = field,
            width = this.el.offsetWidth, height = this.el.offsetHeight,
            viewportWidth = window.innerWidth || document.documentElement.clientWidth,
            viewportHeight = window.innerHeight || document.documentElement.clientHeight,
            scrollTop = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop,
            left, top, clientRect;

            if (typeof field.getBoundingClientRect === 'function') {
                clientRect = field.getBoundingClientRect();
                left = clientRect.left + window.pageXOffset;
                top = clientRect.bottom + window.pageYOffset;
            } else {
                left = pEl.offsetLeft;
                top  = pEl.offsetTop + pEl.offsetHeight;
                while((pEl = pEl.offsetParent)) {
                    left += pEl.offsetLeft;
                    top  += pEl.offsetTop;
                }
            }

            if (left + width > viewportWidth) {
                left = left - width + field.offsetWidth;
            }
            if (top + height > viewportHeight + scrollTop) {
                top = top - height - field.offsetHeight;
            }
            this.el.style.cssText = 'position:absolute;left:' + left + 'px;top:' + top + 'px;';
        },

        /**
         * render HTML for a particular month
         */
        render: function(year, month)
        {
            var opts   = this._o,
                now    = new Date(),
                days   = getDaysInMonth(year, month),
                before = new Date(year, month, 1).getDay(),
                data   = [],
                row    = [];
            setToStartOfDay(now);
            if (opts.firstDay > 0) {
                before -= opts.firstDay;
                if (before < 0) {
                    before += 7;
                }
            }
            var cells = days + before,
                after = cells;
            while(after > 7) {
                after -= 7;
            }
            cells += 7 - after;
            for (var i = 0, r = 0; i < cells; i++)
            {
                var day = new Date(year, month, 1 + (i - before)),
                    isDisabled = (opts.minDate && day < opts.minDate) || (opts.maxDate && day > opts.maxDate),
                    isSelected = isDate(this._d) ? compareDates(day, this._d) : false,
                    isToday = compareDates(day, now),
                    isEmpty = i < before || i >= (days + before);

                row.push(renderDay(1 + (i - before), isSelected, isToday, isDisabled, isEmpty));

                if (++r === 7) {
                    data.push(renderRow(row, opts.isRTL));
                    row = [];
                    r = 0;
                }
            }
            return renderTable(opts, data);
        },

        isVisible: function()
        {
            return this._v;
        },

        show: function()
        {
            if (!this._v) {
                if (this._o.bound) {
                    addEvent(document, 'click', this._onClick);
                }
                removeClass(this.el, 'is-hidden');
                this._v = true;
                this.draw();
                if (typeof this._o.onOpen === 'function') {
                    this._o.onOpen.call(this);
                }
            }
        },

        hide: function()
        {
            var v = this._v;
            if (v !== false) {
                if (this._o.bound) {
                    removeEvent(document, 'click', this._onClick);
                }
                this.el.style.cssText = '';
                addClass(this.el, 'is-hidden');
                this._v = false;
                if (v !== undefined && typeof this._o.onClose === 'function') {
                    this._o.onClose.call(this);
                }
            }
        },

        /**
         * GAME OVER
         */
        destroy: function()
        {
            this.hide();
            removeEvent(this.el, 'mousedown', this._onMouseDown, true);
            removeEvent(this.el, 'change', this._onChange);
            if (this._o.field) {
                removeEvent(this._o.field, 'change', this._onInputChange);
                if (this._o.bound) {
                    removeEvent(this._o.trigger, 'click', this._onInputClick);
                    removeEvent(this._o.trigger, 'focus', this._onInputFocus);
                    removeEvent(this._o.trigger, 'blur', this._onInputBlur);
                }
            }
            if (this.el.parentNode) {
                this.el.parentNode.removeChild(this.el);
            }
        }

    };

    return Pikaday;

}));
/* 
 * Scroller v3.1.0 - 2014-11-25 
 * A jQuery plugin for replacing default browser scrollbars. Part of the Formstone Library. 
 * http://formstone.it/scroller/ 
 * 
 * Copyright 2014 Ben Plum; MIT Licensed 
 */


!function(a,b){"use strict";function c(b){b=a.extend({},q,b||{}),null===n&&(n=a("body"));for(var c=a(this),e=0,f=c.length;f>e;e++)d(c.eq(e),b);return c}function d(c,d){if(!c.hasClass(o.base)){d=a.extend({},d,c.data(m+"-options"));var h="";h+='<div class="'+o.bar+'">',h+='<div class="'+o.track+'">',h+='<div class="'+o.handle+'">',h+="</div></div></div>",d.paddingRight=parseInt(c.css("padding-right"),10),d.paddingBottom=parseInt(c.css("padding-bottom"),10),c.addClass([o.base,d.customClass].join(" ")).wrapInner('<div class="'+o.content+'" />').prepend(h),d.horizontal&&c.addClass(o.isHorizontal);var i=a.extend({$scroller:c,$content:c.find(l(o.content)),$bar:c.find(l(o.content)),$track:c.find(l(o.track)),$handle:c.find(l(o.handle))},d);i.trackMargin=parseInt(i.trackMargin,10),i.$content.on("scroll."+m,i,e),i.$scroller.on(p.start,l(o.track),i,f).on(p.start,l(o.handle),i,g).data(m,i),r.reset.apply(c),a(b).one("load",function(){r.reset.apply(c)})}}function e(a){a.preventDefault(),a.stopPropagation();var b=a.data,c={};if(b.horizontal){var d=b.$content.scrollLeft();0>d&&(d=0);var e=d/b.scrollRatio;e>b.handleBounds.right&&(e=b.handleBounds.right),c={left:e}}else{var f=b.$content.scrollTop();0>f&&(f=0);var g=f/b.scrollRatio;g>b.handleBounds.bottom&&(g=b.handleBounds.bottom),c={top:g}}b.$handle.css(c)}function f(a){a.preventDefault(),a.stopPropagation();var b=a.data,c=a.originalEvent,d=b.$track.offset(),e="undefined"!=typeof c.targetTouches?c.targetTouches[0]:null,f=e?e.pageX:a.clientX,g=e?e.pageY:a.clientY;b.horizontal?(b.mouseStart=f,b.handleLeft=f-d.left-b.handleWidth/2,k(b,b.handleLeft)):(b.mouseStart=g,b.handleTop=g-d.top-b.handleHeight/2,k(b,b.handleTop)),h(b)}function g(a){a.preventDefault(),a.stopPropagation();var b=a.data,c=a.originalEvent,d="undefined"!=typeof c.targetTouches?c.targetTouches[0]:null,e=d?d.pageX:a.clientX,f=d?d.pageY:a.clientY;b.horizontal?(b.mouseStart=e,b.handleLeft=parseInt(b.$handle.css("left"),10)):(b.mouseStart=f,b.handleTop=parseInt(b.$handle.css("top"),10)),h(b)}function h(a){a.$content.off(l(m)),n.on(p.move,a,i).on(p.end,a,j)}function i(a){a.preventDefault(),a.stopPropagation();var b=a.data,c=a.originalEvent,d=0,e=0,f="undefined"!=typeof c.targetTouches?c.targetTouches[0]:null,g=f?f.pageX:a.clientX,h=f?f.pageY:a.clientY;b.horizontal?(e=b.mouseStart-g,d=b.handleLeft-e):(e=b.mouseStart-h,d=b.handleTop-e),k(b,d)}function j(a){a.preventDefault(),a.stopPropagation();var b=a.data;b.$content.on("scroll.scroller",b,e),n.off(".scroller")}function k(a,b){var c={};if(a.horizontal){b<a.handleBounds.left&&(b=a.handleBounds.left),b>a.handleBounds.right&&(b=a.handleBounds.right);var d=Math.round(b*a.scrollRatio);c={left:b},a.$content.scrollLeft(d)}else{b<a.handleBounds.top&&(b=a.handleBounds.top),b>a.handleBounds.bottom&&(b=a.handleBounds.bottom);var e=Math.round(b*a.scrollRatio);c={top:b},a.$content.scrollTop(e)}a.$handle.css(c)}function l(a){return"."+a}var m="scroller",n=null,o={base:"scroller",content:"scroller-content",bar:"scroller-bar",track:"scroller-track",handle:"scroller-handle",isHorizontal:"scroller-horizontal",isSetup:"scroller-setup",isActive:"scroller-active"},p={start:"touchstart."+m+" mousedown."+m,move:"touchmove."+m+" mousemove."+m,end:"touchend."+m+" mouseup."+m},q={customClass:"",duration:0,handleSize:0,horizontal:!1,trackMargin:0},r={defaults:function(b){return q=a.extend(q,b||{}),"object"==typeof this?a(this):!0},destroy:function(){return a(this).each(function(b,c){var d=a(c).data(m);d&&(d.$scroller.removeClass([d.customClass,o.base,o.isActive].join(" ")),d.$bar.remove(),d.$content.contents().unwrap(),d.$content.off(l(m)),d.$scroller.off(l(m)).removeData(m))})},scroll:function(b,c){return a(this).each(function(){var d=a(this).data(m),e=c||q.duration;if("number"!=typeof b){var f=a(b);if(f.length>0){var g=f.position();b=d.horizontal?g.left+d.$content.scrollLeft():g.top+d.$content.scrollTop()}else b=d.$content.scrollTop()}var h=d.horizontal?{scrollLeft:b}:{scrollTop:b};d.$content.stop().animate(h,e)})},reset:function(){return a(this).each(function(){var b=a(this).data(m);if(b){b.$scroller.addClass(o.isSetup);var c={},d={},e={},f=0,g=!0;if(b.horizontal){b.barHeight=b.$content[0].offsetHeight-b.$content[0].clientHeight,b.frameWidth=b.$content.outerWidth(),b.trackWidth=b.frameWidth-2*b.trackMargin,b.scrollWidth=b.$content[0].scrollWidth,b.ratio=b.trackWidth/b.scrollWidth,b.trackRatio=b.trackWidth/b.scrollWidth,b.handleWidth=b.handleSize>0?b.handleSize:b.trackWidth*b.trackRatio,b.scrollRatio=(b.scrollWidth-b.frameWidth)/(b.trackWidth-b.handleWidth),b.handleBounds={left:0,right:b.trackWidth-b.handleWidth},b.$content.css({paddingBottom:b.barHeight+b.paddingBottom});var h=b.$content.scrollLeft();f=h*b.ratio,g=b.scrollWidth<=b.frameWidth,c={width:b.frameWidth},d={width:b.trackWidth,marginLeft:b.trackMargin,marginRight:b.trackMargin},e={width:b.handleWidth}}else{b.barWidth=b.$content[0].offsetWidth-b.$content[0].clientWidth,b.frameHeight=b.$content.outerHeight(),b.trackHeight=b.frameHeight-2*b.trackMargin,b.scrollHeight=b.$content[0].scrollHeight,b.ratio=b.trackHeight/b.scrollHeight,b.trackRatio=b.trackHeight/b.scrollHeight,b.handleHeight=b.handleSize>0?b.handleSize:b.trackHeight*b.trackRatio,b.scrollRatio=(b.scrollHeight-b.frameHeight)/(b.trackHeight-b.handleHeight),b.handleBounds={top:0,bottom:b.trackHeight-b.handleHeight};var i=b.$content.scrollTop();f=i*b.ratio,g=b.scrollHeight<=b.frameHeight,c={height:b.frameHeight},d={height:b.trackHeight,marginBottom:b.trackMargin,marginTop:b.trackMargin},e={height:b.handleHeight}}g?b.$scroller.removeClass(o.isActive):b.$scroller.addClass(o.isActive),b.$bar.css(c),b.$track.css(d),b.$handle.css(e),k(b,f),b.$scroller.removeClass(o.isSetup)}})}};a.fn.scroller=function(a){return r[a]?r[a].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof a&&a?this:c.apply(this,arguments)},a.scroller=function(a){"defaults"===a&&r.defaults.apply(this,Array.prototype.slice.call(arguments,1))}}(jQuery);





var locate = '';
var mapMain = null;
var hashCrime = {
  1: "Furto",
  2: "Assalto à mão armada",
  3: "Assalto a grupo",
  4: "Sequestro Relâmpago",
  5: "Arrombamento Veicular",
  6: "Arrombamento Domiciliar",
  7: "Arrombamento Loja comercial",
  8: "Saidinha Bancária",
  9: "Roubo de Veículo",
  10: "Arrastão",
  11: "Tentativa de Assalto"
}
var markers = [];

var initialize = function(reports){
  $(document).keyup(function(e) {
    if (head.screen.innerWidth < 1200) {
      $('.hc-button-report').parent().removeAttr('class').addClass('column_3 offset_3 hide-phone');
      if (head.screen.innerWidth < 950) {
        $('.hc-button-report').parent().removeAttr('class').addClass('column_3 offset_2 hide-phone');
        $('.hc-logo').closest('.column_5').removeAttr('class').addClass('column_6');
      }
    }
    if (e.keyCode == 27) {
      closeModal();
      closeOverlay();
    }
  });
  $(window).load(function(){
    locate = $('.city-name').html()+' - '+$('.state-name').html() + ' - Brasil';
    loadMapByCity(locate, reports);
  });
}


$('.hc-stats-cicle').cycleCarousel({
  time: 4,
  animation: 'fadeInUp'
});

$('.hc-info-report').on('click', function(){
  return false;
});

$('.hc-search-field').on('click', function(){
  if($(this).hasClass('active'))
    searchAddress();
  else
    $(this).add('.overlay.close-on-click, .hc-input-search').toggleClass('active').focus();
});

$('.close-on-click').on('click', function(){
  closeOverlay();
});

$('.hc-checkbox-crime').on('click',function(){
  $(this).parent().click();
});
$('.hc-filter .button[data-period]').on('click', function(){
  var href = $(this).attr('href');
  doPeriodRequest(href);

  return false;
});

$('.hc-legend').on('click', function(){
  var url = window.location.origin;
  var idCity = $('.id-city').html();
  var beginDate = $('.initial-date').val();
  var endDate = $('.end-date').val();

  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: '/'+idCity+'/get_crimes_from_city/'+beginDate+'/'+endDate,
    timeout: 5000,
    success: function(data) {
      fillLegendModal(data);
    },
    error: function(data) {
      console.log('Ocorreu um erro inesperado');
    }
  });
});

$('.toggle-last-reports').on('click', function() {
  $('.panel-last-out .viewport, .panel-last-out .scrollbar').toggleClass('hide');
});

// report denuncia

$('button[data-report]').on('click', function(){
  var fakeButton = '<a data-tuktuk-modal="modalReportDenuncia"></a>';
  $('html').append(fakeButton);
  $('a[data-tuktuk-modal="modalReportDenuncia"]').click();
});

// ================================================================
// ================================================================


// ===================== MOBILE ===================================

if (head.screen.innerWidth < 767){
  $('.hc-legend').removeAttr('class').addClass('mobile-main-button mobile-button-legend').appendTo('.mobile-buttons');
  var headerHeight = $('.header').outerHeight();
  var height = $(window).height() - headerHeight - 45;
  $('.hc-main').css({'height': height, 'top': headerHeight}).find('.column_10').addClass('column_12 column-map').removeClass('column_10');
}

// ================================================================
// ================================================================

//  functions
var doPeriodRequest = function(href) {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: href,
    timeout: 10000,
    beforeSend: function() {
      showLoading();
    },
    success: function(data){
      updateMarkers(data);
      $('.overlay').click();
      hideLoading();
    },
    error: function(data) {
      alert('Ocorreu um erro inesperado');
    }
  });
}
var updateMarkers = function(data) {
  if (!data) {
    return alert('Ocorreu um erro inesperado. Tente novamente mais tarde');
  }
  if (data && data.count == 0) {
    return zeroResults();
  }
  if (data && data.count > 0) {
    updateInfoByPeriod(data);
  }
  clearMarkers();
  buildMapWithMarkers(data.dados, mapMain);
}
var zeroResults = function() {
  $('.hc-title-last, .panel-last-out, .hc-panel-stats, .hc-panel-ranking').addClass('hide');
  $('.hc-count-crimes').html('Não existem crimes registrados no período informado.').addClass('bold');
}
var updateInfoByPeriod = function(data) {
  $('.hc-title-last, .panel-last-out, .hc-panel-stats, .hc-panel-ranking').removeClass('hide');
  $('.hc-count-crimes').removeClass('bold');
  $('.initial-date').val(data.inicio);
  $('.end-date').val(data.fim);
  $('.hc-count-crimes').html('Foram cometidos <span class="text bold">'+data.count+' crimes </span> no período selecionado.');
  // TIME
  $('.stats-time .hc-stats-percent:first').text(data.dia+'%');
  $('.stats-time .hc-stats-percent:last').text(data.noite+'%');
  // GENER
  $('.stats-sex .hc-stats-percent:first').text(data.homem+'%');
  $('.stats-sex .hc-stats-percent:last').text(data.mulher+'%');
  // BO
  $('.stats-bo .hc-stats-percent').text(data.registrou_bo+'%');

}

var growMap = function(map){
  $('.hc-main .column_10').addClass('grow');
  refreshMap(map || mapMain);
}

var lowerMap = function(map){
  $('.hc-main .column_10').removeClass('grow');
  refreshMap(map || mapMain);
}

var closeOverlay = function(){
  $('.overlay, .active').removeClass('active');
}

var openOverlay = function(){
  $('.overlay').addClass('active');
}

var loadMapByCity = function(cidade_estado, reports){
  var city;
  var geocoder = new google.maps.Geocoder();
  var geocoder2 = new google.maps.Geocoder();

  geocoder.geocode({'address': cidade_estado}, function(data, status) {
    if (status == google.maps.GeocoderStatus.OK){
      var lat_lng = data[0].geometry.location;

      geocoder2.geocode({
          latLng: lat_lng
      },function(results, state) {
        if (state == google.maps.GeocoderStatus.OK){
          var arrAddress = results[0].address_components;

          $.each(arrAddress, function (i, address_component) {
            if (address_component.types[0] == "locality")  //"route", "country", "postal_code_prefix", "street_number"
              city = address_component.long_name;
          });

          if(city) {
            loadMainMap(data[0].geometry.location, reports);
          } else {
            alert('Essa cidade não está na nossa área de cobertura.');
            history.go(-1);
          }

        }else
            $("#dragMap").append('Não foi possível determinar sua localização'+status);
      });
    }else
      console.log('Ocorreu um erro inesperado');
  });
}

var loadMainMap = function(pos, reports){
  var centerLng = pos;
  var mapOptions = {
    zoom: 12,
    minZoom: 5,
    scaleControl: true,
    scaleControl:false,
    panControlOptions: {
      position: google.maps.ControlPosition.LEFT_CENTER
    },
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.SMALL,
      position: google.maps.ControlPosition.LEFT_CENTER
    },
    center: centerLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  mapMain = new google.maps.Map(document.getElementsByClassName('map-city-main')[0]);
  mapMain.setOptions(mapOptions);

  clearMarkers();
  buildMapWithMarkers(reports, mapMain);
  // Gmaps.map.markers_conf.do_clustering = true;
  // loadAutoScroll();
}

var buildMapWithMarkers = function(reports, map) {
  var marker, j,
  $markersList = $('#markers_list'),
  infoWindowList = [];

  $markersList.html('');

  try {
    reports = $.parseJSON(reports);
  } catch(err) {
    console.log('Already a object: '+err);
  }


  for (var i=0,len=reports.length; i < len; i++) {
    var current = reports[i];

    marker = new google.maps.Marker({
      position: new google.maps.LatLng(current.latitude, current.longitude),
      map: map,
      icon: '/assets/pins/pin_'+current.tipo_assalto_id+'.png',
    });

    var date = current.data.split('-'),
        orderedDate = [date[2], date[1], date[0]],
        infowindow = new google.maps.InfoWindow(),
        htmlContent = '<div class="hc-info-window">'
        +  '<h5><a class="hc-info-title" href="/denuncias/'+current.id+'">'+current.titulo+'</a></h5>'
        +  '<h6 class="hc-info-crime"><span class="icon tag"></span>&nbsp;'+hashCrime[current.tipo_assalto_id]+'</h6>'
        +  '<h6 class="hc-info-crime"><span class="icon calendar"></span>&nbsp;'+orderedDate.join('/')+'</h6>'
        +  '<h6 class="hc-info-address"><span class="icon map-marker"></span>&nbsp;'+current.endereco+'</h6>'
        +  '<span class="hc-info-buttons">'
        +  '<a href="/denuncias/'+current.id+'" class="button tiny">+ Detalhes</a>'
        +  '</span>'
        +  '</div>';

    markers.push(marker);
    infowindow.setContent(htmlContent);
    infoWindowList.push(infowindow);

    google.maps.event.addListener(marker, 'click', (function(marker, j) {
      return function () {
        infoWindowList.map(function(el,id,arr){ el.close(); });
        infoWindowList[markers.indexOf(marker)].open(map, marker);
      }
    })(marker, j));

    var lastReport = buildLastReportContent(current, date, i);
    $markersList.append(lastReport);
    $('.trigger-last-report').on('click', function(e) {
      var $anchor = $(this),
          index = $anchor.data('index');
      console.log(index);
      google.maps.event.trigger(markers[index], 'click');
    });
  }

  $markersList.scroller({
    trackMargin: 10,
    handleSize: 40
  });
}

var buildLastReportContent = function(report, date, index) {
  var htmlContent = '<li><a class="trigger-last-report" data-index="'+index+'">'
  + '<div class="left">'
      + '<h4>'+report.titulo+'</h4>'
      + '<h5>'+hashCrime[report.tipo_assalto_id]+'</h5>'
      + '<h5><i class="icon-calendar"></i>'+date.join('/')+'</h5>'
    + '</div>'
    + '<div class="tipo-assalto tipo'+report.tipo_assalto_id+'"></div>'
    + '</a></li>';

  return htmlContent;
}

var loadAutoComplete = function(map) {
  var addressInput = $('.hc-input-search')[0];
  var searchOptions = {
    componentRestrictions: {country: 'br'}
  };
  var autocomplete = new google.maps.places.Autocomplete(addressInput, searchOptions);
  autocomplete.bindTo('br', map);
  $('.pac-container').css('z-index', '9999999');

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    geocodePosition(autocomplete.getPlace().geometry.location); //lat e lng
    if(marker){
      map.setCenter(autocomplete.getPlace().geometry.location);
      map.setZoom(14);
      marker.setPosition(autocomplete.getPlace().geometry.location);

      if(thePanorama){
        thePanorama.setPosition(autocomplete.getPlace().geometry.location);
        marker.setPosition(autocomplete.getPlace().geometry.location);
      }
    }
  });
}

var getCrimesByCity = function() {
  var id = $('.id-city').text();
  var template = '';
  var url = window.location.origin;
  var beginDate = $('.initial-date').val();
  var endDate = $('.end-date').val();

  var _request = function(id, template, beginDate, endDate){
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: '/'+id+'/get_crimes_from_city/'+beginDate+'/'+endDate,
      timeout: 5000,
      beforeSend: function(xhr) {
        showLoading();
      },
      success: function(data){
        if(data.length > 0){
          $.each(data, function(i, obj){
            template += '<fieldset class="hc-fieldset-crime">'
              +'<input type="checkbox" class="hc-checkbox-crime" name="tipo" value="'+obj.id+'">'
              +'<span class="hc-label-crime">'+obj.descricao+'</span>'
            +'</fieldset>';
          });
          $('.hc-filter-target').html(template);
          $('.hc-fieldset-crime').on('click', function(){
            $(this).find('input').click();
          });
        } else {
          $('.hc-filter-target').html('<span class="text bold" style="color: #333;">Não há crimes cadastrados nesse período.</span>');
        }
        hideLoading();
      },
      error: function(data) {
        console.log('Não foi possível carregar os tipos de crime');
      }
    });
  }

  if($('.hc-filter.crimes fieldset').size() < 1)
    _request(id, template, beginDate, endDate);
}

var clearMarkers = function() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}


$('.hc-filter-refresh').on('click', function(e){
  var $checkboxList = $('.hc-checkbox-crime:checked');
  var data = [];
  var id = $('.id-city').text();
  var urlBase = window.location.origin;
  var beginDate = $('.initial-date').val();
  var endDate = $('.end-date').val();
  $.each($checkboxList, function(i, obj){
    data.push(obj.value);
  });
  var listArray = data.join(",")
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: '/'+id+'/get_reports_by_crimes/'+beginDate+'/'+endDate,
    timeout: 5000,
    data: ({info: listArray}),
    beforeSend: function(xhr) {
      showLoading();
    },
    success: function(data){
      hideLoading();
      updateMarkers(data);
      $('.hc-filter').removeClass('active');
    },
    error: function(data) {
      console.log('Não foi atualizar o mapa com os tipos de crime');
    }
  });
  return false;
});

$('.hc-panel-button.period').on('click', function(e){
  $('.hc-filter.crimes').removeClass('active');
  var tgt = $(this).attr('data-filter');
  if (tgt == 'crimes')
    getCrimesByCity();
  var $box = $('.hc-filter.'+tgt);
  $box.toggleClass('active');
});


$('.hc-panel-button.crimes').on('click', function(e){
  $('.hc-filter.period').removeClass('active');
  var tgt = $(this).attr('data-filter');
  if (tgt == 'crimes')
    getCrimesByCity();
  var $box = $('.hc-filter.'+tgt);
  $box.toggleClass('active');
});

var beginPicker = new Pikaday({
  field: $('.input-filter-date')[0],
  onSelect: function(date) {
    var year = date.getFullYear(), month = (date.getMonth() + 1), day = date.getDate();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var properlyFormatted = day +"/"+ month +"/"+ year;
    var auxFormatted = year+'-'+month+'-'+day;
    var $input = $($('.input-filter-date')[0]);
    $input.val(properlyFormatted);
    $input.attr('data-value', auxFormatted);
    var beginDate = $input.attr('data-value');
    var maxDate = new Date(beginDate);
    endPicker.setMinDate(maxDate);
  },
  maxDate: new Date()
});

var endPicker = new Pikaday({
  field: $('.input-filter-date')[1],
  onSelect: function(date) {
    var year = date.getFullYear(), month = (date.getMonth() + 1), day = date.getDate();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var properlyFormatted = day +"/"+ month +"/"+ year;
    var auxFormatted = year+'-'+month+'-'+day;
    var $input = $($('.input-filter-date')[1]);
    $input.val(properlyFormatted);
    $input.attr('data-value', auxFormatted);
  },
  maxDate: new Date(),
});

$('.hc-custom-period').on('click', function() {
  $('.hc-custom-form').removeClass('hide');
  $('.hc-filter.period').find('.button[data-period]').removeClass('success').addClass('secondary');
});

$('.custom-period-submit').on('click', function() {
  var begin = $('.input-filter-date:first').attr('data-value');
  var end = $('.input-filter-date:last').attr('data-value');
  var idCity = $('.id-city').html();
  var url = '/'+idCity+'/filtros/'+begin+'/'+end;
  doPeriodRequest(url);
  $('.hc-filter.period').removeClass('active');
  $('.button[data-period]').removeClass('secondary').addClass('success');
});

// carousel markers_list
var loadAutoScroll = function(){
  var $list = $('#markers_list');
  var $li = $list.find('li');
  if ($li.size() > 10){
    setInterval(function(){
      $('#markers_list li').first().addClass('fadeOut animated');
      _appendToList();
    }, 4000);
  }
  var _appendToList = function() {
    setTimeout(function(){
      $('#markers_list li').first().removeClass('fadeOutUp animated').appendTo($('#markers_list'));
    }, 700);
  }
}

var fillLegendModal = function(data) {
  var legend = '';
  $.each(data, function(i, obj){
    legend += '<span class="hc-legend-crime">'
      +'<img src="/assets/pins/pin_'+obj.id+'.png" class="hc-legend-img">'+obj.descricao
    +'</span>';
  });
  $('.hc-legend-list').html(legend);
}

var shareFacebook = function(){
  var imgShare = window.location.origin+'/assets/apple-touch-icon.png';
  var title = $('.sd-info-title').html();
  var desc = $('.sd-info-desc h3').html();
  var caption = $('.sd-info-type').html()+' | '+$('.sd-address-desc').html();
  var url = window.location.href+'?utm_source=ofr&amp;utm_medium=facebook'

  var obj = {
    method: 'feed',
    link: url,
    picture: imgShare,
    caption: caption,
    name: title,
    description: desc
  };

  function callback(response) {
   //console.log("Post ID: " + response['post_id']);
  }
  FB.ui(obj, callback);
}


// ================================================================
// ================================================================


// ===================== NEW REPORT ===============================
var map, marker;
var loadNewReportPage = function() {
  resetInputs();
  loadNewReportMap();
  $('.nr-checkbox-obj').on('change', function(){
    if($(this).is(':checked'))
      $(this).closest('.nr-label-obj').addClass('active');
    else
      $(this).closest('.nr-label-obj').removeClass('active');
  }).trigger('change');

  var dateInput = $('#denuncia_data')[0];
  var picker = new Pikaday({
    field: dateInput,
    onSelect: function(date) {
      var year = date.getFullYear(), month = (date.getMonth() + 1), day = date.getDate();
      if (month < 10) month = "0" + month;
      if (day < 10) day = "0" + day;

      var properlyFormatted = day +"/"+ month +"/"+ year;
      dateInput.value = properlyFormatted;
    }
  });

  $('[data-count_ref]').on('keyup', function(){
    $input = $(this);
    var tgt = $input.attr('data-count_ref');
    var count = $('.'+tgt).attr('data-count');

    var current_size = parseInt(count) - parseInt($input.val().length);
    $('.'+tgt).html(current_size+' caracteres restantes')
  });

  /*$('form#new_denuncia').submit(function(e){
    e.preventDefault();
    validateForm();
  });*/
}

var loadNewReportMap = function(address) {
  var cityName = $('.nr-city').html();
  var stateAlias = $('.nr-state').html();
  if (!address)
    var address = cityName+' - '+stateAlias;
  var geocoder = new google.maps.Geocoder();

  geocoder.geocode( {'address': address}, function(data, status) {
    if (status == google.maps.GeocoderStatus.OK)
      _loadMap(data[0].geometry.location);
  });
}
function _loadMap(position) {
  var zoom = 13;
  var animation = google.maps.Animation.BOUNCE;

  var mapOptions = {
    zoom: zoom,
    center: position,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    mapTypeControlOptions: {
      position: google.maps.ControlPosition.RIGHT_BOTTOM
    }
  };

  var mapElement = document.getElementById('new-report-map');
  map = new google.maps.Map(mapElement, mapOptions);

  marker = new google.maps.Marker({
      map:map,
      draggable: true,
      animation: animation,
      position: position
  });
  var $addressInput = $('.nr-search-address')[0];
  var searchOptions = {
    componentRestrictions: {country: 'br'}
  };
  var autoComplete = new google.maps.places.Autocomplete($addressInput, searchOptions);
  autoComplete.bindTo('br', map);

  google.maps.event.addListener(autoComplete, 'place_changed', function() {
    geocodePosition(autoComplete.getPlace().geometry.location);
    if(marker) {
      map.setCenter(autoComplete.getPlace().geometry.location);
      map.setZoom(14);
      marker.setPosition(autoComplete.getPlace().geometry.location);
    }
  });

  google.maps.event.addListener(marker, 'dragend', function(){
    geocodePosition(marker.position);
    marker.setAnimation(null);
  });
}

var geocodePosition = function(pos){
  var city;
  var bairro = null;
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({
      latLng: pos
  },function(results, status) {
    if (status == google.maps.GeocoderStatus.OK){
      if(map){
        $('#lat').val(results[0].geometry.location.lat());
        $('#lng').val(results[0].geometry.location.lng());
        $('#addressField').val(results[0].formatted_address);
        $('.nr-map-show-address').addClass('active').html('<span class="icon map-marker"></span> &nbsp;'+results[0].formatted_address);
      }

      var arrAddress = results[0].address_components;
      $.each(arrAddress, function (i, address_component) {
        if (address_component.types[0] == "locality")  //"route", "country", "postal_code_prefix", "street_number"
            city = address_component.long_name;
            $('#city').val(city);
      });

      bairro = results[0].address_components[2].long_name;
      if(bairro == city)
        bairro = results[0].address_components[3].long_name;

      var estado = $('#state-name').val();
      if(bairro == estado)
        bairro = null;

      if(bairro)
        $('#denuncia_bairro').val(bairro);
    }else
      $("#dragMap").append('Não foi possível determinar sua localização'+status);
  });
}

var validateForm = function(){
  if($('#addressField').val().length < 2)
    showModalError('É necessário informar o <strong>endereço</strong> onde ocorreu o crime.');
  else if ($('#denuncia_tipo_assalto_id').val() == 0)
    showModalError('É preciso escolher o tipo de assalto.');
  else if ($('input#denuncia_data').val().length < 8)
    showModalError('Informe uma data válida');
  else if ($('input#denuncia_titulo').val().length < 2)
    showModalError('Crie um título para o ocorrido');
  else if (!$('#denuncia_sexo').val())
    showModalError('Escolha seu sexo');
  else if(emptyObjects())
    showModalError('É preciso informar ao menos um objeto.');
  else if(!$('#denuncia_valor_prejuizo').val())
    showModalError('Informe um valor estimado do seu prejuízo.');
  else if($('.nr-allow input:checked').size() < 1)
    showModalError('É necessário afirmar que as informações declaradas são verdadeiras.');
  else if(!$('#denuncia_humanizer_answer').val().length > 0)
    showModalError('É preciso responder a pergunta antes de salvar a denúncia.');
  else if($('#city').val() != $('.nr-city').html())
    showModalError('Ops! Você não pode registrar a denúncia em outro lugar a não ser '+$('.nr-city').html());
  else
    $('#new_denuncia').submit();
}

var emptyObjects = function(){
  if($('.nr-label-obj.active').size() >= 1)
    return false;
  else
    return true;
}

var resetInputs = function(){
  for(var i=11;i<18;i++)
    $('label.nr-obj-'+i).hide();
  $('.nr-obj-9').insertAfter('label.nr-obj-19');

  $('#denuncia_tipo_assalto_id').on('change', function(){
    if($(this).val() == 5)
      $('.nr-obj-11, .nr-obj-17').show().siblings('.nr-obj-12, .nr-obj-13, .nr-obj-14, .nr-obj-15, .nr-obj-16').hide();
    else if($(this).val() == 6)
      $('.nr-obj-12, .nr-obj-13, .nr-obj-14, .nr-obj-15, .nr-obj-16').show().siblings('.nr-obj-11, .nr-obj-17').hide();
    else
      for(var i=11;i<18;i++)
        $('label.nr-obj-'+i).hide();
  });
}

var showModalError = function(message){
  $('#modalErrorValidation article').html(message);
  $('.nr-validation-modal').click();
}
// ================================================================
// ================================================================



//  ===================== SHOW REPORT ==========================
$(function(){
  $('[data-scroll]').on('click', function(){
    var scrollTo = $(this).attr('data-scroll');
    scrollTo = $('.'+scrollTo);
    $('body').animate({scrollTop: $(scrollTo).offset().top - 45 }, 'slow');
    $(scrollTo).addClass('pulse');
  });

  $('a[data-vote]').on('click', function(e){
    var $formVote = $('.sd-form-vote');
    var vote = $(this).attr('data-vote');
    var $input = $formVote.find('input');

    if (vote == "up")
      $input.val('up');
    else
      $input.val('down');

    var data = "?v="+$input.val();
    $.ajax({
      type:'POST',
      dataType:'json',
      url: $formVote.attr('action'),
      data: data,
      timeout:3000,
      success: function(data){
        if(data.status == "false"){
          $('button[data-tuktuk-modal="modalSignUp"]').click();
        }
      },
      error: function(){
        alert('Ocorreu um erro. Tente novamente mais tarde.');
      }
    });
    return false;
  });

  $('.share-button').on('click', function(){
    if ($(this).hasClass('fb'))
      shareFacebook();
    else{
      var href = $(this).attr('href');
      var imgShare = window.location.origin+'/assets/apple-touch-icon.png';
      var title = $('.sd-info-title').html();
      var desc = $('.sd-info-desc h3').html();
      var caption = $('.sd-info-type').html()+' | '+$('.sd-address-desc').html();

      var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
      var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
      var left = (screen.width/2)-(500/2) + dualScreenLeft;
      var top = (screen.height/2)-(400/2) + dualScreenTop;
      window.open(
        href,
        'popupwindow',
        'scrollbars=yes,width=500,height=400,top='+top+',left='+left
      ).focus();
    }
    return false;
  });
});

var showMap = function(){
  var lat = $('#lat').html();
  var lng = $('#lng').html();
  var id_assalto = $('#id_assalto').html();
  center = new google.maps.LatLng(lat, lng);

  var mapOptions = {
    zoom: 17,
    center: center,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControlOptions:{
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
      position: google.maps.ControlPosition.RIGHT_BOTTOM
    },
    scrollwheel: false
  };

  map = new google.maps.Map(document.getElementById('sd-map'), mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    animation: google.maps.Animation.BOUNCE,
    position: center,
    icon: '/assets/pins/pin_'+id_assalto+'.png',
    shadow:{
      url: "http://www.google.com/mapfiles/shadow50.png",
    anchor: new google.maps.Point(8, 36)
    }
  });

  fillAddress();
}

var fillAddress = function(){
  var geocoder = new google.maps.Geocoder();

    geocoder.geocode({
        latLng: center
    },function(results, status) {
      if (status == google.maps.GeocoderStatus.OK){
        globalTest = results[0];
        $('.sd-show-address .sd-address').html('<span class="icon map-marker"></span> <span class="sd-address-desc">'+results[0].address_components[1].long_name+', '+results[0].address_components[2].long_name+' - '+results[0].address_components[3].long_name+'</span>');
      }else
        $(".sd-show-address").remove();
    }
  );
}

function loadMapCallback(endereco){
  console.log('call');
  var geocoder2 = new google.maps.Geocoder();
  geocoder2.geocode( { 'address': endereco}, function(data, status) {
    if (status == google.maps.GeocoderStatus.OK){
      loadNewReportMap(data[0].geometry.location);
    }
  });
}

$('.rkg-type-button').on('click', function() {
  var dataSection = $(this).attr('data-type');
  $(this).toggleClass('secondary').siblings().removeClass('secondary');
  $('.rkg-data-section.'+dataSection).removeClass('hide').siblings().addClass('hide');
});
