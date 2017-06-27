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