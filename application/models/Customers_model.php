<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customers_model extends CI_Model
{
    function customerListing($selectedActiveStatus = '')
    {
        $this->db->distinct();
        $this->db->select('c.id, c.first_name, c.last_name, c.email, c.phone_number, c.location_full_address, c.location_lat, c.location_lng, c.status, sum(cm.total_price) as totalPrice, count(cm.id) as totalOrder');
        $this->db->from('tbl_customers c');
        $this->db->join('tbl_cartmaster as cm', 'c.id = cm.customer_id');

        $this->db->where('c.is_deleted', '0');
        $this->db->where('cm.is_deleted', '0');
        //$this->db->where('cm.status', 'CN');
        $this->db->group_by('c.id');
        $query = $this->db->get();
		
        $result = $query->result();  //print_r($this->db->last_query());    die();
     
        return $result;
    }
	
    function addNewCustomer($customerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customers', $customerInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getCustomerInfo($customerId)
    {
        $this->db->select('id, title, country, city, postcode, phone, fax, web, email, category, status');
        $this->db->from('tbl_customers');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $customerId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function updateCustomer($customerInfo, $customerId)
    {
        $this->db->where('id', $customerId);
        $this->db->update('tbl_customers', $customerInfo);
        return TRUE;
    }   
	
    function deleteCustomer($customerId, $customerInfo)
    {
        $this->db->where('id', $customerId);
        $this->db->update('tbl_customers', $customerInfo);
		//print_r($this->db->last_query());    die();
        return $this->db->affected_rows();
    }

    function checkCustomerExist($strEmail, $strPhone){
        $this->db->select('id, first_name, last_name, email, phone_number, location_full_address, location_lat, location_lng, password');
        $this->db->from('tbl_customers');
        $this->db->where('email', $strEmail);
        $this->db->or_where('phone_number', $strPhone);
        $this->db->where('is_deleted', "0");
        $this->db->where('status', 'AC');
        $query = $this->db->get();
       
        $user = $query->row();

        if(!empty($user)){
            return $user;
        } 
        else {
            return array();
        }
    }

    function addNewUserDetails($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customers', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}

  