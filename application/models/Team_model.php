<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model
{
    function teamListing($selectedActiveStatus = '')
    {
        $this->db->select('id, team_id, first_name, last_name, level, gender, joining_date, experience, commission, basic_salary, hourly_rate, taxation, phone, email, address, post_code, positioning, capabilities, status, add_date');
        $this->db->from('tbl_team');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('status', $selectedActiveStatus);
        }

        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
		
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }
	
    function addNewTeam($teamInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_team', $teamInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getTeamInfo($teamId)
    {
        $this->db->select('id, team_id, first_name, last_name, level, gender, joining_date, experience, commission, basic_salary, hourly_rate, taxation, phone, email, address, post_code, positioning, capabilities, status');
        $this->db->from('tbl_team');
        $this->db->where('is_deleted', '0');	
        $this->db->where('id', $teamId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function updateTeam($teamInfo, $teamId)
    {
        $this->db->where('id', $teamId);
        $this->db->update('tbl_team', $teamInfo);
        return TRUE;
    }   
	
    function deleteTeam($teamId, $teamInfo)
    {
        $this->db->where('id', $teamId);
        $this->db->update('tbl_team', $teamInfo);
		
        return $this->db->affected_rows();
    } 

    function teamOrderListing()
    {
        $this->db->select('t.id teamId, t.first_name teamFName, t.last_name teamLName, cm.id as cartMasterId, s.title as serviceName, sc.category_name as serviceCategory, cm.service_date, cm.service_time, c.person, c.id as cartId, s.time_duration');
        $this->db->from('tbl_team t');
        $this->db->join('tbl_cart_servicer_product csp', 'csp.team_id = t.id');
        $this->db->join('tbl_cartmaster cm', 'csp.cartmaster_id = cm.id');
        $this->db->join('tbl_cart c', 'c.cartmaster_id = cm.id');
        $this->db->join('tbl_services as s', 's.id = c.service_id');
        $this->db->join('tbl_services_category as sc', 'sc.id = s.category_id');
        $this->db->where('t.is_deleted', '0');
        $this->db->where('csp.is_deleted', '0');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('c.is_deleted', '0');
        $this->db->where('s.is_deleted', '0');
        $this->db->where('sc.is_deleted', '0');
        $this->db->order_by("t.id", "DESC");
        $this->db->order_by("cm.add_date", "DESC");

        $query = $this->db->get();

        $result = $query->result();

        

        $arrReturn = array();
        if(!empty($result)){
            foreach ($result as $key => $objCart) {
                $arrReturn[$objCart->teamId]['booking'][$objCart->cartId] = (array)$objCart;
                $arrReturn[$objCart->teamId]['info'] = (array)$objCart;
            }
        }

        //echo "<pre>"; print_r($arrReturn); print_r($this->db->last_query());    die();

        return $arrReturn;
    }
}

  