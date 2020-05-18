<?php
/**
 * Created by PhpStorm.
 * User: huckw
 * Date: 2/9/2018
 * Time: 1:10 PM
 */

/**
 * FILE
 *      get_vehicles.php
 * DEPENDENCE
 *      locations.php
 *      user.php
 * DESCRIPTION
 *      get cars based on pool
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
$vehicles = new vehicles();
$token = new token();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}
$uid = $token->getUid();

$data = $vehicles->getVehicles($_GET['id']);
echo json_encode(array('status' => 'success', 'data' => $data));
exit;
