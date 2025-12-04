$(document).ready(() => {
    $('#statisticBtn').click(function() {
        $(this).toggleClass('not-active');
        $('.main-con').toggleClass('hidden');
        
        $('.ma-con').addClass('hidden');
        $('#manageAccountBtn').addClass('not-active');
        
        if (!$('#announcement').hasClass('hidden') || !$('#missionVision').hasClass('hidden')) {
            $('#announcement').addClass('hidden');
            $('#missionVision').addClass('hidden');
        } else if ($('#manageAccountBtn').hasClass('not-active') && $('#statisticBtn').hasClass('not-active')) {
            $('#announcement').removeClass('hidden');
            $('#missionVision').removeClass('hidden');
        }
    });
});