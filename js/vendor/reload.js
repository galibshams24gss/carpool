var hazReload_address = '';
var checkReload = function () {
    $.ajax({
        type: 'GET',
        url: "getversion.php",
        success: function (data) {
            var key = location.host + "-" + hazReload_address;
            var oldV = localStorage.getItem(key);
            if (oldV != data) {
                localStorage.setItem(key, data);
                location.reload(true);
            }
        },
        error: function (exception) {
            /*if (cbkError) cbkError(formatException(exception));
            else*/
            console.log(formatException(exception));
        }
    });
}

$().ready(function () { checkReload();
    if (checkReload == undefined) location.reload(true)
    else console.log('cache is OK');
});