<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
    function serviceListing($selectedActiveStatus = '', $flOrderByCat = false, $type = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.title, BaseTbl.category_id, BaseTbl.price, BaseTbl.status, BaseTbl.add_date, sc.category_name, BaseTbl.type, BaseTbl.fl_special, BaseTbl.time_duration, BaseTbl.fl_special');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->join('tbl_services_category as sc', 'sc.id = BaseTbl.category_id');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('BaseTbl.status', $selectedActiveStatus);
        }

        if(!empty($type)){           
            $this->db->where('BaseTbl.type', $type);
        }

        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where('BaseTbl.is_deleted', '0');

        if($flOrderByCat){
            $this->db->order_by("sc.category_name", "ASC");
        }

        $this->db->order_by("BaseTbl.add_date", "DESC");
        $this->db->order_by("BaseTbl.title", "ASC");

		$query = $this->db->get();
        $result = $query->result();  //print_r($this->db->last_query());    die();
     
        return $result;
    }

    function serviceChargeClusterInfo(){
        $this->db->select('scbc.service_id, scbc.cluster_id, sc.title, scbc.service_charge');
        $this->db->from('tbl_services_cluster_based_charge as scbc');
        $this->db->join('tbl_services_cluster as sc', 'sc.id = scbc.cluster_id');
        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where('scbc.status', 'AC');
        $this->db->where('scbc.is_deleted', '0');
        $this->db->order_by("scbc.service_id", "asc");
        $this->db->order_by("scbc.cluster_id", "ASC");
        $query = $this->db->get();
        $result = $query->result();  

        $arrResult = array();
        foreach ($result as $key => $value) {
            $arrResult[$value->service_id][$value->cluster_id] = array("title" => $value->title, 
                                                        "service_charge" => $value->service_charge);
        }

        /*echo "<pre>";
        print_r($arrResult);    
        print_r($this->db->last_query());    
        die();*/

        return $arrResult;
    }
	
    function addNewService($serviceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_services', $serviceInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }

    function addNewServiceClustorInfo($serviceClustorInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_services_cluster_based_charge', $serviceClustorInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getServiceInfo($serviceId)
    {
        $this->db->select('id, title, category_id, price, status, time_duration, type, fl_special');
        $this->db->from('tbl_services');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $serviceId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getServiceClusterChargeInfo($serviceId)
    {
        $this->db->select('id, service_id, cluster_id, service_charge');
        $this->db->from('tbl_services_cluster_based_charge');
        $this->db->where('is_deleted', '0');    
        $this->db->where('service_id', $serviceId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function checkServiceClusterPriceExist($serviceId, $cluster_id){
        $this->db->select('id, service_id, cluster_id, service_charge');
        $this->db->from('tbl_services_cluster_based_charge');
        $this->db->where('is_deleted', '0');    
        $this->db->where('service_id', $serviceId);
        $this->db->where('cluster_id', $cluster_id);
        $query = $this->db->get();

        $data = $query->row();

        if(!empty($data)){
            return true;
        } 
        else {
            return false;
        }
    }
    
    function updateServiceClustorInfo($serviceId, $cluster_id, $serviceClustorInfo)
    {
        $this->db->where('service_id', $serviceId);
        $this->db->where('cluster_id', $cluster_id);
        $this->db->update('tbl_services_cluster_based_charge', $serviceClustorInfo);
        return TRUE;
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

    function getAllClusters()
    {
        $this->db->select('sc.id, sc.title');
        $this->db->from('tbl_services_cluster as sc');
        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->order_by("sc.id", "ASC");
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    } 


    function getAllServices()
    {
        $this->db->select('s.id, s.title, s.category_id, s.price, s.status, s.add_date, sc.category_name, s.time_duration, s.type, s.fl_special');
        $this->db->from('tbl_services as s');
        $this->db->join('tbl_services_category as sc', 'sc.id = s.category_id');
        $this->db->where('s.status', 'AC');
        $this->db->where('sc.status', 'AC');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where('s.is_deleted', '0');
        $this->db->order_by("sc.category_name", "ASC");
        $this->db->order_by("s.title", "ASC");

        $query = $this->db->get();
        $result = $query->result();  //print_r($this->db->last_query());    die();
     
        return $result;
    } 
}

  