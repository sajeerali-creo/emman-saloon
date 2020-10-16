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
	
    function addNewSupplier($supplierInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_suppliers', $supplierInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getSupplierInfo($supplierId)
    {
        $this->db->select('id, title, country, city, postcode, phone, fax, web, email, category, status');
        $this->db->from('tbl_suppliers');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $supplierId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function updateSupplier($supplierInfo, $supplierId)
    {
        $this->db->where('id', $supplierId);
        $this->db->update('tbl_suppliers', $supplierInfo);
        return TRUE;
    }   
	
    function deleteSupplier($supplierId, $supplierInfo)
    {
        $this->db->where('id', $supplierId);
        $this->db->update('tbl_suppliers', $supplierInfo);
		
        return $this->db->affected_rows();
    } 
}

  