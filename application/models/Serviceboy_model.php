<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Serviceboy_model (Serviceboy Model)
 * Serviceboy model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Serviceboy_model extends CI_Model
{
    function loginServiceboy($username)
    {
        $this->db->select('id, team_id, first_name, last_name, level, gender, joining_date, experience, commission, basic_salary, hourly_rate, taxation, phone, email, address, post_code, positioning, capabilities, status');
        $this->db->from('tbl_team');
        $this->db->where('is_deleted', '0');    
        $this->db->where('team_id', $username);
        $query = $this->db->get();
       
        $user = $query->row();

        if(!empty($user)){
            return $user;
        } 
        else {
            return array();
        }
    }

    function getServiceBoyCartDetails($serviceBoyId, $orderId = ''){
        $this->db->distinct();
        $this->db->select('cm.id as cartMasterId, csp.id as cspId, csp.team_id, cpi.first_name, cpi.last_name, cpi.email, cpi.phone, cpi.address, cm.service_date, cm.service_time');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart_personal_info as cpi', 'cm.id = cpi.cartmaster_id');
        $this->db->join('tbl_cart_servicer as csp', 'cm.id = csp.cartmaster_id');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('csp.is_deleted', '0');
        $this->db->where('csp.team_id', $serviceBoyId);
        if(!empty($orderId)){
            $this->db->where('cm.id', $orderId);
        }
        $this->db->order_by("cm.service_date", "DESC");
        $this->db->order_by("cm.service_time", "DESC");
        $query = $this->db->get();

        $result = $query->result();

        //echo "<pre>"; print_r($result); print_r($this->db->last_query());    die();    
        return $result;
    }

    function addNewServiceBoyOrderAction($arrInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_service_boy_order_action_history', $arrInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


}

?>