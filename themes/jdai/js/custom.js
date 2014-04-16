$(document).ready(function () {
    $('#User_county.manageuser').change(false);

    $('.panel .tools .fa-chevron-down').click(function () {
        var el = $(this).parent(".tools").parent('.panel-heading').parent('.panel').children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    $("#sidebar a[href*=#]:not([href=#])").bind('click', function (event) {

        $("#sidebar a[href*=#]:not([href=#])").removeClass('active');
        $(this).addClass('active');

        var thisHash = this.hash;
        thisHash = thisHash.substring(1);

        var targetOffset = $("fieldset[name='" + thisHash + "']").offset().top;
        $("html,body").stop().animate({
            scrollTop: targetOffset-100
        }, 600 );
        location.hash = thisHash;
        event.preventDefault();
    });



});