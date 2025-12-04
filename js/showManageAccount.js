$(document).ready(() => {
    $('#manageAccountBtn').click(function() {
        $(this).toggleClass('not-active');
        $('.ma-con').toggleClass('hidden');

        $('.main-con').addClass('hidden');
        $('#statisticBtn').addClass('not-active');
        
        if (!$('#announcement').hasClass('hidden') || !$('#missionVision').hasClass('hidden')) {
            $('#announcement').addClass('hidden');
            $('#missionVision').addClass('hidden');
        } else if ($('#manageAccountBtn').hasClass('not-active') && $('#statisticBtn').hasClass('not-active')) {
            $('#announcement').removeClass('hidden');
            $('#missionVision').removeClass('hidden');
        }
    });

    $('#managePdoAccountBtn').click(function() {
        $(this).toggleClass('not-active');
        $('.ma-con').toggleClass('hidden');

        $('.main-con').addClass('hidden');
        $('#studentRecordBtn').addClass('not-active');
        
        if (!$('#announcement').hasClass('hidden') || !$('#missionVision').hasClass('hidden')) {
            $('#announcement').addClass('hidden');
            $('#missionVision').addClass('hidden');
        } else if ($('#managePdoAccountBtn').hasClass('not-active') && $('#studentRecordBtn').hasClass('not-active')) {
            $('#announcement').removeClass('hidden');
            $('#missionVision').removeClass('hidden');
        }
    });
});