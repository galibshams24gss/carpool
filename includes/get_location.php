<?php
/**
 * FILE
 *      get_locations.php
 * DEPENDENCE
 *      locations.php
 *      user.php
 * DESCRIPTION
 *      get all the workplace by given company id
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

$data = $locations->getLocation($_GET['id']);

echo json_encode(array('status' => 'success', 'data' => $data));
exit;
