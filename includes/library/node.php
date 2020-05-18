<?php
/**
 * FILE
 *      icomp_config.php
 * DEPENDENCES
 *      functions.php
 *      icomp_db_base.php
 *      class_icomp_email.php
 *      PHPMailerAutoload.php
 * DESCRIPTION
 *      Custom PHP API function for getting and processing configurations
 */

namespace node;

include_once 'base.php';
include_once 'user.php';

use user\user;
use base\base;

/**
 * Class icomp_node
 *
 * @package icomp_node
 */
class node extends base
{
    private $user;

    /**
     * icomp_user constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->user = new user();
    }

    /**
     * @param $id
     * @return array|bool|null
     */
    public function getNodeById($id){
        if(empty($id)){
            return false;
        }

        $this->db->db_query("select * from `node` where id = ".$id);
        return $this->db->getOne();
    }
}