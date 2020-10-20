<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "Frontcontroller"; //Home page
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = false;


$route['map'] = 'frontcontroller/map';
$route['service'] = 'frontcontroller/service';
$route['date-select'] = 'frontcontroller/dateSelect';
$route['add-personal-info'] = 'frontcontroller/addPersonalInfo';
$route['save-personal-info'] = 'frontcontroller/savePersonalInfo';
$route['save-personal-info-only'] = 'frontcontroller/savePersonalInfoOnly';
$route['order-confirm'] = 'frontcontroller/orderConfirm';
$route['save-order-confirm-info'] = 'frontcontroller/saveOrderConfirmInfo';
$route['thankyou'] = 'frontcontroller/thankyou';
$route['order-history'] = 'frontcontroller/orderHistory';

$route['login'] = 'frontcontroller/login';
$route['login-user'] = 'frontcontroller/loginUser';
$route['register'] = 'frontcontroller/register';
$route['save-register-info'] = 'frontcontroller/saveRegisterInfo';
$route['logout'] = 'frontcontroller/logout';
$route['forgot-password'] = 'frontcontroller/forgotPassword';
$route['resetpassword'] = 'frontcontroller/resetPassword';
$route['confirmresetpassword'] = "frontcontroller/confirmResetPassword";
$route['confirmresetpassword/(:any)'] = "frontcontroller/confirmResetPassword/$1";
$route['confirmresetpassword/(:any)/(:any)'] = "frontcontroller/confirmResetPassword/$1/$2";
$route['createnewpassword'] = "frontcontroller/createNewPassword";

/*********** USER DEFINED ROUTES *******************/

$route['securepanel'] = "admin/user";
$route['securepanel/login'] = "admin/Backcontroller";
$route['securepanel/loginadmin'] = "admin/Backcontroller/loginAdmin";
$route['securepanel/register'] = "admin/Backcontroller/register";
$route['securepanel/registration'] = "admin/Backcontroller/registration";

$route['securepanel/dashboard'] = 'admin/user';
$route['securepanel/logout'] = 'admin/user/logout';
$route['securepanel/users'] = 'admin/user/users';
$route['securepanel/users/(:num)'] = "admin/user/users/$1";
$route['securepanel/addnewuser'] = "admin/user/addNewUser";
$route['securepanel/addnewuserdetails'] = "admin/user/addNewUserDetails";
$route['securepanel/edituser'] = "admin/user/edituser";
$route['securepanel/edituser/(:num)'] = "admin/user/edituser/$1";
$route['securepanel/assigntags'] = "admin/user/assigntags";
$route['securepanel/assigntags/(:num)'] = "admin/user/assigntags/$1";
$route['securepanel/updateuser'] = "admin/user/updateuser";
$route['securepanel/updateassigntagsinfo'] = "admin/user/updateusertagsinfo";
$route['securepanel/deleteuser'] = "admin/user/deleteuser";
$route['securepanel/activedeactiveuser'] = "admin/user/activedeactiveuser";
$route['securepanel/profile'] = "admin/user/profile";
$route['securepanel/profile/(:any)'] = "admin/user/profile/$1";
$route['securepanel/profileupdate'] = "admin/user/profileUpdate";
$route['securepanel/profileUpdate/(:any)'] = "admin/user/profileUpdate/$1";
$route['securepanel/getparentlists'] = "admin/user/getparentlists";
$route['securepanel/getclasslist'] = "admin/user/getclasslist";
$route['securepanel/getteacherinfo'] = "admin/user/getteacherinfo";

$route['securepanel/loadChangePass'] = "admin/user/loadChangePass";
$route['securepanel/changepassword'] = "admin/user/changePassword";
$route['securepanel/changepassword/(:any)'] = "admin/user/changePassword/$1";
$route['securepanel/pageNotFound'] = "admin/user/pageNotFound";
$route['securepanel/checkEmailExists'] = "admin/user/checkEmailExists";
$route['securepanel/checkcustomerusernameexists'] = "admin/user/checkCustomerUsernameExists";
$route['securepanel/checkusernameexists'] = "admin/user/checkUsernameExists";
$route['securepanel/checkusernameexistregistration'] = "admin/Backcontroller/checkUsernameExistRegistration";
$route['securepanel/login-history'] = "admin/user/loginHistoy";
$route['securepanel/login-history/(:num)'] = "admin/user/loginHistoy/$1";
$route['securepanel/login-history/(:num)/(:num)'] = "admin/user/loginHistoy/$1/$2";

$route['securepanel/forgotpassword'] = "admin/Backcontroller/forgotPassword";
$route['securepanel/resetpassword'] = "admin/Backcontroller/resetPassword";
$route['securepanel/confirmresetpassword'] = "admin/Backcontroller/confirmResetPassword";
$route['securepanel/confirmresetpassword/(:any)'] = "admin/Backcontroller/confirmResetPassword/$1";
$route['securepanel/confirmresetpassword/(:any)/(:any)'] = "admin/Backcontroller/confirmResetPassword/$1/$2";
$route['securepanel/createnewpassword'] = "admin/Backcontroller/createNewPassword";

$route['updatecompletedclassdetails'] = "Frontcontroller/updateCompletedClassDetails";
$route['thank-you1-for-using-emcsquared'] = 'Frontcontroller/thankyou1';


$route['securepanel/services'] = 'admin/Services/servicesListing';
$route['securepanel/add-service'] = "admin/Services/addNewService";
$route['securepanel/add-service/(:num)'] = "admin/Services/addNewService/$1";
$route['securepanel/add-service-info'] = "admin/Services/addNewServiceInformation";
$route['securepanel/edit-service'] = "admin/Services/editService";
$route['securepanel/edit-service/(:num)'] = "admin/Services/editService/$1";
$route['securepanel/update-service'] = "admin/Services/updateService";
$route['securepanel/delete-service'] = "admin/Services/deleteServices";

$route['securepanel/suppliers'] = 'admin/Suppliers/suppliersListing';
$route['securepanel/add-supplier'] = "admin/Suppliers/addNewSupplier";
$route['securepanel/add-supplier/(:num)'] = "admin/Suppliers/addNewSupplier/$1";
$route['securepanel/add-supplier-info'] = "admin/Suppliers/addNewSupplierInformation";
$route['securepanel/edit-supplier'] = "admin/Suppliers/editSupplier";
$route['securepanel/edit-supplier/(:num)'] = "admin/Suppliers/editSupplier/$1";
$route['securepanel/detail-supplier'] = "admin/Suppliers/detailSupplier";
$route['securepanel/detail-supplier/(:num)'] = "admin/Suppliers/detailSupplier/$1";
$route['securepanel/update-supplier'] = "admin/Suppliers/updateSupplier";
$route['securepanel/delete-supplier'] = "admin/Suppliers/deleteSupplier";


$route['securepanel/settings'] = "admin/user/settings";
$route['securepanel/settingsupdate'] = "admin/user/settingsUpdate";


$route['securepanel/notification'] = "admin/Booking/notification";
$route['securepanel/booking'] = "admin/Booking/listing";
$route['securepanel/booking-calendar'] = "admin/Booking/listingCalendar";
$route['securepanel/add-booking'] = "admin/Booking/addNewBooking";
$route['securepanel/add-booking-info'] = "admin/Booking/addNewBookingInformation";
$route['securepanel/edit-booking'] = "admin/Booking/editBooking";
$route['securepanel/edit-booking/(:num)'] = "admin/Booking/editBooking/$1";
$route['securepanel/update-booking'] = "admin/Booking/updateBooking";
$route['securepanel/confirm-booking'] = "admin/Booking/confirmBooking";
$route['securepanel/view-booking'] = "admin/Booking/viewBooking";
$route['securepanel/view-booking/(:num)'] = "admin/Booking/viewBooking/$1";


$route['securepanel/team'] = "admin/Team/listing";
$route['securepanel/calender-team'] = "admin/Team/calenderTeam";
$route['securepanel/add-team'] = "admin/Team/addNewTeam";
$route['securepanel/add-team/(:num)'] = "admin/Team/addNewTeam/$1";
$route['securepanel/add-team-info'] = "admin/Team/addNewTeamInformation";
$route['securepanel/edit-team'] = "admin/Team/editTeam";
$route['securepanel/edit-team/(:num)'] = "admin/Team/editTeam/$1";
$route['securepanel/detail-team'] = "admin/Team/detailTeam";
$route['securepanel/detail-team/(:num)'] = "admin/Team/detailTeam/$1";
$route['securepanel/update-team'] = "admin/Team/updateTeam";
$route['securepanel/delete-team'] = "admin/Team/deleteTeam";


$route['securepanel/invetory'] = "admin/Invetory/listing";
$route['securepanel/add-product'] = "admin/Invetory/addNewProduct";
$route['securepanel/add-product-info'] = "admin/Invetory/addNewProductInformation";
$route['securepanel/edit-product'] = "admin/Invetory/editProduct";
$route['securepanel/edit-product/(:num)'] = "admin/Invetory/editProduct/$1";
$route['securepanel/update-product'] = "admin/Invetory/updateProduct";
$route['securepanel/delete-product'] = "admin/Invetory/deleteProduct";
$route['securepanel/sell-product'] = "admin/Invetory/sellProduct";
$route['securepanel/add-sell-product-info-ajax'] = "admin/Invetory/addSellProductInformation";


$route['securepanel/customers'] = "admin/Customers/listing";
$route['securepanel/delete-customer'] = "admin/Customers/deleteCustomer";


$route['serviceboy'] = 'serviceboycontroller/index';
$route['serviceboy/login'] = 'serviceboycontroller/login';
$route['serviceboy/logout'] = 'serviceboycontroller/logout';
$route['serviceboy/login-user'] = 'serviceboycontroller/loginUser';
$route['serviceboy/reject-order'] = 'serviceboycontroller/rejectOrder';
$route['serviceboy/confirm-order'] = 'serviceboycontroller/confirmOrder';
$route['serviceboy/complete-order'] = 'serviceboycontroller/completeOrder';
$route['serviceboy/details'] = "serviceboycontroller/orderDetails";
$route['serviceboy/details/(:num)'] = "serviceboycontroller/orderDetails/$1";
$route['serviceboy/thankyou'] = 'serviceboycontroller/thankyou';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
