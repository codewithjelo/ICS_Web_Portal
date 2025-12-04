$(document).ready(() => {
    $('#studentRecordBtn').click(function() {
        $(this).toggleClass('not-active');
        $('.main-con').toggleClass('hidden');

        $('.ma-con').addClass('hidden');
        $('#manageAccountBtn').addClass('not-active');

        if (!$('#announcement').hasClass('hidden') || !$('#missionVision').hasClass('hidden')) {
            $('#announcement').addClass('hidden');
            $('#missionVision').addClass('hidden');
        } else if ($('#studentRecordBtn').hasClass('not-active') && $('#managePdoAccountBtn').hasClass('not-active')) {
            $('#announcement').removeClass('hidden');
            $('#missionVision').removeClass('hidden');
        }
    });
});