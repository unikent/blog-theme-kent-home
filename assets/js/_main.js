/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
    var blogshome = {
        // All pages
        common: {
            init: function() {

            }
        },
        // Home page
        home: {
            init: function() {
                $('#more-button').click(function(e){
                    $(this).find('i').show();
                    $(this).prop('disabled',true);
                    $p = (parseInt($(this).data('page'))+1);
                    if($p<=10) {
                        $.ajax(AJAX.ajaxurl, {
                            data: {action: 'get_latest', page: $p},
                            success: function ($data) {
                                $('#latest-foot').before($data);
                                $more = $('#more-button');
                                $p = parseInt($more.data('page'));
                                $more.data('page', $p + 1);
                                if (($p + 1) >= 10) {
                                    $more.hide();
                                }
                            },
                            complete:function ($data) {
                                $more = $('#more-button');
                                $more.find('i').hide();
                                $more.prop('disabled',false);
                            }
                        });
                    }else{
                        $more = $('#more-button');
                        $more.find('i').hide();
                        $more.prop('disabled',false);
                    }
                });
            }
        },
        // About us page, note the change from about-us to about_us.
        page_template_template_allblogs_php: {
            init: function() {
                var extensions = {
                    "sFilter": "dataTables_filter form-inline",
                    };
                // Used when bJQueryUI is false
                $.extend($.fn.dataTableExt.oStdClasses, extensions);


                $('#allblogs').DataTable({
                    paging: false,
                    initComplete: function () {

                            var column = this.api().column(2);
                            var select = $('<label>Category: <select class="form-control"><option value="">All</option></select></label>')
                                .appendTo( $('#allblogs_filter'));
                            select = select.find('select');
                            select.on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                            column.data().unique().sort().each( function ( d, j ) {
                                if(d!=='') {
                                    select.append('<option value="' + d + '">' + (d === '' ? 'All' : d) + '</option>');
                                }
                            } );

                    }
                } );
            }
        }
    };

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
    var BLOGSHOME = {
        fire: function(func, funcname, args) {
            var namespace = blogshome;
            funcname = (funcname === undefined) ? 'init' : funcname;
            if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            BLOGSHOME.fire('common');

            $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
                BLOGSHOME.fire(classnm);
            });
        }
    };

    $(document).ready(BLOGSHOME.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
