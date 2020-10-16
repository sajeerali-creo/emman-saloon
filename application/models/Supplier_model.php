<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    function supplierListing($selectedActiveStatus = '')
    {
        $this->db->select('id, title, country, city, postcode, phone, fax, web, email, category, status, add_date');
        $this->db->from('tbl_suppliers');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('status', $selectedActiveStatus);
        }

        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
		
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
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

  