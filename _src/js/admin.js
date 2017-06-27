// Admin only functionality.
var effectTimeout = 2500;

// discard chosen comment (delete from database)
function discardComment(commentId){
    var promise = ajaxRequest('delete', {
        comment_id: commentId
    });
    if (promise)
        promise.done(function(dataObj){
            var data = JSON.parse(dataObj);
            if (data.error){
                console.log(data.text);
                return;
            }
            // success
            $('#msg-board #comment-'+commentId).addClass('panel-danger').fadeOut(effectTimeout).remove();
            setTimeout(function(){
                update();
            }, effectTimeout);
        });
}

// approve comment
function approveComment(commentId){
    var promise = ajaxRequest('approve',{
        comment_id: commentId
    });
    if (promise)
        promise.done(function(dataObj){
            var data = JSON.parse(dataObj);
            if (data.error){
                console.log(data.text);
                return;
            }
            // success
            $('#msg-board #comment-'+commentId).addClass('panel-success').fadeOut(effectTimeout).remove();
            setTimeout(function(){
                update();
            }, effectTimeout);
        });
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
        var comment_id = msglist[i+offset].comment_id;
        
        var timeString = day + "." + month + "." + year + " " + hours + ":" + minutes;
        board.append(
            $('<div>')
            .addClass('panel panel-primary')
            .attr('id', 'comment-'+comment_id)
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
            .append(
                $('<div>')
                .addClass('panel-footer')
                .append(
                    $('<button>')
                    .attr('type', 'button')
                    .addClass('btn btn-primary')
                    .text('Одобрить сообщение')
                    .attr('onclick', 'approveComment('+comment_id+')')
                )
                .append(
                    $('<button>')
                    .attr('type', 'button')
                    .addClass('btn btn-warning')
                    .text('Удалить сообщение')
                    .attr('onclick', 'discardComment('+comment_id+')')
                )
            )
        );
    }
}