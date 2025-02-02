$(document).ready(() => {
    $('#statisticBtn').click(function() {
        $(this).toggleClass('not-active');
        $('.main-con').toggleClass('hidden');

        $('#announcement').toggleClass('hidden');
        $('#missionVision').toggleClass('hidden');
    });
});