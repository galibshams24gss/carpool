<?php
/**
 * FILE
 *      icomp_get_admin_user.php
 * DEPENDENCE
 *      icomp_assignment.php
 *      icomp_db_base.php
 *      icomp_user.php
 * DESCRIPTION
 *      get form data by given assignment
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, X-icomp-uuid, X-icomp-user-id");

include_once 'library/user.php';
include_once 'token/token.php';

use token\token;
use user\user;
$user = new user();
$token = new token();

$token_result = $token->checkToken();
if($token_result['status'] != 'success'){
    echo json_encode($token_result);
    exit;
}

$uid = $token->getUid();
if(!$user->isAdmin($uid, 'Company Admin')){
    echo json_encode(array('status' => 'failed', 'message' => 'You do not have permission to view this page.'));
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
    if(!empty($u)){
        echo json_encode(array('status' => 'success', 'data' => $u));
        exit;
    }else{
        echo json_encode(array('status' => 'success', 'data' => array(
          'email' => $submit->email
        )));
        exit;
    }
}