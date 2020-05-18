<?php
/**
 * FILE
 *      process_vehicle_pool.php
 * DEPENDENCE
 *      token.php
 *      user.php
 *      vehicles.php
 * DESCRIPTION
 *      Assign workplace to given user API
 */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, Content-Type, X-icomp-uuid, X-icomp-user-id");

include_once 'library/user.php';
include_once 'token/token.php';
include_once 'library/vehicles.php';

use token\token;
use vehicles\vehicles;
use user\user;

$user = new user();
$vehicles = new vehicles();
$token = new token();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}

$uid = $token->getUid();
$isAdmin = $user->isAdmin($uid, 'Company Admin');
if(!$isAdmin){
    echo json_encode(array('status' => 'failed', 'message' => 'you do not have permission to access this page'));
    exit;
}

$request_body = file_get_contents('php://input');
if(!empty($request_body)) {
    $submit = json_decode($request_body);
    if (empty($submit)) {
        echo '[]';
        exit;
    }


    if(!empty($submit->id) && !empty($submit->car_id)){
        // assign the vehicle to pool
        // first to check if the same record has already been added
        $isExist = $vehicles->ifCarLocationExist($submit->car_id, $submit->id);

        if($isExist){
            echo json_encode(array('status' => 'failed', 'message' => 'Same vehicle has been assigned already.'));
            exit;
        }else{
            $vehicles->initRecord(array(
              'location_id' => $submit->id,
              'vid' => $submit->car_id
            ), 'entepool_vehicle_location');

            echo json_encode(array('status' => 'success', 'message' => 'Vehicle has been assigned successfully.'));
            exit;
        }
    }else{
        echo json_encode(array('status' => 'failed', 'message' => 'System error, please contact system admin for further assistant.'));
    }
}