$(function() {
    $("#flash-message-danger").delay('500').slideDown('slow');
    $('#flash-message-danger').delay('5000').slideUp('slow');
    $('#flash-message-danger').on('click', function() {
        $('#flash-message-danger').fadeOut();
    })
})

$(function() {
    $("#flash-message-success").delay('500').slideDown('slow');
    $('#flash-message-success').delay('10000').slideUp('slow');
    $('#flash-message-success').on('click', function() {
        $('#flash-message-success').fadeOut();
    })
})
