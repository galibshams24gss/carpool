// app.factory('entePool', function entePoolFactory($http) {
//   return 'a12345654321x';
// });

app.factory('entePool', ['$http', function ($http) {

    var entePool = {};

    entePool.getConfig = function () {
        return { headers: { 'X-entepool-uuid': sessionStorage.ip, 'Authorization': sessionStorage.token, 'X-entepool-user-id': sessionStorage.user_id } }
    }
 
    // entePool.checkError = function (status) {
    //     if (status == 403) {
    //         deleteCookie('userToken');
    //         deleteCookie('email');
    //         window.location.href = DivvyEntAppHome + 'Account/Login';
    //     }
    // }

    entePool.handleError = function (funcname, data, status) {
        if (status == "403") {
            alert("Your session is broken, please login again.");
        }
    }

    entePool.postDataCall = function (url, postData, callback) {
        $http.post(url, postData)
        .then(function (result) {
            callback(result.data);
        }, function () {
            callback('error');
            entePool.handleError('postDataCall', data, status);
        });
    }

    entePool.postDataConfigCall = function (url, postData, callback) {
        $http.post(url, postData, entePool.getConfig())
        .then(function (result) {
            callback(result.data);
        }, function () {
            callback('error');
            entePool.handleError('postDataConfigCall', data, status);
        });
    }


    entePool.getDataConfigCall = function (url,callback) {
        $http.get(url, entePool.getConfig())
        .then(function (result) {
            callback(result.data);
        }, function () {
            callback('error');
            entePool.handleError('getDataConfigCall', data, status);
        });
    }

    return entePool;

}]);