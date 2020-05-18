<!DOCTYPE html>
<html lang="en" ng-app="App">

<head>
    <title>entepool</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <base href="/">
    <link rel="icon" type="image/jpg" href="./favicon.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/timelineScheduler.styling.css" type="text/css">
    <link rel="stylesheet" href="css/timelineScheduler.css" type="text/css">
    <link rel="stylesheet" href="css/angucomplete-alt.css" type="text/css">
    <link rel="stylesheet" href="node_modules/angularjs-bootstrap-datetimepicker/src/css/datetimepicker.css" type="text/css">
    <!-- <link rel="stylesheet" href="scheduler_resources/jqwidgets/styles/jqx.base.css" type="text/css"> -->
    <link rel="stylesheet" href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//cdn.rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.css" rel="stylesheet">
</head>
<body ng-controller="mainController" ng-cloak>
<?php
include_once 'template/includes/navigation.inc';
?>
<div class="container main-wrapper"><ng-view></ng-view></div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/api.js"></script>
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/vendor/jquery.circliful.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="js/vendor/popper.min.js"></script>
<script src="js/vendor/angular.min.js"></script>
<script type="text/javascript" src="js/vendor/question_tree.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/indrimuska/angular-moment-picker/master/dist/angular-moment-picker.min.js"></script>
<script src="js/vendor/adapter.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<!-- <script src="js/vendor/timelineScheduler.js"></script> -->
<script src="js/vendor/ui-bootstrap-tpls-2.5.0.min.js"></script>
<script src="js/vendor/angular-route.min.js"></script>
<script src="js/vendor/angular.ui.unique.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-sanitize.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-animate.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2V9tZiVAGEyxmpjN4iBtXiIdJLZzVNzI&libraries=places"></script>
<script src="js/vendor/angucomplete-alt.min.js"></script>
<script src="node_modules/moment/moment.js"></script>
<script src="js/vendor/timelineScheduler.js"></script>
<script src="js/vendor/ng-weekly-scheduler.js"></script>
<script src="js/vendor/daypilot-all.min.js"></script>

<script src="js/controller_router.js"></script>
<script src="js/factories.js"></script>
<script src="js/controller_login.js"></script>
<script src="js/controller_home.js"></script>
<script src="js/controller_carPool.js"></script>
<script src="js/controller_vehicle.js"></script>
<script src="js/controller_search.js"></script>



<script src="node_modules/angular-date-time-input/src/dateTimeInput.js"></script>
<script src="node_modules/angularjs-bootstrap-datetimepicker/src/js/datetimepicker.js"></script>
<script src="node_modules/angularjs-bootstrap-datetimepicker/src/js/datetimepicker.templates.js"></script>
<script src="js/vendor/instascan.min.js"></script>
<script src="js/vendor/qrcodelib.js"></script>
<script src="js/vendor/webcodecamjquery.js"></script>
<script src="js/vendor/sha512.js"></script>
<script src="js/vendor/reload.js"></script>
</body>
</html>

