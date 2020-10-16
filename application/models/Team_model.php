<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model
{
    function supplierListing($selectedActiveStatus = '')
    {
        $this->db->select('id, first_name, last_name, level, gender, joining_date, experience, commission, basic_salary, hourly_rate, taxation, phone, email, address, post_code, positioning, capabilities, status, add_date');
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
        $this->db->select('id, first_name, last_name, level, gender, joining_date, experience, commission, basic_salary, hourly_rate, taxation, phone, email, address, post_code, positioning, capabilities, status');
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
}

  