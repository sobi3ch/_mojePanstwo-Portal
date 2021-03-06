/* SCRIPT FIX IMG WITH BROKEN LINKS */
function imgFixer(img) {
    var style = window.getComputedStyle(img, null),
        maxWidth = style.getPropertyValue('max-width'),
        size = (img.offsetWidth == 0) ? ((maxWidth == "") ? 100 : parseInt(maxWidth)) : img.offsetWidth,
        imgBlankSrc = img.src,
        imgBlankSetting = "/fff/ddd";

    /*IMG LINK TO DOCUMENT - SO WE GENERATE RECTANGLE*/
    if (imgBlankSrc.toLowerCase().indexOf("docs.sejmometr") >= 0) {
        /*WE TRY SIMILAR NEW IMAGE TO DOCUMENTS*/
        img.style.border = "2px solid #ddd";
        /*LINK WITH DOCUMENT TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + "x" + Math.ceil(Number(size * 1.32)) + imgBlankSetting + "&text=document";
    }/*IMG LINK TO AVATAR - SO WE GENERATE SQUARE*/
    else if (imgBlankSrc.toLowerCase().indexOf("resources.sejmometr") >= 0) {
        /*LINK WITH AVATAR TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + imgBlankSetting + "&text=avatar";
    }/*IMG LINK TO OTHERS - SO WE GENERATE SQUARE TOO*/
    else {
        /*LINK WITH ERROR TEXT*/
        imgBlankSrc = "http://placehold.it/" + size + imgBlankSetting + "&text=error";
    }

    /*REMOVE ONERROR FUNCTION - CAUSE WE USE IT ALREADY*/
    img.onerror = "";
    /*CLEAR SRC SO CHROME WILL NOW STOP AT ONE IMAGE*/
    img.setAttribute('src', null);
    /*AND INSTERT NEW SRC*/
    img.src = imgBlankSrc;

    if (typeof countDataObjectsSliderRowDetect != 'undefined' && countDataObjectsSliderRowDetect == true)
        window.setTimeout(countDataObjectsSliderRow, 0);

    return true;
}
/*FUNCTION CHECK IS ELEMENT IS VISIBLE AT SCREEN*/
function isElementVisibled(elem) {
    var docViewTop, docViewBottom, elemTop, elemBottom;

    docViewTop = jQuery(window).scrollTop();
    docViewBottom = docViewTop + jQuery(window).height();
    elemTop = jQuery(elem).offset().top;
    elemBottom = elemTop + jQuery(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
/*TRIGGER GLOBAL ALERT VIA JS*/
function globalAlert(status, text) {
    var wrapper = $('#_wrapper'),
        flashMessage,
        status = typeof status !== 'undefined' ? status : 'alert-info;';

    if ((flashMessage = wrapper.find('> .flash-message')).length == 0) {
        flashMessage = $('<div></div>').addClass('flash-message');
        wrapper.find('> header').after(flashMessage);
    }

    if (flashMessage.find('.alert.' + status + ' .container').filter(function () {
            return $(this).text() === '×' + text
        }).length == 0) {
        flashMessage.append(
            $('<div></div>').addClass('alert ' + status).css('display', 'none').append(
                $('<div></div>').addClass('container').text(text).prepend(
                    $('<a></a>').addClass('close').attr('href', '#').data('dismiss', 'alert').text('×').click(function (e) {
                        var parent = $(this).parents('.alert');
                        e.preventDefault();
                        parent.slideUp(function () {
                            parent.remove();
                            if (flashMessage.find('.alert').length == 0)
                                flashMessage.slideUp(function () {
                                    flashMessage.remove();
                                })
                        })
                    })
                )
            )
        );
        flashMessage.find('.alert:last').slideDown();
    }
}
/*FUNCTION CUT TITLE TO SHORTER FORM WITH OPTION OF EXPANDING IT*/
trimTitle = function () {
    jQuery('.trimTitle').each(function () {
        var that = jQuery(this),
            body = jQuery.trim(that.text()),
            title = (that.attr('title') != undefined && that.attr('title') != '') ? that.attr('title') : ((that.data('trimtitle') != undefined && that.data('trimtitle') != '') ? that.data('trimtitle') : false),
            trimLength = ((that.data('trimlength') != undefined) ? that.data('trimlength') : 150);

        if (title != false && trimLength != undefined) {
            if (body.length > trimLength + 20) {
                var splitLocation = body.indexOf(' ', trimLength),
                    shortTitle = false,
                    hyperlink = (that.closest('a').length);

                if (splitLocation != -1) {
                    splitLocation = body.indexOf(' ', trimLength);
                    shortTitle = body.substring(0, splitLocation);
                    that.data('trimtitle', title);

                    if (hyperlink) { /*TARGET IS HYPERLINK*/
                        that.closest('a').html(shortTitle).after('<span class="trimTitleTrigger hyper">...</span>');

                        that.parent().find('.trimTitleTrigger').click(function () {             //             ^oo1^
                            that.closest('a').html(that.data('trimtitle'));                     //            ++o1^+o111111+^
                            jQuery('.trimTitleTrigger').remove();                               //           1+^^^ oo^1NNNooo+^+^
                        });                                                                     //           o^^^^^^01+100+^o0110o+
                    } else { /*TARGET IS NORMAL TEXT */                                         //           ooo^^^^100oooo1o000NMM1
                        that.html(shortTitle + '<span class="trimTitleTrigger">...</span>');    //           11^^^^^+00000000000NMMMN1
                        that.click(function () {                                                //           ^1+^^^^^^100000MM0NMN0NMMM01^
                            that.html(jQuery(this).data('trimtitle'));                          //            oMo^^^^^ +11+1o0MMNNMMN00NMMM0^
                        });                                                                     //             1Mo+^^+^^^^^^^^+0M00MMMMMMNNNM0
                    }                                                                           //             oMMN1+^^^^^^+1oNMMNNMMMMMMMMNNM+
                }                                                                               //             ^MN^ ^^^^^^^^^100NNM0NMMMMMMMMNM1
            }                                                                                   //             NM^^^^^^^^^^^^^^^^10M+^+1oNMMMNMM
        }                                                                                       //             0+^^^^^^^^^^^^^^^^^+oo     +oMM0^
    });                                                                                         //             ^^^^^^^^^^^^^^^^^^^^+o       1NM^
};                                                                                              //            1^^^^^^^^^^^^^^^^^^^^^++        +
/* JQUERY - STICK ELEMENT AT SCROLL */                                                          //           ^o^^^^^^^^^^^^^^^^^^^^^^^
sticky = function (dom, direction) {                                                            //            o^^^^^^^^^^^^^^^^^^^^^^
    if (jQuery(dom).length) {                                                                   //            NN^^^^^^^^^^^^^ ^^^^^^^^
        if (direction == undefined)                                                             //           ^MN^^^^^^ ^^^^^ ^^^^^^^^1+
            direction = 'down';                                                                 //           1M+^^^^^^^^^^^^^^^^^^ ++oo+
        stickyGo(dom, direction);                                                               //           0+^^^^^^^^^^^^^^^^^^+10000o
        jQuery(window).scroll(function () {                                                     //          0+^^^^^^^^^^^^ ^^^+1o0000000o
            stickyGo(dom, direction);                                                           //         0o^^^^^^^^^^^^^^+1o000000000000^
        });                                                                                     //        1Mo^^^o0+^++^^^+o000oo00000o0000o^
    }                                                                                           //        oM0++1o1MNMo^+1o00000000000000000o
};                                                                                              //        0M0001^ 0MMo1000000000000o000ooo001
stickyGo = function (dom, direction) {                                                          //          o1+   1MM00000000000000o000000000^
    var anchor = jQuery('.anchor'),                                                             //                ^MMN000000000000000000000001
        exist = false;                                                                          //                 oMMN000000000000000000o0000
    jQuery.each(anchor, function () {                                                           //                 ^MMMMMN000000o0000000000000
        if (jQuery(this).attr('data-id') == dom)                                                //                  NMMMN000oo000000000oo000oo
            exist = true;                                                                       //                 +MMMNN00000oo00000000000o0o
    });                                                                                         //                 0MMMMN000000000000oo000000o
    if (exist == false)                                                                         //                 MMMMM00000000000000000NMMM^
        jQuery('<div class="anchor" data-id=' + dom + '></div>').insertBefore(dom);             //                 MMMMMN00000000000o00MMMMM01^^
    var stickGoAnchor = jQuery('.anchor[data-id=' + dom + ']'),                                 //                 oMMMMMMN00o000000000MMMNo^^^+^
        window_top = jQuery(window).scrollTop(),                                                //               ^^^^+1NMMMN00000000000MMM0+^^^^11
        header_fixed = jQuery('header').outerHeight(true),                                      //          ^1+^^^+o00o0MMMM000000oo00NNMNNo0++^1o
        window_height = jQuery(window).height(),                                                //          ^+^++^+^^      ^+1o000o001+^
        div_top = stickGoAnchor.offset().top;                                                   //                     ^^^^^^^oo00o0+
    if (window_top + header_fixed > div_top && direction == 'down') {                           //                   +01111+++1+++^^^
        jQuery(dom).addClass('stick');
    } else if ((window_top + header_fixed + window_height - jQuery(dom).outerHeight()) < div_top && direction == 'up') {
        jQuery(dom).addClass('stick');
    } else {
        jQuery(dom).removeClass('stick');
    }
};

/* Simple JavaScript Inheritance
 * By John Resig http://ejohn.org/
 * MIT Licensed.
 */
// Inspired by base2 and Prototype
(function () {
    var initializing = false, fnTest = /xyz/.test(function () {
        xyz;
    }) ? /\b_super\b/ : /.*/;

    // The base Class implementation (does nothing)
    this.Class = function () {
    };

    // Create a new Class that inherits from this class
    Class.extend = function (prop) {
        var _super = this.prototype;

        // Instantiate a base class (but only create the instance,
        // don't run the init constructor)
        initializing = true;
        var prototype = new this();
        initializing = false;

        // Copy the properties over onto the new prototype
        for (var name in prop) {
            // Check if we're overwriting an existing function
            prototype[name] = typeof prop[name] == "function" &&
            typeof _super[name] == "function" && fnTest.test(prop[name]) ?
                (function (name, fn) {
                    return function () {
                        var tmp = this._super;

                        // Add a new ._super() method that is the same method
                        // but on the super-class
                        this._super = _super[name];

                        // The method only need to be bound temporarily, so we
                        // remove it when we're done executing
                        var ret = fn.apply(this, arguments);
                        this._super = tmp;

                        return ret;
                    };
                })(name, prop[name]) :
                prop[name];
        }

        // The dummy class constructor
        function Class() {
            // All construction is actually done in the init method
            if (!initializing && this.init)
                this.init.apply(this, arguments);
        }

        // Populate our constructed prototype object
        Class.prototype = prototype;

        // Enforce the constructor to be what we expect
        Class.prototype.constructor = Class;

        // And make this class extendable
        Class.extend = arguments.callee;

        return Class;
    };
})();