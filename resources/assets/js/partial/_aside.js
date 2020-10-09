$(document).ready(function () {


    $(".btn-menu").click(function () {
        $('.aside-container').toggleClass('open');
        $('.overlord').toggleClass('open');
    });

    $('aside>div>ul:first').each(function () {

        $(this).attr('id', 'menu');

        let i = 1;
        $('aside>div>ul:first>li').each(function () {

            $(this).attr('data-toggle', 'collapse');
            $(this).attr('class', 'collapsed');
            $(this).attr('data-target', '#s' + i);

            $(this).find('ul:first').each(function () {
                $(this).attr('id', 's' + i);
                $(this).attr('data-parent', '#menu');
                $(this).attr('class', 'collapse');
            });

            i++;

        });

    });


});