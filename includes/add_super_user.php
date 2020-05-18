<?php
/**
 * FILE
 *      add_super_user.php
 * DEPENDENCE
 *      icomp_user.php
 * DESCRIPTION
 *      add super user to the current location
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, Content-Type, X-icomp-uuid, X-icomp-user-id");

include_once 'library/user.php';
include_once 'library/locations.php';
include_once 'token/token.php';
use token\token;
use user\user;
use locations\locations;
$user = new user();
$token = new token();
$location = new locations();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}

$uid = $token->getUid();
if(!$user->isAdmin($uid, 'Company Admin')){
    echo json_encode(array('status' => 'failed', 'message' => 'You do not have permission to process this action.'));
    exit;
}

$request_body = file_get_contents('php://input');
if(!empty($request_body)) {
    $submit = json_decode($request_body);
    if (empty($submit)) {
        echo '[]';
        exit;
    }


    $u = $user->getUserByEmail($submit->email);
    if(empty($u)){
        // new user
        $u['id'] = $user->initUserByEmail($submit->email);
        $user->fullyActiveUserById($u['id']);
        $hex = $user->createActiveUrl($u['id'], 'one_time_url_life_time');
        $user->sendOneTimeUserActiveEmail(array(
          'email' => $submit->email,
          'hex' => $hex
        ));
        $user->addUserRole($u['id'], 3); // 3 means general user
    }
    $result = $user->addLocationSuperUser($u['id'], $submit->id);
    $data = $location->getLocation($submit->id);
    if(!$result){
        echo json_encode(array('status' => 'failed', 'message' => 'User has already been added.', 'data' => $data));
        exit;
    }
    echo json_encode(array('status' => 'success', 'message' => 'User has been added successfully.', 'data' => $data));
    exit;
}