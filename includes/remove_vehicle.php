<?php
/**
 * Created by PhpStorm.
 * User: huckw
 * Date: 2/9/2018
 * Time: 1:10 PM
 */

/**
 * FILE
 *      remove_vehicle.php
 * DEPENDENCE
 *      vehicles.php
 *      user.php
 * DESCRIPTION
 *      get cars based on car id
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, X-entepool-uuid, X-entepool-user-id");

include_once 'token/token.php';
include_once 'library/vehicles.php';
use token\token;
use vehicles\vehicles;

$vehicles = new vehicles();
$token = new token();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}

$vehicles->removeVehicleFromPool($_GET['car_id'], $_GET['id']);
echo json_encode(array('status' => 'success', 'message' => 'Vehicle has been removed from this pool successfully.'));
exit;