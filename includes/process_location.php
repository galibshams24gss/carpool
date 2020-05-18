<?php
/**
 * Created by PhpStorm.
 * User: huckw
 * Date: 2/8/2018
 * Time: 11:45 AM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, X-entepool-uuid, X-entepool-user-id");

include_once 'library/user.php';
include_once 'token/token.php';
include_once 'library/locations.php';

use token\token;
use locations\locations;
use user\user;
$user = new user();
$locations = new locations();
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
    $submit = json_decode($request_body, true);
    if (empty($submit)) {
        echo '[]';
        exit;
    }

    if(empty($submit['id'])){
        // add a new location
        if(!empty($submit['pool_name']) && !$locations->checkWorkplaceName($submit['pool_name'])){
            echo json_encode(array('status' => 'failed', 'message' => 'Pool name is already been used, please choose another pool name.'));
            exit;
        }
        $location_id = $locations->initRecord(array(
            'pool_name' => $submit['pool_name'],
            'address' => $submit['address'],
            'lat'     => $submit['Latitude'],
            'lon'     => $submit['Longitude'],
            'access_information'  => $submit['access_information'],
            //'status'  => $submit['status'],
            'created' => $locations->datetime,
        ), 'entepool_location');

        foreach($submit['super_user'] as $super){
            $u = $user->getUserByEmail($super['email']);
            if(empty($u)){
                // new user
                $u['id'] = $user->initUserByEmail($super['email']);
                $user->fullyActiveUserById($u['id']);
                $hex = $user->createActiveUrl($u['id'], 'one_time_url_life_time');
                $user->sendOneTimeUserActiveEmail(array(
                  'email' => $submit->email,
                  'hex' => $hex
                ));
                $user->addUserRole($u['id'], 3); // 3 means general user
            }
            $user->addLocationSuperUser($u['id'], $location_id);
        }
    }else{
        $buffer = array(
            'id' => $submit['id'],
            'pool_name' => $submit['pool_name'],
            'pool_id' => $submit['pool_id'],
            'address' => $submit['address'],
            'status'  => $submit['status'],
            'access_information'  => $submit['access_information'],
            'modify'  => $locations->datetime,
            'lat'     => $submit['lat'],
            'lon'     => $submit['lon'],
            'place_id'=> $submit['place_id']
        );
        $locations->updateDetails($buffer, 'entepool_location');
    }

    echo json_encode(array('status' => 'success', 'message' => 'Form has been submitted successfully'));
    exit;
}