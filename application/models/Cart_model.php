<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    function addIntoCartMaster($cartMasterInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cartmaster', $cartMasterInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartInfo($arrCartInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart', $arrCartInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartPersonalInfo($arrPersonalInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart_personal_info', $arrPersonalInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartServicerInfo($arrInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart_servicer', $arrInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function addIntoCartServicerProductInfo($arrInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cart_servicer_product', $arrInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function updateCartMaster($cartMasterInfo, $cartmasterId)
    {
        $this->db->where('id', $cartmasterId);
        $this->db->update('tbl_cartmaster', $cartMasterInfo);
        return true;
    }

    function getAllOrderInfo($customerId, $flIncludeDeletedRecord = false){
        $this->db->select('cm.id as cartMasterId, cm.order_id, cm.service_date, cm.service_time, cm.booking_note, cm.total_price, cm.status, cm.add_date, c.id as cartId, c.service_id, c.price, c.person, cm.delete_note cancelNote, cm.is_deleted as flCancel, cm.deleted_from as cancelFrom, cm.deleted_id as cancel_user_id');
        $this->db->from('tbl_cartmaster as cm');
        $this->db->join('tbl_cart as c', 'cm.id = c.cartmaster_id');
        $this->db->where('cm.customer_id', $customerId);

        if(!$flIncludeDeletedRecord){
            $this->db->where('cm.is_deleted', '0');
        }

        $this->db->where('c.is_deleted', '0');
        $this->db->order_by("cm.add_date", "DESC");
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }

    function checkcartExist($cartId){
        $this->db->select('id');
        $this->db->from('tbl_cart');
        $this->db->where('id', $cartId);
        $query = $this->db->get();
       
        $cart = $query->row();

        if(!empty($cart)){
            return $cart;
        } 
        else {
            return array();
        }
    }

    function updateCartInfo($cartInfo, $cartId)
    {
        $this->db->where('id', $cartId);
        $this->db->update('tbl_cart', $cartInfo);
        return true;
    }

    function checkcartServiceProductExist($cartServiceProductId){
        $this->db->select('id');
        $this->db->from('tbl_cart_servicer_product');
        $this->db->where('id', $cartServiceProductId);
        $query = $this->db->get();
       
        $cart = $query->row();

        if(!empty($cart)){
            return $cart;
        } 
        else {
            return array();
        }
    }

    function updateCartServicerInfo($cartInfo, $cartServicerId)
    {
        $this->db->where('id', $cartServicerId);
        $this->db->update('tbl_cart_servicer', $cartInfo);
        return true;
    }

    function updateCartServiceProductInfo($cartInfo, $cartServiceProductId)
    {
        $this->db->where('id', $cartServiceProductId);
        $this->db->update('tbl_cart_servicer_product', $cartInfo);
        return true;
    }

    function updateCartServicerInfoUsingCMID($cartInfo, $cartmaster_id)
    {
        $this->db->where('cartmaster_id', $cartmaster_id);
        $this->db->where('is_deleted', '0');
        $this->db->update('tbl_cart_servicer', $cartInfo);
        return true;
    }

    function updateCartServicerProductInfoUsingCMID($cartInfo, $cartmaster_id)
    {
        $this->db->where('cartmaster_id', $cartmaster_id);
        $this->db->where('is_deleted', '0');
        $this->db->update('tbl_cart_servicer_product', $cartInfo);
        return true;
    }

    function addIntoNotification($cartmasterId, $type, $teamId = 0)
    {
        $arrInfo = array("cartmaster_id" => $cartmasterId, "type" => $type, "add_date" => date('Y-m-d H:i:s'));
        if(!empty($teamId)){
            $arrInfo['team_id'] = $teamId;
        }
        $this->db->trans_start();
        $this->db->insert('tbl_notifications', $arrInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function updateNotificationInfo($cartmasterId, $type, $teamId = 0)
    {
        $arrInfo = array("fl_viewed" => '1');
        
        $this->db->where('type', $type);
        $this->db->where('cartmaster_id', $cartmasterId);
        if(!empty($teamId)){
            $this->db->where('team_id', $teamId);
        }

        $this->db->update('tbl_notifications', $arrInfo);
    }

    function getAllTimeSlots(){
        $this->db->select('ts.id, ts.title');
        $this->db->from('tbl_time_slots ts');
        $this->db->where('ts.is_deleted', '0');
        $this->db->order_by('ts.sort_order', "ASC");
        $query = $this->db->get();
        
        $result = $query->result();  //echo "<pre>"; print_r($result);    die();
        return $result;
    }

    function addIntoBookingTimeSlotsInfo($arrInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_booking_time_slots', $arrInfo);
         
        $insert_id = $this->db->insert_id();
         
        $this->db->trans_complete();
         
        return $insert_id;
    }

    function updateBookingTimeSlotsInfo($cartInfo, $cartmaster_id)
    {
        $this->db->where('cartmaster_id', $cartmaster_id);
        $this->db->where('is_deleted', '0');
        $this->db->update('tbl_booking_time_slots', $cartInfo);
        return true;
    }

    function getBookingTimeSlotsInfo($date, $bookingId = 0){
        
        $this->db->select('ts.id, ts.cartmaster_id, ts.service_id, ts.booking_date, ts.time_slot, SUM(ts.team_members_count) totalCount');
        $this->db->from('tbl_booking_time_slots ts');
        $this->db->where('ts.is_deleted', '0');
        if(!empty($bookingId) && !is_null($bookingId)){
            $this->db->where('ts.cartmaster_id <> ' . $bookingId);
        }
        $this->db->where('ts.booking_date', $date);
        $this->db->order_by('ts.time_slot', "ASC");
        $this->db->group_by('ts.time_slot');
        $query = $this->db->get();
        
        $result = $query->result();  //echo "<pre>"; print_r($result);    die();
        return $result;
    }

    function getNotificationCount($type = 'admin'){
        $this->db->select('n.id notificationId, cm.id cartmasterId');
        $this->db->from('tbl_notifications n');
        $this->db->join('tbl_cartmaster as cm', 'cm.id = n.cartmaster_id');

        $this->db->where('n.type', $type);
        $this->db->where('n.is_deleted', '0');
        $this->db->where('n.fl_viewed', '0');
        $this->db->where('cm.is_deleted', '0');
        $this->db->group_by('n.id');
        $query = $this->db->get();
        
        $result = $query->result();  //print_r($this->db->last_query());    die();

        if($result){
            return count($result);
        }
        else{
            return 0;
        }
    }

    function getNotificationListing($notificationType = 'admin')
    {
        $this->db->select('cm.id as cartMasterId, cm.order_id, cpi.address, c.id as cartId, c.price, c.person, s.title as serviceName, sc.category_name as serviceCategory');
        $this->db->from('tbl_notifications n');
        $this->db->join('tbl_cartmaster as cm', 'cm.id = n.cartmaster_id');
        $this->db->join('tbl_cart_personal_info as cpi', 'cm.id = cpi.cartmaster_id');
        $this->db->join('tbl_cart as c', 'cm.id = c.cartmaster_id');
        $this->db->join('tbl_services as s', 's.id = c.service_id');
        $this->db->join('tbl_services_category as sc', 'sc.id = s.category_id');
        $this->db->where('n.type', $notificationType);
        $this->db->where('n.fl_viewed', '0');
        $this->db->where('n.is_deleted', '0');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('c.is_deleted', '0');
        $this->db->where('cpi.is_deleted', '0');
        $this->db->where('s.is_deleted', '0');
        $this->db->where('sc.is_deleted', '0');
        $query = $this->db->get();

        $result = $query->result();

        $arrReturn = array();
        if(!empty($result)){
            foreach ($result as $key => $objCart) {
                $arrReturn[$objCart->cartMasterId]['serviceAllInfo'][$objCart->cartId] = (array)$objCart;
                $arrReturn[$objCart->cartMasterId]['info'] = (array)$objCart;
            }
        }

        //echo "<pre>"; print_r($arrReturn); print_r($this->db->last_query());    die();        
        return $arrReturn;
    }

    function getTotalSales($startDate, $endDate, $group_by_month = false){
        $this->db->select('sum(total_price) as totalPrice');//, DATE_FORMAT(add_date, "%M") groupMonth
        $this->db->from('tbl_cartmaster');
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);

        if($group_by_month){
            //$this->db->group_by('groupMonth');
            $query = $this->db->get();
            return $query->result();
        } else {
            $query = $this->db->get();
            return $query->row();
        }        
    }
    
    function getTotalBooking($startDate, $endDate, $group_by_month = false){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalConfirmBooking($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where_in('status', ['CN', 'SBC', 'SBR']);
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalPendingBooking($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where_in('status', ['PN']);
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalCompletedBooking($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where_in('status', ['CM']);
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalHomeServices($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where('booking_type', 'home');
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalSaloonServices($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_cartmaster');
        $this->db->where('booking_type', 'saloon');
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getProductSales($startDate, $endDate){
        $this->db->select('sum(quantity) as totalCount');
        $this->db->from('tbl_product_sales');
        $this->db->where('is_deleted', '0');
        $this->db->where('add_date >=', $startDate);
        $this->db->where('add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalProductUse($startDate, $endDate){
        $this->db->select('count(csp.product_id) as totalCount');
        $this->db->from('tbl_cart_servicer_product csp');
        $this->db->join('tbl_cartmaster cm', 'cm.id = csp.cartmaster_id');
        $this->db->where('cm.is_deleted', '0');
        $this->db->where('csp.is_deleted', '0');
        $this->db->where('csp.product_id <> "0"');
        $this->db->where('cm.add_date >=', $startDate);
        $this->db->where('cm.add_date <=', $endDate);
        $query = $this->db->get();
        return $query->row();
    }


    function getTotalTeam($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_team');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalActiveTeam($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_team');
        $this->db->where('status', 'AC');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalOffTeam($type = 'IN', $startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_team');
        $this->db->where('status', $type);
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalCustomers($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_customers');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function getTotalSuppliers($startDate, $endDate){
        $this->db->select('count(id) as totalCount');
        $this->db->from('tbl_suppliers');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get();
        return $query->row();
    }

    function checkMasterMatching($bookingId, $customerId){
        $this->db->select('id');
        $this->db->from('tbl_cartmaster');
        $this->db->where('id', $bookingId);
        $this->db->where('customer_id', $customerId);
        $query = $this->db->get();
       
        $cart = $query->row();

        /*echo "<pre>";
        print_r($cart);
        die();*/
        if(!empty($cart)){
            return true;
        } 
        else {
            return false;
        }
    }
}