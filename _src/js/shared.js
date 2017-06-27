// Shared functionality.

// true - ready for new request
// false - waiting for previous to complete
var requestReady = true;

// perform AJAX request to server
function ajaxRequest(type, data){
    if (requestReady == false) return false;
    obj = data;
    obj['request'] = type;
    // POST request to server
    requestReady = false;
    
    // Return promise
    var promise = $.post('api.php', obj)
    .always(function(){ 
        requestReady=true;
    });
    
    return promise;
}

var msglist = [];

// get fresh list from server
function update(){
    var promise = ajaxRequest('update', {});
    if (promise)
        promise.done(function(dataObj){
            var data = JSON.parse(dataObj);
            if (data.error){
               console.error(data.text);
               return;
            }
            msglist = data.data;
            refreshList();
        });
}

// update pages
function refreshList(){
    // clearing pages
    var pageCount = $('#page-control li').length-3;
    for(i=0; i<pageCount; ++i){
        $('#page-control li:nth-child(2)').remove();
    }
    // adding pages
    var newPageCount = Math.ceil(msglist.length / 10.0);
    var target = $('#page-control li:first');
    for(i=0; i<newPageCount-1; ++i){
        $('<li>').append(
            $('<a>')
            .attr('href', '#')
            .text((i*10+1)+'-'+(i+1)*10)
            .attr('onclick', 'displayPage('+i*10+')')
        )
        .insertAfter(target);
    }
    $('<li>').append($('<a>').attr('href', '#').text(((newPageCount-1)*10+1)+'-'+msglist.length)).attr('onclick', 'displayPage('+(newPageCount-1)*10+')').insertAfter(target);
    
    // display 1st page
    displayPage(0);
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

// calling update after page loads
$(document).ready(function(){
    update();
});