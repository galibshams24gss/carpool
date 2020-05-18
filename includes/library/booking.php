<?php
/**
 * FILE
 *      icomp_assignment.php
 * DEPENDENCE
 *      icomp_base.php
 *      icomp_email.php
 *      php_mail.php
 *      icomp_user.php
 *      icomp_config.php
 * DESCRIPTION
 *      Check permission for the given user
 */

namespace icomp_assignment;

require_once realpath(__DIR__ . '/..').'/phpmailer/PHPMailerAutoload.php';
include_once realpath(__DIR__ . '/..').'/library/base.php';
include_once realpath(__DIR__ . '/..').'/library/user.php';
include_once realpath(__DIR__ . '/..').'/library/email.php';
include_once realpath(__DIR__ . '/..').'/library/config.php';
include_once realpath(__DIR__ . '/..').'/library/locations.php';
use base\base;
use email\email as send_email;
use PHPMailer as php_mail;
use user\user;
use config\config;
use locations\locations;

class booking extends base
{
    private $send_email;
    private $user;
    private $config;
    private $locations;

    /**
     * icomp_user constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->send_email = new send_email(new php_mail);
        $this->user = new user();
        $this->config = new config();
        $this->locations = new locations();
    }

    /**
     * @param $job_set
     *
     * @return bool
     */
    public function makeBooking($job_set){

        $email_sender = array(
            'user' => $job_set['assign_by'],
            'customer' => $job_set['company_name'],
            'mail_to' => $job_set['user']
        );
        if(!empty($hex)){
            $email_sender['hex'] = $hex;
        }
        $this->send_email->setSubject('icomp.li assignment notification');
        $this->send_email->clearAddresses();
        $this->send_email->setTo($job_set['user']);
        $this->send_email->setRBody($email_sender);

        $status = (!empty($assignment[0]['status']))?$assignment[0]['status']:'Assigned';

        // set other active history record to de-active
        //$this->db->db_query('update `icomp_responsible_history` set `active` = "N" where `assignment_id` = '.$assignment_id);
        //$this->initRecord(array(
        //    'assignment_id' => $assignment_id,
        //    'uid' => $to_user['id'],
        //    'site_id' => $job_set['site_id'],
        //    'assigned_by' => $job_set['assign_by'],
        //    'modify' => $this->datetime,
        //    'status' => $status,
        //    'assigned_time' => $this->datetime
        //), 'icomp_responsible_history');

        return $this->send_email->email();
    }
}