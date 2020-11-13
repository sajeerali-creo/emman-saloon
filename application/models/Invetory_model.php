<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Invetory_model extends CI_Model
{
    function productListing($selectedActiveStatus = '', $startDate = '', $endDate = '')
    {
        $this->db->select('id, invoice_number, suppliers_id, category_id, title, quantity, date_of_add, cost_of_buy, buy_tax, cost_of_sell, sell_tax, status, remaining_quantity');
        $this->db->from('tbl_invetory');

        if(!empty($selectedActiveStatus)){           
            $this->db->where('status', $selectedActiveStatus);
        }

        if(!empty($startDate)){
            $this->db->where('add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('add_date <=', $endDate);
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
        $this->db->select('id, invoice_number, suppliers_id, category_id, title, title_ar, quantity, date_of_add, cost_of_buy, buy_tax, cost_of_sell, sell_tax, status, remaining_quantity');
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

    function updateSellProduct($productInfo, $productSaleId)
    {
        $this->db->where('id', $productSaleId);
        $this->db->update('tbl_product_sales', $productInfo);
        return TRUE;
    }

    function getProductSellDetails($productId){
        $this->db->select('SUM(quantity) as totalSale');
        $this->db->from('tbl_product_sales');
        $this->db->where('is_deleted', '0');    
        $this->db->where('status', 'AC');    
        $this->db->where('product_id', $productId);
        $query = $this->db->get();

        $result = $query->row();  //print_r($result);    die();
        
        return $result;
    }

    function getProductSellingDetails($product_sell_id){
        $this->db->select('ps.id, ps.product_id, ps.customer_name, ps.quantity, ps.item_price, ps.tax, ps.total_price, ps.add_date, i.title productName, i.title_ar productNameArabic, ps.team_id, ps.invoice_number, DATE_FORMAT(ps.add_date, "%Y%m%d") as invoiceDateValue, DATE_FORMAT(ps.add_date, "%d/%m/%Y") as invoiceGenDate, , DATE_FORMAT(ps.add_date, "%h:%i:%s %p") as invoiceGenTime, CONCAT(t.first_name, " ", t.last_name) teamMemberName');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_invetory as i', 'i.id = ps.product_id');
        $this->db->join('tbl_team as t', 't.id = ps.team_id');
        $this->db->where('ps.is_deleted', '0');    
        $this->db->where('ps.status', 'AC');
        $this->db->where('ps.id', $product_sell_id);
        
        $this->db->order_by("ps.add_date", "DESC");  
        $query = $this->db->get();
        
        $result = $query->row();  //print_r($this->db->last_query());    die();
     
        return $result;
    }

    function productSellingListing($startDate = '', $endDate = ''){
        $this->db->select('ps.id, ps.product_id, ps.customer_name, ps.quantity, ps.item_price, ps.tax, ps.total_price, ps.add_date, i.title productName, ps.team_id, t.first_name, t.last_name');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_invetory as i', 'i.id = ps.product_id');
        $this->db->join('tbl_team as t', 't.id = ps.team_id');
        $this->db->where('ps.is_deleted', '0');    
        $this->db->where('ps.sale_type', 'sale');  
        $this->db->where('ps.status', 'AC');  
        $this->db->where('t.is_deleted', '0');    
        $this->db->where('t.status', 'AC');

        if(!empty($startDate)){
            $this->db->where('ps.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('ps.add_date <=', $endDate);
        }
        
        $this->db->order_by("ps.add_date", "DESC");  
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }

    function employeeProductSellingListing($startDate = '', $endDate = ''){
        $this->db->select('ps.id, ps.product_id, ps.customer_name, ps.quantity, ps.item_price, ps.tax, ps.total_price, ps.add_date, i.title productName, ps.team_id, t.first_name, t.last_name');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_invetory as i', 'i.id = ps.product_id');
        $this->db->join('tbl_team as t', 't.id = ps.team_id');
        $this->db->where('ps.is_deleted', '0');    
        $this->db->where('ps.sale_type', 'use');  
        $this->db->where('ps.status', 'AC');  
        $this->db->where('t.is_deleted', '0');    
        $this->db->where('t.status', 'AC');

        if(!empty($startDate)){
            $this->db->where('ps.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('ps.add_date <=', $endDate);
        }
        
        $this->db->order_by("ps.add_date", "DESC");  
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();
     
        return $result;
    }


    function getStoreUseProductInfo($startDate = '', $endDate = ''){
        $this->db->select('ps.id, ps.product_id, ps.customer_name, ps.quantity, i.cost_of_sell, i.sell_tax, ps.add_date, i.title productName');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_invetory as i', 'i.id = ps.product_id');
        $this->db->where('ps.is_deleted', '0');    
        $this->db->where('ps.sale_type', 'use');  
        $this->db->where('ps.status', 'AC');  

        if(!empty($startDate)){
            $this->db->where('ps.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('ps.add_date <=', $endDate);
        }
        
        $this->db->order_by("ps.add_date", "DESC");  
        $query = $this->db->get();
        
        $result = $query->result();  //print_r($this->db->last_query());    die();
     
        return $result;
    }

    function updateSellProductUsingCartId($cartInfo, $cartmaster_id)
    {
        $this->db->where('related_cartmaster_id', $cartmaster_id);
        $this->db->where('is_deleted', '0');
        $this->db->update('tbl_product_sales', $cartInfo);
        return true;
    }

    function getSupplierInventoryInfo($startDate = '', $endDate = '')
    {
        $this->db->select('s.title supplierName, i.title productName, i.invoice_number, DATE_FORMAT(i.date_of_add, "%d %M %Y") addedDate, i.notes, i.quantity, i.cost_of_buy, i.buy_tax, i.id product_id');

        $this->db->from('tbl_invetory i');
        $this->db->join('tbl_suppliers as s', 's.id = i.suppliers_id');

        if(!empty($startDate)){
            $this->db->where('i.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('i.add_date <=', $endDate);
        }

        $this->db->where('i.is_deleted', '0');
        $this->db->order_by("i.suppliers_id", "ASC");
        $this->db->order_by("i.title", "ASC");
        $query = $this->db->get();
        
        $result = $query->result();  // print_r($this->db->last_query());    die();

        /*echo "<pre>";
        print_r($result);
        die();*/

        $arrReturn = array();
        if(!empty($result)){
            foreach ($result as $key => $objInventory) {
                $arrInventory = (array) $objInventory;

                $totalPrice = number_format($objInventory->quantity * $objInventory->cost_of_buy, 2, '.', '');
                $totTax = number_format($totalPrice * ($objInventory->buy_tax / 100), 2, '.', '');

                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['name'] = $objInventory->productName;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['invoice'] = $objInventory->invoice_number;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['addDate'] = $objInventory->addedDate;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['notes'] = $objInventory->notes;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['quantity'] = $objInventory->quantity;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['unitPrice'] = $objInventory->cost_of_buy;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['totPriceExTax'] = $totalPrice;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['discount'] = "0.00";
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['totTax'] = $totTax;
                $arrReturn[$objInventory->supplierName][$objInventory->product_id]['totalPrice'] = ($totalPrice + $totTax);
            }
        }

        /*echo "<pre>";
        print_r(count($arrReturn));
        die();*/

        return $arrReturn;
    }

    function getCustomerUseProductInfo($startDate = '', $endDate = '', $employee = ''){
        $this->db->select('ps.id, ps.product_id, ps.quantity, i.cost_of_sell, i.sell_tax, ps.add_date, i.title productName, CONCAT(cpi.first_name, cpi.last_name) as customerName, cpi.address, CONCAT(t.first_name, t.last_name) as employeeName, DATE_FORMAT(ps.add_date, "%d/%m/%Y %h:%i:%s %p") saleDate');
        $this->db->from('tbl_product_sales as ps');
        $this->db->join('tbl_invetory as i', 'i.id = ps.product_id');
        $this->db->join('tbl_team as t', 't.id = ps.team_id');
        $this->db->join('tbl_cartmaster as cm', 'cm.id = ps.related_cartmaster_id');
        $this->db->join('tbl_cart_personal_info as cpi', 'cm.id = cpi.cartmaster_id');
        $this->db->where('ps.is_deleted', '0');    
        $this->db->where('cm.is_deleted', '0');    
        $this->db->where('cpi.is_deleted', '0');    
        $this->db->where('ps.sale_type', 'cart');  
        $this->db->where('ps.status', 'AC');  

        if(!empty($startDate)){
            $this->db->where('ps.add_date >=', $startDate);
        }

        if(!empty($endDate)){
            $this->db->where('ps.add_date <=', $endDate);
        }

        if(!empty($employee)){
            $this->db->where('ps.team_id =', $employee);
        }
        
        $this->db->order_by("employeeName", "ASC");  
        $this->db->order_by("ps.add_date", "DESC");  
        $query = $this->db->get();
        
        $result = $query->result();  //print_r($this->db->last_query());    die();

        /*echo "<pre>";
        print_r($result);
        die();*/

        $arrReturn = array();
        if(!empty($result)){
            foreach ($result as $key => $objCart) {
                $totalPrice = number_format($objCart->quantity * $objCart->cost_of_sell, 2, '.', '');
                $totTax = number_format($totalPrice * ($objCart->sell_tax / 100), 2, '.', '');

                $arrReturn[$objCart->employeeName][$objCart->id]['date'] = $objCart->saleDate;
                $arrReturn[$objCart->employeeName][$objCart->id]['productName'] = $objCart->productName;
                $arrReturn[$objCart->employeeName][$objCart->id]['cusName'] = $objCart->customerName;
                $arrReturn[$objCart->employeeName][$objCart->id]['address'] = $objCart->address;
                $arrReturn[$objCart->employeeName][$objCart->id]['quantity'] = $objCart->quantity;
                $arrReturn[$objCart->employeeName][$objCart->id]['price'] = ($totalPrice + $totTax);
            }
        }
        
        /*echo "<pre>";
        print_r($arrReturn);
        die();*/
        
        return $arrReturn;
    }
}

  