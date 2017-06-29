// Public only functionality.

usertype = "public";

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
    
    var promise = ajaxRequest('public-comment', {
        name: name,
        email: email,
        text: text
    });
    if (promise)
        promise.done(function(dataObj){
            var data = JSON.parse(dataObj);
            if (data.error){
                console.error(data.text);
                return;
            }
            $('#comment-modal').modal('hide');
            $('#thx-modal').modal('show');
        });
}

// Reset effect of error on input groups
function resetValState(id){
    $(id).removeClass('has-error');
}

// construct function for elements of a page
function createMsgPanel(elementData, timeString){
    return $('<div>')
        .addClass('panel panel-primary')
        .append(
            $('<div>')
            .addClass('panel-heading')
            .append(
                $('<h3>')
                .addClass('panel-title').text("Пользователь " + elementData.author + " написал(а) " + timeString)
            )
        )
        .append(
            $('<div>')
            .addClass('panel-body')
            .text(elementData.msg)
        );
}