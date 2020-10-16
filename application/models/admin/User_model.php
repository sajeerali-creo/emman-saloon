<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

    function usersCount($searchText = '', $searchRole = '', $searchparentLevel1 = "", $role = "", $userId = "", $selectedActiveStatus){
        if($role == ROLE_TEACHER){
            $userInfo = $this->user_model->getUserInfo($userId);
        }
        
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role , BaseTbl1.name parentName, BaseTbl.profilepic profilepic');
        $this->db->from('tbl_users as BaseTbl');
		$this->db->join('tbl_users as BaseTbl1', 'BaseTbl1.userId = BaseTbl.parentUserId');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.lname  LIKE '%".$searchText."%'
                            OR  BaseTbl.username  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }		

		if(!empty($searchRole)) {           
            $likeCriteria2 = "(BaseTbl.roleId  = '".$searchRole."')";
            $this->db->where($likeCriteria2);			
        }

        if($selectedActiveStatus ==0 || $selectedActiveStatus == 1){           
            $likeCriteria2 = "(BaseTbl.active  = '".$selectedActiveStatus."')";
            $this->db->where($likeCriteria2);			
        }

        if((!empty($searchRole) && $searchRole == ROLE_STUDENT) || $role == ROLE_TEACHER){
            $this->db->select('tblClass.name className');
            $this->db->join('tbl_schoolgrades as tblClass', 'tblClass.schoolgradeId = BaseTbl.schoolgradeId');
            $this->db->where('tblClass.isDeleted', 0);
        }
		if(!empty($searchparentLevel1)) {
            $likeCriteria3 = "(BaseTbl.parentUserId  = '".$searchparentLevel1."' OR BaseTbl.userId  = '".$searchparentLevel1."')";
            $this->db->where($likeCriteria3);
			
        }
        if(!empty($role)) {
            if($role == ROLE_ADMIN){
            
                $likeCriteria3 = "(BaseTbl.parentUserId  = '".$userId."')";
                $this->db->where($likeCriteria3);
            }
            if($role == ROLE_TEACHER){
                
            
                $likeCriteria3 = "(BaseTbl.parentUserId  = '".$userInfo->parentUserId."') AND (BaseTbl.roleId = '".ROLE_STUDENT."')";
                $this->db->where($likeCriteria3);
            }			
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl1.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
		
        
        return $query->num_rows();
    }
    
    
    function users($searchText = '', $page, $segment,   $searchRole = '' , $searchparentLevel1 = "", $sortorderSelected, $sortorderNameSelected,  $role = "", $userId = "", $selectedActiveStatus)
    {
        if($role == ROLE_TEACHER){
            $userInfo = $this->user_model->getUserInfo($userId);
        }
        
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role , BaseTbl1.name parentName, BaseTbl.profilepic profilepic, BaseTbl.lname, BaseTbl.active ');
        $this->db->from('tbl_users as BaseTbl');
		$this->db->join('tbl_users as BaseTbl1', 'BaseTbl1.userId = BaseTbl.parentUserId');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
            OR  BaseTbl.name  LIKE '%".$searchText."%'
            OR  BaseTbl.lname  LIKE '%".$searchText."%'
            OR  BaseTbl.username  LIKE '%".$searchText."%'
            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
		
		if(!empty($searchRole)) {           
            $likeCriteria2 = "(BaseTbl.roleId  = '".$searchRole."')";
            $this->db->where($likeCriteria2);			
        }

        if($selectedActiveStatus == 0 || $selectedActiveStatus == 1){           
            $likeCriteria2 = "(BaseTbl.active  = '".$selectedActiveStatus."')";
            $this->db->where($likeCriteria2);
			
        }
        if((!empty($searchRole) && $searchRole == ROLE_STUDENT) || $role == ROLE_TEACHER){
            $this->db->select('tblClass.name className');
            $this->db->join('tbl_schoolgrades as tblClass', 'tblClass.schoolgradeId = BaseTbl.schoolgradeId');
            $this->db->where('tblClass.isDeleted', 0);
        }
		if(!empty($searchparentLevel1)) {
            $likeCriteria3 = "(BaseTbl.parentUserId  = '".$searchparentLevel1."' OR BaseTbl.userId  = '".$searchparentLevel1."')";
            $this->db->where($likeCriteria3);
			
        }
        if(!empty($role)) {
            if($role == ROLE_ADMIN){
            
                $likeCriteria3 = "(BaseTbl.parentUserId  = '".$userId."')";
                $this->db->where($likeCriteria3);
            }
            if($role == ROLE_TEACHER){
                
            
                $likeCriteria3 = "(BaseTbl.parentUserId  = '".$userInfo->parentUserId."') AND (BaseTbl.roleId = '".ROLE_STUDENT."')";
                $this->db->where($likeCriteria3);
            }
			
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl1.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by($sortorderNameSelected, $sortorderSelected);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();
       // echo $sortorderNameSelected . " " . $sortorderSelected;
        $result = $query->result();        
        return $result;
    }
    
    function getUserRoles($currentRoleId = 0)
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
                  
        $likeCriteria = "roleId IN (" . ROLERESTRICTION . ")";
        $this->db->where($likeCriteria);

            
            
        $query = $this->db->get();
        
        return $query->result();
    }

   
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function checkUsernameExists($username, $userId = 0)
    {
        $this->db->select("username");
        $this->db->from("tbl_users");
        $this->db->where("username", $username);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    function addNewUserDetails($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
   
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId, parentUserId, schoolgradeId, notes, profilepic, lname, username');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    
    function updateuser($userInfo, $userId){

        $this->db->trans_start();        
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        //echo $this->db->last_query();
        $this->db->trans_complete();
        
       // return TRUE;
       return TRUE;
    }
    
    
   
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


   
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

   
    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role, BaseTbl.lname, , BaseTbl.username');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
	
	function allParentRole($roleId = 0)
    {
        $this->db->select('BaseTbl.userId parentUserId, BaseTbl.name name');
        $this->db->from('tbl_users as BaseTbl');		
		
		
		$this->db->where('BaseTbl.isDeleted', 0);
		if($roleId > 0){
			$this->db->where('BaseTbl.roleId', $roleId);
		}
       
        $this->db->order_by('BaseTbl.userId', 'DESC');       
        $query = $this->db->get();
		
        
        $result = $query->result();        
        return $result;
    }
    function allParentClasses($parentRoles = 2)
    {
       
        $this->db->select('BaseTbl.schoolgradeId schoolgradeId, BaseTbl.name name');
        $this->db->from('tbl_schoolgrades as BaseTbl');		
		
		
		$this->db->where('BaseTbl.isDeleted', 0);
		if($parentRoles > 0){
			$this->db->where('BaseTbl.userId', $parentRoles);
		}
       
        $this->db->order_by('BaseTbl.name', 'ASC');       
        $query = $this->db->get();
		//echo $this->db->last_query();
        
        $result = $query->result();        
        return $result;
    }
	function allLevel1Parents($roleId = 2)
    {
        $this->db->select('BaseTbl.userId parentUserId, BaseTbl.name name');
        $this->db->from('tbl_users as BaseTbl');		
		
		
		$this->db->where('BaseTbl.isDeleted', 0);
		if($roleId > 0){
			$this->db->where('BaseTbl.roleId', $roleId);
        }
        
        $likeCriteria = "roleId IN (" . ROLERESTRICTION . ")";
        $this->db->where($likeCriteria);
       
        $this->db->order_by('BaseTbl.userId', 'DESC');       
        $query = $this->db->get();
		
        
        $result = $query->result();        
        return $result;
    }

    function updateFile($filename, $userId)
    {
      
		$userDetails = array('profilepic' => $filename);    
		$this->db->where('userId', $userId);
		$this->db->update('tbl_users', $userDetails); 
		
		
        return TRUE;
    }

    function getUpcomingClassInfoSuperAdmin() {
        $datetime = gmdate('Y-m-d H:i:s');
        $this->db->select("cl.userId, cl.classId, cl.class_name, DATE_FORMAT(cl.class_time, '%b %d, %Y - %a') class_time, '' myStatus, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration ,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName, DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime");
        $this->db->from('tbl_classes cl');
        $this->db->join('tbl_users as User', 'User.userId = cl.userId');
        $this->db->join('tbl_courses as Courses', 'Courses.courseId = cl.courseid');
        $this->db->join('tbl_timezone as timeTbl', 'timeTbl.timezoneId = cl.classtimezone');
        $this->db->where('cl.isDeleted', 0);
        $this->db->where('User.isDeleted', 0);
        $this->db->where('Courses.isDeleted', 0);
       
        $this->db->where('(cl.status = "upcoming" OR cl.status = "live" )');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    function getUpcomingClassInfoMainAdmin($parentUserId) {
        $datetime = gmdate('Y-m-d H:i:s');
        $query1 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $parentUserId . "', 'Presenter', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%b %d, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration,  IF(User.userId = '" . $parentUserId . "', response_presenter_url, '') link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName, DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
        FROM tbl_classes cl 
        JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
        JOIN tbl_users as User ON User.userId = cl.userId 
        JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid 
        WHERE cl.isDeleted = 0 
            AND User.isDeleted = 0 
            AND Courses.isDeleted = 0 
            AND (User.parentUserId = '" . $parentUserId . "' OR User.userId = '" . $parentUserId . "')
            AND (cl.status = 'upcoming' OR cl.status = 'live' ))";

       $query2 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $parentUserId . "', 'Attendee', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%b %d, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, link link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName , DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
       FROM tbl_classes as cl 
       JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid
       JOIN tbl_enrolluser en ON cl.courseId = en.courseId 
       JOIN tbl_users User ON User.userId = en.userId 
       JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
       LEFT JOIN tbl_classes_attendees_link att ON (att.attendeeId = en.userId AND cl.classId = att.classid)
       WHERE User.isDeleted = 0 
        AND Courses.isDeleted = 0 
       AND User.active = '1'
       AND (cl.status = 'upcoming' OR cl.status = 'live' )
       AND (en.userId = '" . $parentUserId . "')
       AND (cl.userId != '" . $parentUserId . "'))";
       $fullQuery = $query1." UNION ".$query2;
       $fullQuery .= "ORDER BY datetimeDifff ASC, myStatus DESC LIMIT 10";
       $query = $this->db->query($fullQuery);
       //echo $this->db->last_query();
       $arrResult = $query->result(); 
       return $arrResult;
    }
    function getUpcomingClassInfoTeacher($UserId) {

        $datetime = gmdate('Y-m-d H:i:s');
        $query1 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $UserId . "', 'Presenter', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%d %b, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, response_presenter_url link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName, DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
        FROM tbl_classes cl 
        JOIN tbl_users as User ON User.userId = cl.userId 
        JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid 
        JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
        WHERE cl.isDeleted = 0 
            AND User.isDeleted = 0 
            AND Courses.isDeleted = 0 
            AND ( User.userId = '" . $UserId . "')
            AND (cl.status = 'upcoming' OR cl.status = 'live' ))";

       $query2 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $UserId . "', 'Attendee', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%d %b, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, link link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName , DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
       FROM tbl_classes as cl 
       JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid
       JOIN tbl_enrolluser en ON cl.courseId = en.courseId 
       JOIN tbl_users User ON User.userId = en.userId 
       JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
       JOIN tbl_classes_attendees_link att ON (att.attendeeId = en.userId AND cl.classId = att.classid)
       WHERE User.isDeleted = 0 
    AND Courses.isDeleted = 0 
       AND User.active = '1'
       AND (cl.status = 'upcoming' OR cl.status = 'live' )
       AND (en.userId = '" . $UserId . "')
       AND (cl.userId != '" . $UserId . "'))";
       $fullQuery = $query1." UNION ".$query2;
       $fullQuery .= "ORDER BY datetimeDifff ASC LIMIT 3";
       $query = $this->db->query($fullQuery);
       //echo $this->db->last_query();
       $arrResult = $query->result(); 
       return $arrResult;
        
        return $query->result();
    }

    function getUpcomingClassInfoStudent($UserId) {
        $datetime = gmdate('Y-m-d H:i:s');
        $this->db->select("cl.userId, cl.classId, cl.class_name, DATE_FORMAT(cl.class_time, '%b %d, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName , DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime, 'Attendee' myStatus ");
        $this->db->from('tbl_classes cl');
        $this->db->join('tbl_courses as Courses', 'Courses.courseId = cl.courseid');
        $this->db->join('tbl_enrolluser as EnrollUser', 'EnrollUser.courseId = Courses.courseId');
        $this->db->join('tbl_users as User', 'User.userId = EnrollUser.userId');       
        $this->db->join('tbl_timezone as timeTbl', 'timeTbl.timezoneId = cl.classtimezone');
        $this->db->join('tbl_classes_attendees_link as atLink', 'EnrollUser.userId = atLink.attendeeId AND cl.classId = atLink.classid', 'left');
        $this->db->where('cl.isDeleted', 0);
        $this->db->where('User.isDeleted', 0);
        $this->db->where('Courses.isDeleted', 0);
        $this->db->where('EnrollUser.UserId', $UserId);
        $this->db->where('(cl.status = "upcoming" OR cl.status = "live" )');
       
        $this->db->order_by('datetimeDifff', 'ASC');
        $this->db->limit(3);
        $query = $this->db->get();
      //echo $this->db->last_query();
        
        return $query->result();
    }

    function getLastCompletedClassInfoTeacher($UserId) {
        $datetime = gmdate('Y-m-d H:i:s');
        $query1 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $UserId . "', 'Presenter', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%d %b, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, response_presenter_url link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName, DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
        FROM tbl_classes cl 
        JOIN tbl_users as User ON User.userId = cl.userId 
        JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid 
        JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
        WHERE cl.isDeleted = 0 
            AND User.isDeleted = 0 
            AND Courses.isDeleted = 0 
            AND ( User.userId = '" . $UserId . "')
            AND (cl.status = 'completed'))";

       $query2 = "(SELECT cl.userId, cl.classId, cl.class_time class_time1, IF(User.userId = '" . $UserId . "', 'Attendee', '-') myStatus , cl.class_name, DATE_FORMAT(cl.class_time, '%d %b, %Y - %a') class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, '%h : %i %p') class_time_exact, duration, link link,  CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') datetimeDifff, timeTbl.name timeZoneName , DATE_FORMAT(CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00') , '%b %d %Y, %h : %i %p') gmtTime,  (TIMESTAMPDIFF(MINUTE, '" . $datetime . "', (CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00'))))datetimeDifffInMinutes,  (TIMEDIFF((CONVERT_TZ(class_time, timeTbl.gmtdiff, '+00:00')), '" . $datetime . "')) dateTimeDiffInTime
       FROM tbl_classes as cl 
       JOIN tbl_courses as Courses ON Courses.courseId = cl.courseid
       JOIN tbl_enrolluser en ON cl.courseId = en.courseId 
       JOIN tbl_users User ON User.userId = en.userId 
       JOIN tbl_timezone as timeTbl ON timeTbl.timezoneId = cl.classtimezone 
       JOIN tbl_classes_attendees_link att ON (att.attendeeId = en.userId AND cl.classId = att.classid)
       WHERE User.isDeleted = 0 
    AND Courses.isDeleted = 0 
       AND User.active = '1'
       AND (cl.status = 'completed')
       AND (en.userId = '" . $UserId . "')
       AND (cl.userId != '" . $UserId . "'))";
       $fullQuery = $query1." UNION ".$query2;
       $fullQuery .= "ORDER BY datetimeDifff ASC LIMIT 3";
       $query = $this->db->query($fullQuery);
       $arrResult = $query->result(); 
       return $arrResult;
       
    }
    function getLastCompletedClassInfoStudent($UserId) {
        $this->db->select('cl.userId, cl.class_name, DATE_FORMAT(cl.class_time, "%b %d, %Y - %a") class_time, Courses.name courseName, Courses.courseId, cl.classId, DATE_FORMAT(cl.class_time, "%h : %i %p") class_time_exact, duration, cl.status, cl.download_recording ');

        $this->db->from('tbl_enrolluser EnrollUser');
        $this->db->join('tbl_users as User', 'User.userId = EnrollUser.userId');
        $this->db->join('tbl_courses as Courses', 'Courses.courseId = EnrollUser.courseid');
        $this->db->join('tbl_classes as cl', 'cl.courseId = Courses.courseId');
        
        $this->db->where('cl.isDeleted', 0);
        $this->db->where('User.isDeleted', 0);
        $this->db->where('Courses.isDeleted', 0);
        $this->db->where('EnrollUser.UserId', $UserId);
        $this->db->where('cl.status =', 'Completed');
        $this->db->order_by('cl.class_time', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
    function getUserCount($roleId, $active, $parentUserId = 0){
        if($roleId > 0){
            $this->db->where('roleId', $roleId);
        }
        if($parentUserId > 0){
            $this->db->where('parentUserId', $parentUserId);
        }

        $this->db->where('isDeleted', 0);
        $this->db->where('active', $active);
        $num_rows = $this->db->count_all_results('tbl_users');
        return $num_rows;

    }
    

}

  