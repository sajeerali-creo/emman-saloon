<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header clearfix">
        <div class="row">
    <div class="col-sm-6">
      <h1>
        User Management
        
      </h1>
</div>
<div class="col-sm-6">
      <a href="<?php echo base_url(); ?>securepanel/addnewuser" class="lnk-warning link-right-pos">Add new<i class="fa fa-plus"></i></a>
</div>
</div>
    </section>
    <section class="content">
       
        <div class="row">
		 <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
				</div>
            </div>
		<?php if(count($allroles) > 1){
            ?>
		<form action="<?php echo base_url() ?>securepanel/users" method="POST" id="searchList">
		 <div class="row">
		 
		
            <div class="col-sm-3 text-left">
                <div class="form-group">
			
							<div class="input-group" style="    width: 100%;">
                               <p><b>Roles: &nbsp;&nbsp;&nbsp;</b></p><select class="filterUser form-control" name="searchRole" name="id" onchange="this.form.submit();">
							   <option value="">All</option><?php 
				   foreach($allroles as $key => $val){
				   ?><option value="<?php echo $val->roleId ?>" <?php if($searchRole == $val->roleId){ echo "selected='selected'"; } ?>><?php echo $val->role ?></option>
				   <?php 
				   }
				   ?></select>
                              </div>
                            </div>
                       
                 
                </div><?php 
        
        if(count($allLevel1Parents) > 0){
        ?>
				 <div class="col-sm-3 text-left">
                <div class="form-group">
				
                           
							<div class="input-group" style="    width: 100%;">
                               <p><b>Parent: &nbsp;&nbsp;&nbsp;</b></p><select class="filterUser form-control" id="searchparentLevel1" name="searchparentLevel1" onchange="this.form.submit();">
							   <option value="">All</option><?php 
				   foreach($allLevel1Parents as $key => $val){
				   ?><option value="<?php echo $val->parentUserId ?>" <?php if($searchparentLevel1 == $val->parentUserId){ echo "selected='selected'"; } ?>><?php echo $val->name ?></option>
				   <?php 
				   }
				   ?></select>
                              </div>
                            </div></div><?php
        }
        ?>
         <div class="col-sm-2 text-left">
                <div class="form-group">
				
                           
							<div class="input-group" style="    width: 100%;">
                               <p><b>Status: &nbsp;&nbsp;&nbsp;</b></p>
                               <?php 
				   foreach($arrActiveusers as $key => $val){
				   ?><input type="radio" name="activeStatus" id="activeStatus<?php echo $key; ?>" style="margin-left:10px;" value="<?php echo $key ?>" <?php if($activeStatus == $key){ echo "checked"; } ?>>
                   <label for="activeStatus<?php echo $key; ?>" style="margin-left:5px;"><?php echo $val; ?></label>
				   <?php 
				   }
				   ?>
                              </div>
                            </div></div>


						
                 
                
				
                <div class="col-sm-3 text-left">
					<div class="form-group">                           
						<div class="input-group" style="    width: 100%;">
							<input type="submit" value="Search" class="btn btn-primary" style="    margin-top: 31px;">
							
						</div>
					</div>                
                </div>
            
        </div>
         </form><?php 
        }
        ?>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>securepanel/users" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <input type="hidden" name="sortOrder" value="<?php echo $sortOrder; ?>">
                              <input type="hidden" name="sortOrderBy" value="<?php echo $sortOrderBy; ?>">
                              <input type="hidden" name="searchRole" value="<?php echo $searchRole; ?>">
                              <input type="hidden" name="searchparentLevel1" value="<?php echo $searchparentLevel1; ?>">
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover dataTable table-sm">
                    <thead>
						<tr><th>#</th>
							<?php
							$nameOrder = $orderbyNameAscUrl;
							$nameOrderClass = 'sorting';
							$createdDtmOrder = $orderbycreatedDtmAscUrl;
							$createdDtmOrderClass = 'sorting';
								$parentOrder = $orderbyparentAscUrl;
							$parentOrderClass = 'sorting';
							
							switch($sortOrderBy){
								case "name":
									if($sortOrder == 'ASC'){
										$nameOrder = $orderbyNameDesUrl;
										$nameOrderClass = 'sorting_desc';
									}
									else{
										$nameOrder = $orderbyNameAscUrl;
										$nameOrderClass = 'sorting_asc';
									}
									break;
								case "createdDtm":
									if($sortOrder == 'ASC'){
										$createdDtmOrder = $orderbycreatedDtmDesUrl;
										$createdDtmOrderClass = 'sorting_desc';
									}
									else{
										$createdDtmOrder = $orderbycreatedDtmAscUrl;
										$createdDtmOrderClass = 'sorting_asc';
									}
									break;
								case "parentName":
									if($sortOrder == 'ASC'){
										$parentOrder = $orderbyparentDesUrl;
										$parentOrderClass = 'sorting_desc';
									}
									else{
										$parentOrder = $orderbyparentAscUrl;
										$parentOrderClass = 'sorting_asc';
									}
									break;
							}
							
							 if($role == ROLE_SUPERADMIN){
								 ?><th class="<?php echo $parentOrderClass; ?>"><a href="<?php echo $parentOrder; ?>">Parent Name</a></th><?php 
							 }
							 ?>
                            <th class="<?php echo $nameOrderClass; ?>"><a href="<?php echo $nameOrder; ?>">Name</a></th><?php 
                            if($role == ROLE_TEACHER || (!empty($searchRole) && $searchRole == ROLE_STUDENT)){
                                ?><th>Class</th><?php 
                            }
                            ?>

							<th>Email</th>
							<th>Mobile</th>
							<th>Role</th>
                            <th class="text-center">Profile Picture</th><?php 
                            if($role == ROLE_ADMIN || $role == ROLE_SUPERADMIN){
                            ?><th class="text-center">Status</th><?php 
                            }
                            ?>
							<th class="<?php echo $createdDtmOrderClass; ?>"><a href="<?php echo $createdDtmOrder; ?>">Created On</a></th>
							
							<th class="text-center action-cols">Actions</th>
						</tr>
					</thead>
                    <?php
                    if(!empty($userRecords))
                    {
                        $cntr = 1;
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr  valign="middle">
                    <td><?php echo $cntr ?></td><?php
        $cntr++;
					
						 if($role == ROLE_SUPERADMIN){
							 ?>
						<td valign="middle"><?php echo $record->parentName ?></td><?php 
						 }
						 ?>
                        <td valign="middle"><?php echo $record->name . " " . $record->lname ?></td><?php 
                         if($role == ROLE_TEACHER || (!empty($searchRole) && $searchRole == ROLE_STUDENT)){
                            ?><td><?php echo $record->className; ?></td><?php 
                        }
                        ?>
                       
                        <td valign="middle"><?php echo $record->email ?></td>
                        <td><?php echo $record->mobile ?></td>
                        <td><?php echo $record->role ?></td>
                        <td class="text-center"><?php 
					
							if(!empty($record->profilepic)){
								?><img src="<?php echo base_url() . 'uploads/' . $record->profilepic; ?>" width="50px"><?php
							}
                        ?></td><?php 
                        if($role == ROLE_ADMIN || $role == ROLE_SUPERADMIN){
                            ?><td class="text-center"><?php if($record->active == 1){?><a href="" class="link-success activateDeactivate" data-userid="<?php echo $record->userId; ?>" data-activestatus="0" title="Click to inactivate" data-link="activedeactiveuser">Active</a><?php } else {?><a href="" class="link-danger activateDeactivate" data-userid="<?php echo $record->userId; ?>" data-activestatus="1" title="Click to activate" data-link="activedeactiveuser" >Inactive</a><?php } ?></td><?php 
                        }
                        ?>
                        <td><?php echo date("m/d/Y H:m:s", strtotime($record->createdDtm)) ?></td>
                        
                        <td class="text-center btn-action-lists"><?php 
                            if($role == ROLE_SUPERADMIN){
                                ?> <a class="btn btn-sm btn-view-hostory" href="<?= base_url().'securepanel/login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a><?php 
                            }
                            ?> 
                            <a class="btn btn-sm btn-edit" href="<?php echo base_url().'securepanel/edituser/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php 
                            if($role == ROLE_ADMIN || $role == ROLE_SUPERADMIN){
                                ?><a class="btn btn-sm btn-delete deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a><?php 
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "securepanel/users/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
