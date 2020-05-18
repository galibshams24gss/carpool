app.controller('configFormsController', ['$scope', '$http', '$uibModal', '$window', '$routeParams', function($scope, $http, $modal, $window, $routeParams) {


    var order = 0;
    $scope.showTextFieldSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showTextAreaSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = true;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showRadioSection = function () {
        $scope.showAnswer = true;
        $scope.showSize = false;
        $scope.showWeighting = true;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
        $scope.answerList = [];
    }
    $scope.showCheckboxSection = function () {
        $scope.showAnswer = true;
        $scope.showSize = false;
        $scope.showWeighting = true;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
        $scope.answerList = [];
    }
    $scope.showDropDownSection = function () {
        $scope.showAnswer = true;
        $scope.showSize = false;
        $scope.showWeighting = true;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
        $scope.answerList = [];
    }
    $scope.showDisplayTextSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = true;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = false;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showImageSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = true;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showAttachmentSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = false;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = true;
    }
    $scope.showDateSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = true;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showQRSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = true;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    $scope.showLocationSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = false;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = true;
        $scope.showAttachment = false;
    }
    $scope.showEmailSection = function () {
        $scope.showAnswer = false;
        $scope.showSize = false;
        $scope.showWeighting = false;
        $scope.showTextSize = false;
        $scope.showAreaSize = false;
        $scope.showEmail = true;
        $scope.showMandatory = true;
        $scope.showDate = false;
        $scope.showQR = false;
        $scope.showImageDesc = false;
        $scope.showLocation = false;
        $scope.showAttachment = false;
    }
    
    $scope.changeType = function (type) {
        switch (type) {
            case 'Text Field':
                $scope.showTextFieldSection();
                break;
            case 'Text Area':
                $scope.showTextAreaSection();
                break;
            case 'Radio':
                $scope.showRadioSection();
                break;
            case 'Checkbox':
                $scope.showCheckboxSection();
                break;
            case 'Drop Down':
                $scope.showDropDownSection();
                break;
            case 'Display Text':
                $scope.showDisplayTextSection();
                break;
            case 'Image upload':
                $scope.showImageSection();
                break;
            case 'Attachment upload':
                $scope.showAttachmentSection();
                break;
            case 'Date Field':
                $scope.showDateSection();
                break;
            case 'QR code':
                $scope.showQRSection();
                break;
            case 'Location':
                $scope.showLocationSection();
                break;
            case 'Email':
                $scope.showEmailSection();
                break;
        }
    };

    $scope.data = [{
            id: 1,
            reportname: 'report1',
            order: 1,
            comments: 'na'
        }, {
            id: 2,
            reportname: 'report2',
            order: 2,
            comments: 'test'
        }, {
            id: 3,
            reportname: 'report4',
            order: 3,
            comments: 'test'
        }, {
            id: 4,
            reportname: 'report3',
            order: 4,
            comments: 'test'
        }, {
            id: 5,
            reportname: 'report3',
            order: 5,
            comments: 'na'
        }, {
            id: 6,
            reportname: 'report4',
            order: 6,
            comments: 'test'
    }];



    $scope.moveItem = function(item, dir) {
        var index = $scope.data.indexOf(item);
        if (dir === 'up') {
            $scope.data.splice(index - 1, 2, item, $scope.data[index - 1]);
            $scope.data[index - 1].order = index;
            $scope.data[index].order = index + 1;
        } else {
            $scope.data.splice(index, 2, $scope.data[index + 1], item);
            $scope.data[index + 1].order = index + 2;
            $scope.data[index].order = index + 1;
        }
    }


    $scope.addAnswer = function (answer, score) {
        var answerData = {content: answer, score: score};
        $scope.answerList.push(answerData);
        $scope.formData.answer = '';
        $scope.formData.score = '';
    };


    $scope.check_admin = true;
    $scope.adminListArray = [];
    $scope.listAdmin = function () {
        $http.get(getAdminUserObj)
            .then(function successCallback(result) {
                if(result.data.status !== undefined && result.data.status !== null) {
                    if (result.data.status !== 'failed') {
                        $scope.administrationUsers = result.data.data;
                        $scope.itemsPerPage = 25;
                        $scope.currentPage = 1;
                        $scope.totalItems = result.data.data.length;
                    } else {
                        $scope.dlgAlert(result.data.message);
                    }
                }
            }, function errorCallback(response) {
                $scope.dlgAlert(response.data.message);
            });
    };

    $scope.listAdmin();

    $scope.populateForm = function(index) {
        $scope.single_user = $scope.administrationUsers[index];
        $scope.edit_admin = $scope.single_user.admin;
    };

    $scope.userAction = function(email, action) {
        var postData = '{"email":"' + email + '", "action":"' + action + '"}';
        $http.post(processUser, postData)
        .then(function(result) {
            if(result.status !== undefined && result.status !== null){
                if (result.status === 'failed') {
                    if(result.message){
                        $scope.dlgAlert(result.data.message);
                    } else {
                        $scope.dlgAlert('Submission failed, please try again');
                    }
                }else{
                    $scope.dlgAlert('Thank you, the user status has been updated.');
                    $scope.listAdmin();
                }
            }
        },
        function() {
            $scope.dlgAlert('Submission failed, please try again.');
        });
    };

    $scope.sendFormData = function(formData) {
        console.log(formData)
    }
    
    $scope.addAdmin = function(admin) {
        $scope.adminList = "";
        $scope.adminListArray.push(admin);
    }
    
    $scope.deleteAdmin = function(admin) {
        for(var i = 0; i < $scope.adminListArray.length; i++) {
            if ($scope.adminListArray[i] === admin) {
                $scope.adminListArray.splice(i, 1);
            }
        }
    }
    
    $scope.submitAdminList = function() {
        $scope.submitted = true;
        var postData = '{"email":"' + $scope.adminListArray + '", "action":"addAdminUser"}';
        $http.post(processUser, postData)
        .then(function (result) {
            $scope.submitted = false;
            $('#addAdminModal').modal('hide');
            if(result.data.status !== undefined && result.data.status !== null){
                if (result.data.status === 'failed') {
                    if(result.data.message){
                        $scope.dlgAlert(result.data.message);
                    } else {
                        $scope.dlgAlert('Submission failed, please try again');
                    }
                }else{
                   
                    $scope.adminListArray = [];
                    $scope.listAdmin();
                    $scope.dlgAlert('Thank you, new admin user has been added.');
                }
            }
        },
        function () {
            $scope.dlgAlert('Submission failed, please try again.');
        });
    };

    $scope.dlgAlert= function (message) {
        $scope.dlgData = {};
        $scope.dlgData.result = message;

        var modalInstance = $modal.open({
            templateUrl: './includes/dlgAlert.html',
            backdrop: true,
            windowClass: 'modal',
            controller: function ($scope, $location, $uibModalInstance, $route, $log, data) {
                $scope.failMessage = data.result;
                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            resolve: {
                data: function () {
                    return $scope.dlgData;
                }
            }
        });
    };
}]);