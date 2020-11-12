<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : booking (UserController)
 * booking Class to control all user related operations.
 * @author : Ansi
 * @version : 1.1
 * @since : 14 July 2020
 */
class Reports extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking_model');
        $this->load->model('service_model');
        $this->load->model('team_model');
        $this->load->model('customers_model');
        $this->load->model('cart_model');
        $this->load->model('report_model');
        $this->load->model('invetory_model');
        $this->isLoggedIn();   
    }
   
    function listing($pagination = "")
    {
        if($this->isAdminCommon() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $sDate = $this->security->xss_clean($this->input->get('sDate'));
            $eDate = $this->security->xss_clean($this->input->get('eDate'));

            if(empty($sDate)){
                $sDate = date("F d, Y", strtotime("-0days"));
            }
            else{
                $sDate = date("F d, Y", strtotime($sDate));
            }

            if(empty($eDate)){
                $eDate = date("F d, Y");
            }
            else{
                $eDate = date("F d, Y", strtotime($eDate));
            }

            $this->startDate = date("Y-m-d 00:00:00", strtotime($sDate));
            $this->endDate = date("Y-m-d 23:59:59", strtotime($eDate));

            $data['sDate'] = $sDate;
            $data['eDate'] = $eDate;
            $data['dataRecords'] = $this->booking_model->bookingListing($this->startDate, $this->endDate, true);
            $data['teamInfo'] = $this->team_model->teamListing();
                        
            $this->global['pageTitle'] = PROJECT_NAME . ' : Reports';
            $data['pagePath'] = 'ReportList';
            
            $this->loadViews("admin/reports/listing", $this->global, $data, NULL);
        }
    }

    function samplePdf()
    {
        $this->load->library('pdfgenerator');


        $this->pdfgenerator->generate("test", "sample");
    }

    function generatePDF()
    {
        $sDate = $this->security->xss_clean($this->input->get('sDate'));
        $eDate = $this->security->xss_clean($this->input->get('eDate'));
        $type = $this->security->xss_clean($this->input->get('type'));
        $employee = $this->security->xss_clean($this->input->get('employee'));

        if(empty($sDate)){
            $sDate = date("F d, Y", strtotime("-0days"));
        }
        else{
            $sDate = date("F d, Y", strtotime($sDate));
        }

        if(empty($eDate)){
            $eDate = date("F d, Y");
        }
        else{
            $eDate = date("F d, Y", strtotime($eDate));
        }

        $this->startDate = date("Y-m-d 00:00:00", strtotime($sDate));
        $this->endDate = date("Y-m-d 23:59:59", strtotime($eDate));

        $data['sDate'] = $sDate;
        $data['eDate'] = $eDate;

        switch ($type) {
            case 'TRSUM':
                //Function for generate trading summary report
                $strHtml = $this->getTradingSummaryReport($this->startDate, $this->endDate);
                $strFileName = 'Trading_summary';
                break;

            case 'PSU':
                //Function for generate trading summary report
                $strHtml = $this->getProfessionalStockUsageReport($this->startDate, $this->endDate);
                $strFileName = 'Professional_Stock_Usage';
                break;

            case 'TBE':
                //Function for generate trading summary report
                $strHtml = $this->getTransactionByEmployeeReport($this->startDate, $this->endDate, $employee);
                $strFileName = 'Transactions_by_Employee';
                break;
            
            case 'SBDC':
                //Function for generate trading summary report
                $strHtml = $this->getServiceByCategoryReport($this->startDate, $this->endDate);
                $strFileName = 'Service_Breakdown_by_Category';
                break;
            
            case 'INSR':
                //Function for generate trading summary report
                $strHtml = $this->getStockReceivedReport($this->startDate, $this->endDate);
                $strFileName = 'Stock_Received';
                break;

            case 'PUBE':
                //Function for generate trading summary report
                $strHtml = $this->getProductUseEmployeeReport($this->startDate, $this->endDate, $employee);
                $strFileName = 'Product_Use_by_Employees';
                break;
            
            case 'EMSB':
                //Function for generate trading summary report
                $strHtml = $this->getEmployeeBreakdownReport($this->startDate, $this->endDate, $employee);
                $strFileName = 'Employee_Monthly_Breakdown';
                break;
            
            default:
                $strHtml = 'Invalid request';
                $strFileName = 'invalid_request';
                break;
        }

        // echo $strHtml;die();
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($strHtml, $strFileName . "_" . date("YmdHis"));
    }

    function getLogoPath()
    {
        $path = dirname(dirname(dirname(dirname(__FILE__)))) . "/assets/report/logo.png";
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    function getDateDifference($startDate, $endDate){
        $end_date = strtotime($endDate);
        $start_date = strtotime($startDate);
        $datediff = $end_date - $start_date;

        $days = round($datediff / (60 * 60 * 24));

        if($days < 7){
            if($days == 1){
                return $days . " Day";
            }
            else{
                return $days . " Days";
            }
        }
        else{
            if($days == 7){
                return $days . " Days (1 Week)";
            }
            else {
                return $days . " Days (" . number_format($days / 7, 1) . " Weeks)";
            }
        }
    }


    function getTradingSummaryReport($startDate, $endDate)
    {

        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);



        $arrSalesInfo = $this->getTotalSales($startDate, $endDate);
        $arrSaleServicesInfo = $this->getTotalSalesServices($startDate, $endDate);
        $arrEmployeeSaleServicesInfo = $this->getEmployeeTradeReport($startDate, $endDate);

        /*echo "<pre>";
        print_r($arrSalesInfo);
        die();*/

        if(!empty($arrSalesInfo)){
            $data['takings_cash'] = number_format($arrSalesInfo['cash'], 2, '.', '');
            $data['takings_card'] = number_format($arrSalesInfo['card'], 2, '.', '');
        }
        else{
            $data['takings_cash'] = "0.00";
            $data['takings_card'] = "0.00";
        }

        if(!empty($arrSaleServicesInfo)){
            $data['service_qty'] = $arrSaleServicesInfo['qty'];
            $data['service_exTax_price'] = number_format($arrSaleServicesInfo['price'], 2);
            $data['service_total'] = number_format($arrSaleServicesInfo['toalPrice'], 2);
            $data['service_total_tax'] = number_format($arrSaleServicesInfo['toalTax'], 2);
        }
        else{
            $data['service_qty'] = "0";
            $data['service_exTax_price'] = "0.00";
            $data['service_total'] = "0.00";
            $data['service_total_tax'] = "0.00";
        }

        $data["employeeSalesReport"] = $arrEmployeeSaleServicesInfo;

        $data['takings_total'] = number_format((number_format($data['takings_cash'], 2, '.', '') + number_format($data['takings_card'], 2, '.', '')), 2);

        $reportTemplate = $this->load->view('reportspdf/TRSUM', $data, true);

        return $reportTemplate;
    }

    function getProfessionalStockUsageReport($startDate, $endDate)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);

        $arrProductUseInfo = $this->getStoreUseProductInfo($startDate, $endDate);
        $data["productInfo"] = $arrProductUseInfo;

        $reportTemplate = $this->load->view('reportspdf/PSU', $data, true);

        return $reportTemplate;
    }

    function getTransactionByEmployeeReport($startDate, $endDate, $employee)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);

        $employeeName = '';
        if($employee != 'all'){
            $employeeName = $this->getEmployeeName($employee);
        }
        if(empty($employeeName)){
            $employeeName = "All Employees";
        }
        $data["employeeName"] = $employeeName;

        $arrData = $this->getEmployeeServiceFullInfo($startDate, $endDate, $employee);
        $data["arrEmployeeServiceInfo"] = $arrData;


        $reportTemplate = $this->load->view('reportspdf/TBE', $data, true);

        return $reportTemplate;
    }

    function getServiceByCategoryReport($startDate, $endDate)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);
        $data["arrClusterInfo"] = $this->getAllClusters();;

        $arrServiceInfo = $this->getServicesByCategoryInfo($startDate, $endDate);

        $data["arrAllServicesInfo"] = $arrServiceInfo;

        $reportTemplate = $this->load->view('reportspdf/SBDC', $data, true);

        return $reportTemplate;
    }

    function getStockReceivedReport($startDate, $endDate)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);

        $arrData = $this->getSupplierInventoryInfo($startDate, $endDate);

        $data["arrAllStockInfo"] = $arrData;

        $reportTemplate = $this->load->view('reportspdf/INSR', $data, true);

        return $reportTemplate;
    }

    function getProductUseEmployeeReport($startDate, $endDate, $employee)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);

        $employeeName = '';
        if($employee != 'all'){
            $employeeName = $this->getEmployeeName($employee);
        }
        if(empty($employeeName)){
            $employeeName = "All Employees";
        }
        $data["employeeName"] = $employeeName;

        $arrData = $this->getCustomerUseProductInfo($startDate, $endDate, $employee);
        $data["arrEmployeeSaleInfo"] = $arrData;

        $reportTemplate = $this->load->view('reportspdf/PUBE', $data, true);

        return $reportTemplate;
    }

    function getEmployeeBreakdownReport($startDate, $endDate, $employee)
    {
        $data = array();
        $data['logo'] = $this->getLogoPath();
        $data["fromDate"] = date("l, d F, Y", strtotime($startDate));
        $data["toDate"] = date("l, d F, Y", strtotime($endDate));
        $data["datePeriod"] = $this->getDateDifference($startDate, $endDate);

        $arrData = $this->getEmployeeServiceWeeklyInfo($startDate, $endDate, $employee);
        $data["arrEmployeeServiceInfo"] = $arrData;

        $employeeName = '';
        if($employee != 'all'){
            $employeeName = $this->getEmployeeName($employee);
        }
        if(empty($employeeName)){
            $employeeName = "All Employees";
        }
        $data["employeeName"] = $employeeName;

        $reportTemplate = $this->load->view('reportspdf/EMSB', $data, true);

        return $reportTemplate;
    }

    function getTotalSales($startDate, $endDate){
        $arrResult = $this->report_model->getTotalSales($startDate, $endDate);

        $arrReturn = array("card" => 0, "cash" => 0);
        foreach ($arrResult as $key => $value) {
            $arrReturn[$value->payment_type] = $value->totalPrice;
        }

        return $arrReturn;
    }

    function getTotalSalesServices($startDate, $endDate)
    {
        $arrSaleServicesInfo = $this->report_model->getTotalSalesServices($startDate, $endDate);

        /*echo "<pre>";
        print_r($arrSaleServicesInfo);
        die();*/
        $arrReturn = array();

        $arrReturn['qty'] = 0;
        $arrReturn['price'] = 0;
        $arrReturn['toalPrice'] = 0;
        $arrReturn['toalTax'] = 0;
        foreach ($arrSaleServicesInfo as $key => $value) {
            $arrReturn['qty'] += $value->services;
            $price = ((number_format($value->price, 2, '.', '') + number_format($value->service_charge, 2, '.', '')) * $value->services);

            $price -= $price * ($value->discount_price / 100);
            $price = $value->extra_service_charge + number_format($price, 2, '.', '');
            
            $tax = number_format($price * ($value->vat / 100), 2, '.', '');
            $arrReturn['price'] += $price;
            $arrReturn['toalPrice'] += ($price + $tax);
            $arrReturn['toalTax'] += ($tax);
        }

        return $arrReturn;
    }

    function getEmployeeTradeReport($startDate, $endDate)
    {
        $arrSaleServicesInfo = $this->report_model->getEmployeeSalesServices($startDate, $endDate);
        $arrSaleProductInfo = $this->report_model->getToalProductSales($startDate, $endDate);
        $arrServiceInfo = $this->getFullServiceInfo();

        /*echo "<pre>";
        print_r($arrSaleServicesInfo);
        print_r($arrSaleProductInfo);
        print_r($arrServiceInfo);
        die();*/

        $arrReturn = array();
        $totalPrice = 0;
        foreach ($arrSaleServicesInfo as $key => $value) {
            $serviceCost = (number_format($value->price, 2, '.', '') * $value->services);
            $serviceCharge = (number_format($value->service_charge, 2, '.', '') * $value->services);
            $total = $serviceCost + $serviceCharge;
            $totalPrice += $total;

            if(!isset($arrReturn[$value->team_id])){
                $arrReturn[$value->team_id]['product_sale'] = 0;
                $arrReturn[$value->team_id]['serviceCost'] = $serviceCost;
                $arrReturn[$value->team_id]['serviceCharge'] = $serviceCharge;
                $arrReturn[$value->team_id]['total'] = $total;
                $arrReturn[$value->team_id]['slots'] = $arrServiceInfo[$value->service_id]['time_duration'] * 2;
            }
            else{
                $arrReturn[$value->team_id]['serviceCost'] += $serviceCost;
                $arrReturn[$value->team_id]['serviceCharge'] += $serviceCharge;
                $arrReturn[$value->team_id]['total'] += $total;
                $arrReturn[$value->team_id]['slots'] += $arrServiceInfo[$value->service_id]['time_duration'] * 2;
            }
            $arrReturn[$value->team_id]['name'] = trim($value->first_name . " " . $value->last_name);
        }

        foreach ($arrSaleProductInfo as $key => $value) {
            if(!isset($arrReturn[$value->team_id])){
                $arrReturn[$value->team_id]['serviceCost'] = 0;
                $arrReturn[$value->team_id]['serviceCharge'] = 0;
                $arrReturn[$value->team_id]['slots'] = 0;
                $arrReturn[$value->team_id]['product_sale'] = $value->totalPrice;
                $arrReturn[$value->team_id]['total'] = $value->totalPrice;
                $arrReturn[$value->team_id]['name'] += trim($value->first_name . " " . $value->last_name);
            }
            else{
                $arrReturn[$value->team_id]['product_sale'] = $value->totalPrice;
                $arrReturn[$value->team_id]['total'] += $value->totalPrice;
            }

            $totalPrice += $value->totalPrice;
        }

        $arrTempFinal = array();
        $arrTempPrice = array();

        foreach ($arrReturn as $key => $value) {
            $arrTempFinal[$key] = $value; 
            $arrTempFinal[$key]['totPercentage'] = number_format(($value['total'] / $totalPrice) * 100, 2, '.', '');
            $totalTime = $value['slots'] * 15;
            $totalTimeInHr = $value['slots'] / 4;
            $totalTimeString = floor($totalTime / 60) . " Hrs " . ($totalTime % 60) . " Mins";
            
            if($value['slots'] < 5){
                $serviceSaleInHr = number_format($value['total'], 2, '.', '');
            }
            else{
                $serviceSaleInHr = number_format($value['total'] / $totalTimeInHr, 2, '.', '');
            }

            $arrTempFinal[$key]['totalTime'] = $value['slots'] * 15;
            $arrTempFinal[$key]['strTotalTime'] = $totalTimeString;
            $arrTempFinal[$key]['serviceSaleInHr'] = $serviceSaleInHr;

            $arrTempPrice[$key] = $value['total'];
        }

        arsort($arrTempPrice);
        $arrFinal = array();
        foreach ($arrTempPrice as $key => $value) {
            $arrFinal[] = $arrTempFinal[$key]; 
        }

        /*echo "<pre>";
        echo $totalPrice;
        print_r($arrFinal);
        print_r($arrTempFinal);
        print_r($arrTempPrice);
        die();*/

        unset($arrSaleServicesInfo);
        unset($arrSaleProductInfo);
        unset($arrServiceInfo);
        unset($arrTempFinal);
        unset($arrTempPrice);
        unset($arrReturn);

        return $arrFinal;
    }

    function getFullServiceInfo()
    {
        $arrServices = $this->service_model->getAllServices();
        $arrReturn = array();
        
        foreach ($arrServices as $key => $value) {
            $arrReturn[$value->id] = (array)$value;
        }

        return $arrReturn;
    }

    function getStoreUseProductInfo($startDate, $endDate)
    {
        $arrData = $this->invetory_model->getStoreUseProductInfo($startDate, $endDate);
        
        $arrTempResult = array();
        $arrTempPrice = array();
        foreach ($arrData as $key => $value) {
            if(!isset($arrTempResult[$value->product_id])){
                $arrTempResult[$value->product_id]["product_id"] = $value->product_id;
                $arrTempResult[$value->product_id]["productName"] = $value->productName;
                $arrTempResult[$value->product_id]["cost_of_sell"] = $value->cost_of_sell;
                $arrTempResult[$value->product_id]["sell_tax"] = $value->sell_tax;
                $arrTempResult[$value->product_id]["quantity"] = $value->quantity;
                $total = number_format($value->cost_of_sell * $value->quantity, 2, '.', '');
                $tax = number_format($total * ($value->sell_tax / 100), 2, '.', '');
                $arrTempResult[$value->product_id]["totalExcludeTax"] = $total;
                $arrTempResult[$value->product_id]["totalTax"] = $tax;
                $arrTempResult[$value->product_id]["total"] = ($total + $tax);
            }
            else{
                $arrTempResult[$value->product_id]["quantity"] += $value->quantity;
                $total = number_format($value->cost_of_sell * $value->quantity, 2, '.', '');
                $tax = number_format($total * ($value->sell_tax / 100), 2, '.', '');
                $arrTempResult[$value->product_id]["totalExcludeTax"] += $total;
                $arrTempResult[$value->product_id]["totalTax"] += $tax;
                $arrTempResult[$value->product_id]["total"] += ($total + $tax);
            }

            $arrTempPrice[$value->product_id] = $arrTempResult[$value->product_id]["total"];
        }

        arsort($arrTempPrice);
        $arrFinal = array();
        foreach ($arrTempPrice as $key => $value) {
            $arrFinal[] = $arrTempResult[$key]; 
        }

        unset($arrData);
        unset($arrTempPrice);
        unset($arrTempResult);

        /*echo "<pre>";
        print_r($arrFinal);
        die();*/

        return $arrFinal;
    }

    function getServicesByCategoryInfo($startDate, $endDate)
    {
        $arrData = $this->booking_model->getServicesByCategoryInfo($startDate, $endDate);

        return $arrData;
    }

    function getAllClusters(){
        $objCluster = $this->service_model->getAllClusters();
        $arrCluster = array();
        foreach ($objCluster as $key => $value) {
            $arrCluster[$value->id] = $value->title;
        }
        return $arrCluster;
    }

    function getEmployeeName($employeeId){
        $arrInfo = $this->team_model->getTeamInfo($employeeId);

        if(!empty($arrInfo)){
            return $arrInfo->first_name . " " . $arrInfo->last_name;
        }
        else{
            return '';
        }
    }

    function getSupplierInventoryInfo($startDate, $endDate)
    {
        $arrData = $this->invetory_model->getSupplierInventoryInfo($startDate, $endDate);

        return $arrData;
    }

    function getCustomerUseProductInfo($startDate, $endDate, $employee)
    {
        if($employee == 'all'){
            $employee = '';
        }

        $arrData = $this->invetory_model->getCustomerUseProductInfo($startDate, $endDate, $employee);
        return $arrData;
    }

    function getEmployeeServiceWeeklyInfo($startDate, $endDate, $employee)
    {
        if($employee == 'all'){
            $employee = '';
        }

        $arrData = $this->booking_model->getEmployeeServiceWeeklyInfo($startDate, $endDate, $employee);
        return $arrData;
    }

    function getEmployeeServiceFullInfo($startDate, $endDate, $employee)
    {
        if($employee == 'all'){
            $employee = '';
        }

        $arrData = $this->booking_model->getEmployeeServiceFullInfo($startDate, $endDate, $employee);
        return $arrData;
    }
}

?>