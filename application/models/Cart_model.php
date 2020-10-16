<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    function addIntoCartMaster($cartMasterInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cartmaster', $cartMasterInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartInfo($arrCartInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart', $arrCartInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartPersonalInfo($arrPersonalInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart_personal_info', $arrPersonalInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function updateCartMaster($cartMasterInfo, $cartmasterId)
    {
        $this->db->where('id', $cartmasterId);
        $this->db->update('tbl_cartmaster', $cartMasterInfo);
        return true;
    }

    function getAllOrderInfo($customerId){
        $this->db->select('cm.id as cartMasterId, cm.order_id, cm.service_date, cm.service_time, cm.booking_note, cm.total_price, cm.status, cm.add_date, c.id as cartId, c.service_id, c.price, c.person');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart as c', 'cm.id = c.cartmaster_id');
        $this->db->where('cm.customer_id', $customerId);
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('c.is_deleted', '0');
        $this->db->order_by("cm.add_date", "DESC");
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }
}