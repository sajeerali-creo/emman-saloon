<link href="<?php echo base_url(); ?>assets/plugins/choices/choices.min.css" rel="stylesheet" type="text/css" />
<style>
    .choices__inner{
        padding: 7.5px 6.5px 2.5px;
        min-height: 35px;
    }
    .choices__list--dropdown .choices__item {
        padding: 6px;
        padding-left: 15px;
    }
    .choices__heading {
        font-size: 16px;
    }
</style>
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
		<form action="<?php echo base_url() ?>securepanel/users" method="POST" id="searchList">
            <div class="row">
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                       <div class="input-group" style="width: 100%;">
                            <p><b>Tags: &nbsp;&nbsp;&nbsp;</b></p>
                            <select class="filterCategory input-sm form-control" name="lstTags[]" id="lstTags" multiple>
                                <option value="">All</option><?php
                                $strCatName = '';
                                $flCatNameGrp = false;
                                foreach ($allTagsInfo as $key => $value) {
                                    if($strCatName != $value->tagCategoyName){
                                        if(!empty($strCatName)){
                                            ?></optgroup><?php
                                        }
                                        ?><optgroup label="<?php echo $value->tagCategoyName; ?>"><?php

                                        $strCatName = $value->tagCategoyName;
                                        $flCatNameGrp = true;
                                    }
                                    ?><option value="<?php echo $value->id; ?>" <?php 
                                    if (in_array($value->id, $lstTags)) {
                                        echo "selected='selected'";
                                    } 
                                    ?>><?php echo $value->title; ?></option><?php
                                }
                                if($flCatNameGrp){
                                    ?></optgroup><?php
                                }
                            ?></select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 text-left">
                    <div class="form-group">
					   <div class="input-group" style="width: 100%;">
                            <p><b>Status: &nbsp;&nbsp;&nbsp;</b></p>
                               <?php 
            				   foreach($arrActiveusers as $key => $val){
                				   ?><input type="radio" name="activeStatus" id="activeStatus<?php echo $key; ?>" style="margin-left:10px;" value="<?php echo $key ?>" <?php if($activeStatus == $key){ echo "checked"; } ?>>
                                   <label for="activeStatus<?php echo $key; ?>" style="margin-left:5px;"><?php echo $val; ?></label><?php 
            				   }
				   
                        ?></div>
                    </div>
                </div>
                <div class="col-sm-3 text-left">
					<div class="form-group">                           
						<div class="input-group" style="    width: 100%;">
							<input type="submit" value="Search" class="btn btn-primary" style="    margin-top: 31px;">
							<input type="hidden" name="searchText" value="<?php echo $searchText; ?>">
						</div>
					</div>                
                </div>
            
        </div>
         </form>
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
                                <input type="hidden" name="activeStatus" value="<?php echo $activeStatus; ?>"><?php
                                    foreach ($lstTags as $key => $value) { 
                                        ?><input type="hidden" name="lstTags['<?php echo $key; ?>']" value="<?php echo $value; ?>"><?php
                                    }
                                ?><div class="input-group-btn">
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
							
							switch($sortOrderBy){
								case "first_name":
									if($sortOrder == 'ASC'){
										$nameOrder = $orderbyNameDesUrl;
										$nameOrderClass = 'sorting_desc';
									}
									else{
										$nameOrder = $orderbyNameAscUrl;
										$nameOrderClass = 'sorting_asc';
									}
									break;
								case "add_date":
									if($sortOrder == 'ASC'){
										$createdDtmOrder = $orderbycreatedDtmDesUrl;
										$createdDtmOrderClass = 'sorting_desc';
									}
									else{
										$createdDtmOrder = $orderbycreatedDtmAscUrl;
										$createdDtmOrderClass = 'sorting_asc';
									}
									break;
							}
							
							 
							 ?>
                            <th class="<?php echo $nameOrderClass; ?>"><a href="<?php echo $nameOrder; ?>">Name</a></th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Gender</th>
                            <th>Country</th>
                            <th class="text-center">Status</th>
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
					
						 
						 ?>
                        <td valign="middle"><?php echo $record->first_name . " " . $record->last_name ?></td><?php 
                         
                        ?>
                       
                        <td valign="middle"><?php echo $record->email ?></td>
                        <td><?php echo $record->phone_number ?></td>
                        <td><?php echo $allGender[$record->gender]; ?></td>
                        <td><?php echo $allCountry[$record->country]['name']; ?></td>
                        <td class="text-center"><?php 
                            if($record->status == 'AC'){
                                ?><a href="#" class="link-success activateDeactivate" data-userid="<?php echo $record->userId; ?>" data-activestatus="0" title="Click to inactivate" data-link="activedeactiveuser">Active</a><?php 
                            } else {
                                ?><a href="#" class="link-danger activateDeactivate" data-userid="<?php echo $record->userId; ?>" data-activestatus="1" title="Click to activate" data-link="activedeactiveuser" >Inactive</a><?php 
                            } 
                        ?></td>
                        
                        <td><?php echo date("m/d/Y H:m:s", strtotime($record->add_date)) ?></td>
                        
                        <td class="text-center btn-action-lists">                          
                            <a class="btn btn-sm btn-edit" href="<?php echo base_url().'securepanel/assigntags/'.$record->userId; ?>" title="Add Tags"><i class="fa fa-plus"></i></a>
                            <a class="btn btn-sm btn-addclass" href="#" title="View Matched Tags"><i class="fa fa-tags"></i></a>
                            <a class="btn btn-sm btn-addclass" href="#" title="View Matching Survey"><i class="fa fa-list-alt"></i></a>
                            <a class="btn btn-sm btn-addclass" href="#" title="View Completed Survey"><i class="fa fa-check-square-o"></i></a>
                            <a class="btn btn-sm btn-addclass" href="#" title="View Payment Hostory"><i class="fa fa-money"></i></a>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/choices/choices.min.js" charset="utf-8"></script>
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

        const choices = new Choices(jQuery('#lstTags')[0], {
            removeItemButton: true,
            itemSelectText: ' ',
            placeholder: true,
        });
    });
</script>
