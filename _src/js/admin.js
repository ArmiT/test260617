// Admin only functionality.

usertype = "admin";
var effectTimeout = 750;

// discard chosen comment (delete from database)
function discardComment(commentId){
    var promise = ajaxRequest('admin-delete', {
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
            $('#msg-board #comment-'+commentId).addClass('panel-danger').fadeOut(effectTimeout);
            setTimeout(function(){
                $('#msg-board #comment-'+commentId).remove();
                update();
            }, effectTimeout);
        });
}

// approve comment
function approveComment(commentId){
    var promise = ajaxRequest('admin-approve',{
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
            $('#msg-board #comment-'+commentId).addClass('panel-success').fadeOut(effectTimeout);
            setTimeout(function(){
                $('#msg-board #comment-'+commentId).remove();
                update();
            }, effectTimeout);
        });
}

// construct function for elements of a page
function createMsgPanel(elementData, timeString){
    return $('<div>')
        .addClass('panel panel-primary')
        .attr('id', 'comment-'+elementData.comment_id)
        .append(
            $('<div>')
            .addClass('panel-heading')
            .append(
                $('<h3>')
                .addClass('panel-title').text(elementData.author + "(" + elementData.email + ")" + " - " + timeString)
            )
        )
        .append(
            $('<div>')
            .addClass('panel-body')
            .text(elementData.msg)
        )
        .append(
            $('<div>')
            .addClass('panel-footer')
            .append(
                $('<button>')
                .attr('type', 'button')
                .addClass('btn btn-primary')
                .text('Одобрить сообщение')
                .attr('onclick', 'approveComment('+elementData.comment_id+')')
            )
            .append(
                $('<button>')
                .attr('type', 'button')
                .addClass('btn btn-warning')
                .text('Удалить сообщение')
                .attr('onclick', 'discardComment('+elementData.comment_id+')')
            )
        );
}