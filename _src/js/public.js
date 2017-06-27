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
    
    var promise = ajaxRequest('comment', {
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

// display page with given offset
function displayPage(offset){
    // clearing messages
    $('#msg-board > *').remove();
    
    var board = $('#msg-board');
    // displaying 10 or less
    var upLimit = (9 + offset >= msglist.length) ? (msglist.length - offset) : 10;
    for(i=0; i<upLimit;++i){
        var datetime = new Date(msglist[i+offset].msg_timestamp*1000);
        var day = datetime.getDate();
        var month = datetime.getMonth();
        var year = datetime.getFullYear();
        var hours = datetime.getHours();
        var minutes = datetime.getMinutes();
        
        var timeString = day + "." + month + "." + year + " " + hours + ":" + minutes;
        board.append(
            $('<div>')
            .addClass('panel panel-primary')
            .append(
                $('<div>')
                .addClass('panel-heading')
                .append(
                    $('<h3>')
                    .addClass('panel-title').text(msglist[i+offset].author + " ("+timeString+")")
                )
            )
            .append(
                $('<div>')
                .addClass('panel-body')
                .text(msglist[i+offset].msg)
            )
        );
    }
}