// Public only functionality.

// Display modal
function newComment(){
    $('#comment-modal').modal({
        keyboard: false,
        backdrop: true
    });
}

// Validate data and send request
function sendComment(){
    // checking name
    var name = $('#name').val();
    if (!name.match(/^[a-zA-Z0-9а-яА-ЯеЁ\s]+$/g) || name.length < 3 || name.length > 255){
        $('#name-group').addClass('has-error');
        $('#name').popover();
        return;
    }
    // checking email
    var email = $('#email').val();
    if (!email.match(/^[\w.]+@\w+\.\w+$/g) || email.length < 5 || email.length > 254){
        $('#email-group').addClass('has-error');
        return;
    }
    var text = $('#text').val();
    if (text.length < 3 || text.length > 512){
        $('#text-group').addClass('has-error');
        return;
    }
}

// Reset effect of error on input groups
function resetValState(id){
    $(id).removeClass('has-error');
}