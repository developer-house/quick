$("#search").click(function () {
    $('#filter').animate({height: 'toggle'});
    $('.card-filter>.card-footer').toggleClass('open');
});

$('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "inherit");
});

$('.table-responsive').on('hide.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "auto");
});