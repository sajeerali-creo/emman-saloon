<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
    function serviceListing($selectedActiveStatus = '', $flOrderByCat = false)
    {
        $this->db->select('BaseTbl.id, BaseTbl.title, BaseTbl.category_id, BaseTbl.price, BaseTbl.status, BaseTbl.add_date, sc.category_name');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->join('tbl_services_category as sc', 'sc.id = BaseTbl.category_id');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('BaseTbl.status', $selectedActiveStatus);
        }

        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where('BaseTbl.is_deleted', '0');

        if($flOrderByCat){
            $this->db->order_by("sc.category_name", "ASC");
        }

        $this->db->order_by("BaseTbl.title", "ASC");

		$query = $this->db->get();
        $result = $query->result();  //print_r($this->db->last_query());    die();
     
        return $result;
    }
	
    function addNewService($serviceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_services', $serviceInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getServiceInfo($serviceId)
    {
        $this->db->select('id, title, category_id, price, status');
        $this->db->from('tbl_services');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $serviceId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function updateService($serviceInfo, $serviceId)
    {
        $this->db->where('id', $serviceId);
        $this->db->update('tbl_services', $serviceInfo);
        return TRUE;
    }   
	
    function deleteService($serviceId, $serviceInfo)
    {
        $this->db->where('id', $serviceId);
        $this->db->update('tbl_services', $serviceInfo);
		
        return $this->db->affected_rows();
    }

    function getAllServiceCategory()
    {
        $this->db->select('sc.id, sc.category_name');
        $this->db->from('tbl_services_category as sc');
        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->order_by("sc.category_name", "ASC");
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    } 
}

  