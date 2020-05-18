<?php
/**
 * Created by PhpStorm.
 * User: huckw
 * Date: 3/13/2018
 * Time: 12:18 PM
 */


/**
 * FILE
 *      get_features.php
 * DEPENDENCE
 *      vehicles.php
 *      user.php
 * DESCRIPTION
 *      get all the workplace by given company id
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, X-entepool-uuid, X-entepool-user-id");

include_once 'library/user.php';
include_once 'token/token.php';
include_once 'library/vehicles.php';

use token\token;
use vehicles\vehicles;
use user\user;
$user = new user();
$locations = new vehicles();
$token = new token();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}

$data = $locations->getFeatureList();

echo json_encode(array('status' => 'success', 'data' => $data));
exit;
