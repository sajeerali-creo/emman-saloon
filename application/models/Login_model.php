<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Login_model extends CI_Model
{
    
    
    function loginAdmin($username, $password)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId, Roles.role, BaseTbl.parentUserId, BaseTbl.profilepic, BaseTbl.fl_notification');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.username', $username);
		$this->db->where_in('BaseTbl.roleId', array('1', '2', '3', '4'));
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.active', 1);
        $query = $this->db->get();
       
        
        $user = $query->row();
        
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkUserExist($username)
    {
        $this->db->select('userId');
        $this->db->where('username', $username);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function checkActiveUserExist($username)
    {
        $this->db->select('userId');
        $this->db->where('username', $username);
        $this->db->where('isDeleted', 0);
        $this->db->where('active', 1);

        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('userId');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPassword($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

     /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByUsername($username)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($username, $activation_id, $user_type = 'admin')
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('username', $username);
        $this->db->where('user_type', $user_type);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createNewPassword($username, $password, $user_type = 'admin')
    {
        $this->db->where('username', $username);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));

        $this->db->where('tbl_reset_password.user_type', $user_type);
        $this->db->delete('tbl_reset_password', array('username'=>$username));
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

    /**
     * This function is used to get last login info by user id
     * @param number $userId : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    }
    function getRoleRedirectLink($roleId)
    {
        $this->db->select('BaseTbl.firstpage');
        $this->db->where('BaseTbl.roleId', $roleId);
        $this->db->order_by('BaseTbl.roleId', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_roles as BaseTbl');

        return $query->row();
    }


    function loginCustomer($username, $password)
    {
        $this->db->select('id, first_name, last_name, email, phone_number, location_full_address, location_lat, location_lng, password');
        $this->db->from('tbl_customers');
        $this->db->where('username', $username);
        $this->db->where('is_deleted', "0");
        $this->db->where('status', 'AC');
        $query = $this->db->get();
       
        $user = $query->row();

        if(!empty($user)){
            return $user;
        } 
        else {
            return array();
        }
    }

    function checkActiveCustomerExist($username)
    {
        $this->db->select('id as userId');
        $this->db->where('username', $username);
        $this->db->where('is_deleted', "0");
        $this->db->where('status', 'AC');

        $query = $this->db->get('tbl_customers');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function getFrontCustomerInfoByUsername($username)
    {
        $this->db->select('id as userId, first_name, last_name, email');
        $this->db->from('tbl_customers');
        $this->db->where('is_deleted', "0");
        $this->db->where('status', 'AC');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->row();
    }

    // This function used to create new password by reset link
    function createNewCustomerPassword($username, $password, $user_type = 'customer')
    {
        $this->db->where('username', $username);
        $this->db->where('is_deleted', '0');
        $this->db->update('tbl_customers', array('password'=>getHashedPassword($password)));

        $this->db->where('tbl_reset_password.user_type', $user_type);
        $this->db->delete('tbl_reset_password', array('username'=>$username));
    }
}

?>