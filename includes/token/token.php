<?php
/**
 * FILE
 *      token.php
 * DEPENDENCES
 *      functions.php
 *      db_base.php
 *      config.php
 * DESCRIPTION
 *      User login token management class
 */

namespace token;

include_once  realpath(__DIR__ . '/..').'/library/db_base.php';
include_once  realpath(__DIR__ . '/..').'/functions.php';
include_once  realpath(__DIR__ . '/..').'/library/config.php';
include_once  realpath(__DIR__ . '/..').'/library/user.php';

use db\connection as db;
use config\config;
use user\user;

class token{
    private $db;
    private $config;
    private $headers;
    private $uid;
    private $uuid;
    private $authentication;
    private $user;

    function __construct(){
        session_name('entepool_session');
        session_start();
        $this->db = new db\db;
        $this->config = new config();
        $this->user = new user();
        $this->getHeaders();
    }

    /**
     * @return bool
     */
    public function getHeaders(){
        $this->headers = getallheaders();
        if((empty($this->headers['Authorization']) && empty($this->headers['authorization']))) {
            return false;
        }

        if(empty($this->headers['X-entepool-user-id'])){
            $this->setUid($this->headers['x-entepool-user-id']);
        }else{
            $this->setUid($this->headers['X-entepool-user-id']);
        }
        if(empty($this->headers['X-entepool-uuid'])){
            $this->setUuid($this->headers['x-entepool-uuid']);
        }else{
            $this->setUuid($this->headers['X-entepool-uuid']);
        }
        if(!empty($this->headers['authorization'])){
            $this->setAuthentication($this->headers['authorization']);
        }else{
            $this->setAuthentication($this->headers['Authorization']);
        }
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid){
        $this->uid = $uid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @param $authentication
     */
    public function setAuthentication($authentication){
        $this->authentication = $authentication;
    }

    /**
     * @return array
     */
    public function checkToken(){
        return $this->_check_token();
    }

    /**
     * @return array
     */
    public function getUserPermission(){
        if($this->_check_token()['status'] == 'success'){
            $this->db->db_query("select active, comment from users where id = ".$this->uid);
            $result = $this->db->getOne();

            if($result['active'] == 'N'){
                return array('status' => 'inactive', 'message' => 'Current user is inactive');
            }elseif($result['active'] == 'P'){
                return array('status' => 'unapproved', 'message' => 'Current user is unapproved');
            }elseif($result['active'] == 'Y'){
                // get user role
                $result = $this->user->getUserRole($this->uid);
                return array('status' => 'approved', 'message' => 'Current user is approved', 'roles' => $result);

            }else{
                return array('status' => 'failed', 'message' => 'User needs to login again');
            }
        }else{
            return array('status' => 'failed', 'message' => 'User needs to login again');
        }
    }

    /**
     * @return array
     */
    private function _check_token(){
        if(empty($this->authentication)){
            return array('status' => 'failed', 'message' => 'User needs to login');
        }

        $token = $this->_get_db_token();
        if(!empty($token['status'])){
            return $token;
        }

        if($this->uuid.$this->uid.$this->authentication == $token){
            return array('status' => 'success', 'message' => 'App based authentication');
        }else{
            return array('status' => 'failed', 'message' => 'User needs to login again');
        }
    }

    private function _get_db_token(){
        $this->db->db_query("SELECT * FROM token WHERE active = 'Y' and token = '".$this->uuid.$this->uid.$this->authentication."'");
        $user_token =  $this->db->getOne();
        if(empty($user_token)){
            return array('status' => 'failed', 'message' => 'User needs to login');
        }

        // see if this token expired
        $config = $this->config->getConfig();
        if($config['token_life_time'] != 0){
            $now = time()-$config['token_life_time'];
            if($now >= strtotime($user_token['created'])){
                return array('status' => 'failed', 'message' => 'Token is expired, please login again');
            }
        }

        return $user_token['token'];
    }

    /**
     * @param $uid
     * @param $uuid
     * @return array
     */
    public function setToken($uid, $uuid){
        if(empty($uid) || empty($uuid)){
            return array('status' => 'failed', 'message' => 'user info missing.');
        }

        // set other active token off is there is any
        //$this->db->db_query("UPDATE token SET active = 'N' WHERE uid = ".$uid);

        // set a new token
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $token = $uuid.$uid.$random_salt;
        $dateTime = date("Y-m-d H:i:s");
        $this->db->db_query("INSERT INTO token (`uid`,`token`,`created`) VALUE ('".$uid."', '".$token."', '".$dateTime."')");

        return array('status' => 'success', 'token' => $random_salt);
    }


    public function deleteToken(){
        $this->db->db_query("update token set active = 'N' where uid = ".$this->uid);
    }

    /**
     * @return mixed
     */
    public function getUid(){
        return $this->uid;
    }

    /**
     * route back to private function to logout
     */
    public function logout(){
        $this->_logout();
    }

    /**
     * private function to logout
     */
    private function _logout(){
        $this->db->db_query("update token set active = 'N' where token = '".$this->uuid.$this->uid.$this->authentication."'");
    }
}