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
        requestReady = true;
    });
    
    return promise;
}

// array of messages
var msglist = [];
// index of the first element on the page
var activePageOffset = 0;

// get fresh list from server
function update(){
    var promise = ajaxRequest(usertype+'-update', {});
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
    var target = $('#page-control li:nth-child(2)');
    for(i=0; i<newPageCount-1; ++i){
        $('<li>').append(
            $('<a>')
            .attr('href', '#')
            .text((i*10+1)+'-'+(i+1)*10)
            .attr('onclick', 'displayPage('+i*10+')')
        )
        .insertBefore(target);
    }
    if (msglist.length > 0){
        $('<li>')
        .append(
            $('<a>')
            .attr('href', '#')
            .text(((newPageCount-1)*10+1)+'-'+msglist.length)
        )
        .attr('onclick', 'displayPage('+(newPageCount-1)*10+')')
        .insertBefore(target);
    } else {
        $('<li>')
        .append(
            $('<a>')
            .attr('href', '#')
            .text('0-0')
        )
        .insertBefore(target);
    }
    // display 1st page. this function is to be defined for each module
    displayPage(0);
}

// date formatting settings
var monthStr = ["Янв","Фев","Марта","Апр","Мая","Июня","Июля","Авг","Сен","Окт","Ноя","Дек"];

// display page with given offset
function displayPage(offset){
    // clearing messages
    $('#msg-board > *').remove();
    
    // setting active page
    activePageOffset = offset;
    $('#page-control > li').removeClass('active');
    $('#page-control > li:nth-child('+(Math.trunc(offset/10)+2)+')').addClass('active');
    
    var board = $('#msg-board');
    
    // displaying 10 or less
    var upLimit = (9 + offset >= msglist.length) ? (msglist.length - offset) : 10;
    for(i=0; i<upLimit;++i){
        var datetime = new Date(msglist[i+offset].msg_timestamp*1000);
        var day = datetime.getDate();
        var month = monthStr[datetime.getMonth()];
        var year = datetime.getFullYear();
        var hours = datetime.getHours();
        if (hours < 10) hours = "0" + hours;
        var minutes = datetime.getMinutes();
        if (minutes < 10) minutes = "0" + minutes;
        
        var timeString = day + " " + month + " " + year + "г. в " + hours + ":" + minutes;
        // call to specific construct functions for each module
        board.append(createMsgPanel(msglist[i+offset], timeString));
    }
}

// try to switch to previous page
function prevPage(){
    if (activePageOffset >= 10){
        displayPage(activePageOffset - 10);
    }
}

// try to switch to next page
function nextPage(){
    if (activePageOffset + 10 < msglist.length){
        displayPage(activePageOffset + 10);
    }
}

// calling update after page loads
$(document).ready(function(){
    update();
});

// should be defined for each module
var usertype = "default";