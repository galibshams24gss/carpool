<?php
/**
 * FILE
 *      icomp_reset_password.php
 * DEPENDENCE
 *      user.php
 *      token.php
 * DESCRIPTION
 *      Reset password process
 *      1) check if the validation hex is valid, and also get user info.
 *      2) reset password once user info is validated
 */

include_once 'library/user.php';
include_once 'token/token.php';
use user\user;
use token\token;

$user = new user();

$request_body = file_get_contents('php://input');
if(!empty($request_body)) {
    $submit = json_decode($request_body);
    if (empty($submit)) {
        echo '[]';
        exit;
    }

    if(!empty($submit->hex)){
        $url_validate = $user->checkActiveUrlByHex($submit->hex);
        if(!$url_validate){
            echo json_encode(array('message' => 'The one time url is no longer valid, please use password reset to resend a new one.', 'status' => 'failed'));
            exit;
        }

        $user->setPassword($url_validate['con_uid'], $submit->password);

        // since this is done, we need to de-active the hex
        $user->deActiveHex($submit->hex);

    }elseif($submit->request_password){
        $token = new token();
        $token_result = $token->checkToken();
        if($token_result['status'] != 'success'){
            echo json_encode($token_result);
            exit;
        }
        $uid = $token->getUid();
        $result = $user->passwordCheck($uid, $submit->request_password);
        if($result){
            $user->setPassword($uid, $submit->password);
        }else{
            $status = array('message' => 'You original password does not match our record, please try again', 'status' => 'failed');
            echo json_encode($status);
            exit;
        }
    }

    $status = array('message' => 'Password has been reset.', 'status' => 'success');
    echo json_encode($status);
    exit;
}