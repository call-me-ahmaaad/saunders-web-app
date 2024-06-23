$(document).ready(function() {
    $('#changePasswordBtn').on('click', function() {
        $('#passwordPopup').addClass('show');
    });

    $('#closePasswordPopup').on('click', function() {
        $('#passwordPopup').removeClass('show');
    });

    $('#changeAvatarBtn').on('click', function() {
        $('#avatarPopup').addClass('show');
    });

    $('#closeAvatarPopup').on('click', function() {
        $('#avatarPopup').removeClass('show');
    });

    $(window).on('click', function(event) {
        if (event.target == $('#passwordPopup')[0]) {
            $('#passwordPopup').removeClass('show');
        }
        if (event.target == $('#avatarPopup')[0]) {
            $('#avatarPopup').removeClass('show');
        }
    });
});
