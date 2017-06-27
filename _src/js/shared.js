// Shared functionality.

// true - ready for new request
// false - waiting for previous to complete
var requestReady = true;

// perform AJAX request to server
function ajaxRequest(type, data, callback){
    if (requestReady == false) return false;
    obj = data;
    obj['request'] = type;
    // POST request to server
    requestReady = false;
    $.post('api.php', obj, function(encData,status){
        var dataObj = JSON.parse(encData);
        var timestamp = dataObj.timestamp;
        switch(status){
            case 200:
                callback(dataObj.data);
                break;
            case 400:
                var errorMsg = dataObj.text;
                var errorCode = dataObj.error;
                // display specific error
                break;
            case 500:
                // display general error
                break;
        }
        requestReady = true;
    });
}