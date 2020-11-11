<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	function getTotalSales($startDate, $endDate){
        $this->db->select('sum(total_price) as totalPrice, payment_type');
        $this->db->from('tbl_cartmaster');
        $this->db->where('is_deleted', '0');
        $this->db->where('status', 'CM');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $this->db->group_by('payment_type');

        $query = $this->db->get();

        //echo "<pre>"; print_r($this->db->last_query());    die();   

        return $query->result();
    }


    function getTotalSalesServices($startDate, $endDate){
        $this->db->select('cm.id, c.person as services, c.price, c.service_charge, cm.vat, cm.extra_service_charge, cm.discount_price');
        $this->db->from('tbl_cartmaster cm');
        $this->db->join('tbl_cart c', 'cm.id = c.cartmaster_id');
        $this->db->where('c.is_deleted', '0');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('cm.status', 'CM');
        $this->db->where('cm.add_date >=', $startDate);
        $this->db->where('cm.add_date <=', $endDate);

        $query = $this->db->get();

        //echo "<pre>"; print_r($this->db->last_query());    die();   
        return $query->result();
    }

    function getEmployeeSalesServices($startDate, $endDate){
        $this->db->select('cm.id, c.person as services, c.price, c.service_id, c.service_charge, cm.vat, cm.extra_service_charge, cm.discount_price, cs.team_id, t.first_name, t.last_name, cm.service_slots');
        $this->db->from('tbl_cartmaster cm');
        $this->db->join('tbl_cart c', 'cm.id = c.cartmaster_id');
        $this->db->join('tbl_cart_servicer cs', 'c.id = cs.cart_id');
        $this->db->join('tbl_team t', 't.id = cs.team_id');
        $this->db->where('c.is_deleted', '0');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('cs.is_deleted', '0');
        $this->db->where('cm.status', 'CM');
        $this->db->where('cs.status', 'AC');
        $this->db->where('cm.add_date >=', $startDate);
        $this->db->where('cm.add_date <=', $endDate);
        $this->db->order_by("cs.team_id", "asc");

        $query = $this->db->get();

        //echo "<pre>"; print_r($this->db->last_query());    die();   
        return $query->result();
    }

    function getToalProductSales($startDate, $endDate){
        $this->db->select('sum(ps.quantity) as totalCount, sum(ps.total_price) as totalPrice, ps.team_id, t.first_name, t.last_name');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_team t', 't.id = ps.team_id');
        $this->db->where('ps.is_deleted', '0');
        $this->db->where('t.is_deleted', '0');
        $this->db->where('ps.sale_type', 'sale');
        $this->db->where('ps.add_date >=', $startDate);
        $this->db->where('ps.add_date <=', $endDate);
        $this->db->group_by('ps.team_id');
        $query = $this->db->get();
        return $query->result();
    }
}