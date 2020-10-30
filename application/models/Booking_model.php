<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    function bookingListing($startDate = '', $endDate = '', $flIncludeDeletedRecord = false)
    {
        $this->db->select('cm.id as cartMasterId, cm.order_id, cm.service_date, cm.service_time, cm.booking_note, cm.total_price, cm.vat, cm.service_charge, cm.discount_price, cm.status, cm.add_date, c.id as cartId, c.service_id, c.price, c.person, cpi.first_name, cpi.last_name, cpi.email, cpi.phone, cpi.address, cm.customer_id, s.title as serviceName, sc.category_name as serviceCategory, DATE_FORMAT(cm.add_date, "%Y-%m-%d %h:%i %p") as addDate, cm.booking_type, cm.delete_note cancelNote, cm.is_deleted as flCancel, s.time_duration');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart_personal_info as cpi', 'cm.id = cpi.cartmaster_id');
        $this->db->join('tbl_cart as c', 'cm.id = c.cartmaster_id');
        $this->db->join('tbl_services as s', 's.id = c.service_id');
        $this->db->join('tbl_services_category as sc', 'sc.id = s.category_id');

        if(!$flIncludeDeletedRecord){
            $this->db->where('cm.is_deleted', '0');
        }

        $this->db->where('c.is_deleted', '0');
        $this->db->where('cpi.is_deleted', '0');
        $this->db->where('s.is_deleted', '0');
        $this->db->where('sc.is_deleted', '0');
        $this->db->order_by("cm.add_date", "DESC");
        $this->db->order_by("cm.customer_id", "ASC");

        if(!empty($startDate)){
            $this->db->where('cm.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('cm.add_date <=', $endDate);
        }
        $query = $this->db->get();

        $result = $query->result();

        $arrReturn = array();
        if(!empty($result)){
            $arrSelectedCartInfo = array();

            foreach ($result as $key => $objCart) {
                $arrReturn[$objCart->cartMasterId]['serviceAllInfo'][$objCart->cartId] = (array)$objCart;
                $arrReturn[$objCart->cartMasterId]['info'] = (array)$objCart;

                if(!in_array($objCart->cartMasterId, $arrSelectedCartInfo)){
                    $arrSelectedCartInfo[] = $objCart->cartMasterId;
                    $objTeamInfo = $this->getBookingServicerProductInfo($objCart->cartMasterId);

                    if(!empty($objTeamInfo)){
                        //echo "<pre>"; print_r($objTeamInfo);die();
                        foreach ($objTeamInfo as $key => $value) {
                            $arrReturn[$objCart->cartMasterId]['teamInfo'][$value->team_id] = (array)$value;
                        }
                    }
                    else{
                        $arrReturn[$objCart->cartMasterId]['teamInfo'] = array();
                    }                    
                }
            }
        }

        //echo "<pre>"; print_r($arrReturn); print_r($this->db->last_query());    die();
     
        return $arrReturn;
    }
	
    function addNewBooking($bookingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_bookings', $bookingInfo);
        
        $insert_id = $this->db->insert_id();
        
       $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function getBookingInfo($bookingId, $flIncludeDeletedRecord = false)
    {
        $this->db->select('cm.id as cartMasterId, cm.order_id, cm.booking_type, cm.service_date, cm.service_time, cm.booking_note, cm.total_price, cm.vat, cm.service_charge, cm.discount_price, cm.status, cm.add_date, c.id as cartId, c.service_id, c.price, c.person, cpi.first_name, cpi.last_name, cpi.email, cpi.phone, cpi.address, cm.customer_id, s.title as serviceName, sc.category_name as serviceCategory, cm.invoice_number, cm.delete_note cancelNote, cm.is_deleted as flCancel, cm.deleted_from as cancelFrom, cm.deleted_id as cancel_user_id');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart_personal_info as cpi', 'cm.id = cpi.cartmaster_id');
        $this->db->join('tbl_cart as c', 'cm.id = c.cartmaster_id');
        $this->db->join('tbl_services as s', 's.id = c.service_id');
        $this->db->join('tbl_services_category as sc', 'sc.id = s.category_id');

        if(!$flIncludeDeletedRecord){
            $this->db->where('cm.is_deleted', '0');
        }

        $this->db->where('c.is_deleted', '0');
        $this->db->where('cpi.is_deleted', '0');
        $this->db->where('s.is_deleted', '0');
        $this->db->where('sc.is_deleted', '0');
        $this->db->where('cm.id', $bookingId);
        $query = $this->db->get();

        $result = $query->result();

        $arrReturn = array();
        if(!empty($result)){
            foreach ($result as $key => $objCart) {
                $arrReturn['serviceAllInfo'][$objCart->cartId] = (array)$objCart;
                $arrReturn['info'] = (array)$objCart;
            }
        }

        //echo "<pre>"; print_r($arrReturn); print_r($this->db->last_query());    die();        
        return $arrReturn;
    }

    function getBookingServicerProductInfo($bookingId){
        $this->db->distinct();
        $this->db->select('cs.id as cspId, cs.team_id, csp.product_id, t.first_name, t.last_name, t.is_deleted');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart_servicer as cs', 'cm.id = cs.cartmaster_id');
        $this->db->join('tbl_team as t', 't.id = cs.team_id');
        $this->db->join('tbl_cart_servicer_product as csp', 'cs.id = csp.cart_servicer_id', 'left');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('cs.is_deleted', '0');
        $this->db->where('cm.id', $bookingId);
        $this->db->order_by("cs.team_id", 'ASC');
        $query = $this->db->get();

        $result = $query->result();

        //echo "<pre>"; print_r($result); print_r($this->db->last_query());    die();    
        return $result;
    }
    
    function updateBooking($bookingInfo, $bookingId)
    {
        $this->db->where('id', $bookingId);
        $this->db->update('tbl_bookings', $bookingInfo);
        return TRUE;
    }   
	
    function deleteBooking($bookingId, $bookingInfo)
    {
        $this->db->where('id', $bookingId);
        $this->db->update('tbl_bookings', $bookingInfo);
		
        return $this->db->affected_rows();
    } 
}

  