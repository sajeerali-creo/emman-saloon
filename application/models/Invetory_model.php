<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Invetory_model extends CI_Model
{
    function productListing($selectedActiveStatus = '')
    {
        $this->db->select('id, invoice_number, suppliers_id, category_id, title, quantity, date_of_add, cost_of_buy, buy_tax, cost_of_sell, sell_tax, status');
        $this->db->from('tbl_invetory');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('status', $selectedActiveStatus);
        }

        $this->db->where('is_deleted', '0');
        $this->db->order_by("add_date", "DESC");
        $query = $this->db->get();
		
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }
	
    function addNewProduct($productInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_invetory', $productInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getProductInfo($productId)
    {
        $this->db->select('id, invoice_number, suppliers_id, category_id, title, quantity, date_of_add, cost_of_buy, buy_tax, cost_of_sell, sell_tax, status');
        $this->db->from('tbl_invetory');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $productId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function updateProduct($productInfo, $productId)
    {
        $this->db->where('id', $productId);
        $this->db->update('tbl_invetory', $productInfo);
        return TRUE;
    }   
	
    function deleteProduct($productId, $productInfo)
    {
        $this->db->where('id', $productId);
        $this->db->update('tbl_invetory', $productInfo);
		
        return $this->db->affected_rows();
    } 

    function addSellProduct($productInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_product_sales', $productInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
}

  