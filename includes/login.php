<?php
/**
 * FILE
 *      icomp_login.php
 * DEPENDENCE
 *      functions.php
 *      db_connect.php
 *      token.php
 * DESCRIPTION
 *      To process login from both web and mobile
 */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, X-Requested-With, Content-Type, X-icomp-uuid, X-icomp-user-id");

include_once 'functions.php';
include_once 'token/token.php';
include_once 'library/user.php';
include_once 'library/logging.php';
use token\token;
use user\user;

$user = new user();
$dateTime = date("Y-m-d H:i:s");
$request_body = file_get_contents('php://input');
$logger = new Logger('info');

if(!empty($request_body)) {
    $submit = json_decode($request_body);
    if (empty($submit)) {
        echo '[]';
        exit;
    }

    $logger->info($user->datetime.' user login: '.$submit->email);
    $login_data = login($submit->email, $submit->password, $mysqli);
    if ($login_data) {
        // Login success
        if(!empty($submit->ip)){
            $stmt_answers = "INSERT INTO `entepool_user_tracking`(`username`,`device`,`ip`,`datetime`) VALUES ('".$submit->email."', '".$submit->browser."', '".$submit->ip."', '".$dateTime."')";

            $token = new token();
            $token_code = $token->setToken($login_data['user_id'], $submit->ip);
            if($token_code['status'] == 'success'){
                $session_array = array(
                    'status'        => "success",
                    'user_id'       => $login_data['user_id'],
                    'firstname'     => $login_data['firstname'],
                    'surname'       => $login_data['surname'],
                    'token'         => $token_code['token'],
                    'permission'    => $login_data['permission'],
                    'roles'         => $login_data['roles'],
                    'error'         => NULL
                );
                $logger->info($user->datetime.' user login on app: '.$submit->email. ' success');
            }else{
                $logger->info($user->datetime.' user login on app: '.$submit->email. ' register token failed');
                $session_array = array(
                    'status'        => "failed",
                    'message'       => "register token failed"
                );
            }
        }else{
            $stmt_answers = "INSERT INTO `entepool_user_tracking`(`username`,`device`,`ip`,`datetime`) VALUES ('".$submit->email."', '".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".$dateTime."')";
            $token = new token();
            $token_code = $token->setToken($login_data['user_id'], $_SERVER['REMOTE_ADDR']);
            $session_array = array(
                'status'        => "success",
                'user_id'       => $login_data['user_id'],
                'firstname'     => $login_data['firstname'],
                'surname'       => $login_data['surname'],
                'token'         => $token_code['token'],
                'permission'    => $login_data['permission'],
                'roles'         => $login_data['roles'],
                'ip'            => $_SERVER['REMOTE_ADDR'],
                'error'         => NULL
            );
            $logger->info($user->datetime.' user login on web: '.$submit->email. ' success');
        }
        $stmt_answers = $mysqli->query($stmt_answers);
        echo json_encode($session_array);
        exit;
    } else {
        $logger->info($user->datetime.' user login: '.$submit->email. ' failed');
        // Login failed
        echo json_encode(array("status" => "failed", "message" => "Incorrect email or password, please try again."));
        exit;
    }
}
