<?php
/**
 * FILE
 *      base.php
 * DEPENDENCE
 *      functions.php
 *      library/db_base.php
 * DESCRIPTION
 *      Base class to serve the insert and update functions, this can be extended so other class can reuse those basic functions.
 */
namespace base;

include_once realpath(__DIR__ . '/..').'/library/db_base.php';
include_once realpath(__DIR__ . '/..').'/functions.php';

use db\connection as db;

class base
{
    public $db;
    public $datetime;

    function __construct()
    {
        $this->db = new db\db;
        $this->datetime = date('Y-m-d H:i:s');
    }

    /**
     * @param array $input
     * @param       $table
     *
     * @return bool
     */
    public function updateDetails($input = array(), $table){
        return $this->_update_db_details($input, $table);
    }

    /**
     * @param array $input
     * @param       $table
     *
     * @return bool
     */
    private function _update_db_details($input = array(), $table){
        if(empty($input) || empty($table)){
            return false;
        }

        $fields = array();
        $id = 0;
        foreach($input as $key => $value) {
            // add formatted key/value pair to fields array
            // e.g. format: network_id = '26'
            if($key == 'id'){
                $id = $value;
                continue;
            }
            $fields[] = '`'.trim($key) . "` = '" . $this->db->escape_string($value) . "'";
        }
        $fields = implode(', ', $fields);
        // build your query

        if(empty($id)){
            return false;
        }

        $this->db->db_query("UPDATE `".$table."` SET " . $fields . " WHERE `id` = '".$id."'");
    }

    /**
     * @param array $input
     * @param       $table
     *
     * @return bool
     */
    public function initRecord($input = array(), $table){
        return $this->_init_record($input, $table);
    }

    /**
     * @param array $input
     * @param       $table
     *
     * @return bool
     */
    private function _init_record($input = array(), $table){
        $keys = array();
        $values = array();
        foreach($input as $key => $value) {
            $keys[] = "`".trim($key)."`";
            $values[] = "'".addslashes($this->db->escape_string($value))."'";
        }
        $key_output = implode(', ', $keys);
        $values_output = implode(', ', $values);

        $this->db->db_query("insert into `".$table."` (" . $key_output . ") value (".$values_output.")");
        return $this->db->last_insert_id;
    }
}