<div class="content-wrapper">
    <style>
        select[multiple], select[size], select[size].form-control, select[multiple].form-control {
            height: 200px;
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h1>
                    Assign Tags : <?php echo $userInfo->first_name . " " . $userInfo->last_name; ?>
                    <!-- <small>Edit Course</small> -->
                </h1>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo base_url(); ?>securepanel/users" class="lnk-warning link-right-pos"><i class="fa fa-arrow-left"></i>Back</a>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if ($error) {
                    ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php
                    } ?>
                <?php
                    $success = $this->session->flashdata('success');
                    if ($success) {
                    ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php
                    } ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Select Tags to Add</h3>
                    </div>
                    <!-- /.box-header --><?php 

                    /*echo "<pre>";
                    print_r($userInfo);
                    print_r($allTagsInfo);
                    print_r($userTagsInfo);
                    die();*/

                    $arrFullTagsName = array();
                    ?><!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>securepanel/updateassigntagsinfo" method="post" id="frmEnrollUsers" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group"><?php

                                        ?><select name="tag_ids[]" id="multiselect" class="form-control" size="8" multiple="multiple"><?php
                                            foreach ($allTagsInfo as $key => $value) {
                                                $arrFullTagsName[$value->id] = $value->tagCategoyName . " > " . $value->title;
                                                if(!isset($userTagsInfo[$value->id])){
                                                    ?><option value="<?php echo $value->id; ?>"><?php echo $value->tagCategoyName . " > " . $value->title; ?></option><?php
                                                }
                                                
                                            }
                                        ?></select><?php
                                    ?></div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" id="multiselect_rightAll" class="btn btn-default btn-block" style="margin-top: 20px;" title="Add All Users"><i class="glyphicon glyphicon-forward"></i></button>
                                        <button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block" title="Add Selected User/Users"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                        <button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block" title="Remove Selected User/Users"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                        <button type="button" id="multiselect_leftAll" class="btn btn-default btn-block" title="Remove All Users"><i class="glyphicon glyphicon-backward"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select name="tag_ids_selected[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"><?php
                                            
                                            foreach ($userTagsInfo as $key => $value) {
                                                if(isset($arrFullTagsName[$value->tag_id])){
                                                    ?><option value="<?php echo $value->tag_id; ?>"><?php echo $arrFullTagsName[$value->tag_id]; ?></option><?php
                                                }
                                            }
                                        ?></select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $userId; ?>" id="userId"  name="userId" />    
                        </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Save" id="btnSave"/>
                        <a href="<?php echo base_url(); ?>securepanel/users" class="btn btn-primary" title="Cancel">Cancel</a>
                    </div>
                </form>
            </div>
            
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/commonjs.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/multiselect.min.js?v=<?php echo date("Ymdhis"); ?>" charset="utf-8"></script>
<script>
    jQuery(document).ready(function($) {
        $('#multiselect').multiselect({
            right: '#multiselect_to',
            rightSelected: '#multiselect_rightSelected',
            leftSelected: '#multiselect_leftSelected',
            rightAll: '#multiselect_rightAll',
            leftAll: '#multiselect_leftAll',
            skipInitSort: true,
            search: {
                left: '<input type="text" name="q_left" class="form-control" placeholder="Search Tags for add..." />',
                right: '<input type="text" name="q_right" class="form-control" placeholder="Search Tags for remove..." />',
            }, 
            moveToRight: function(Multiselect, $options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');
     
                if (button == 'multiselect_rightSelected') {
                    var $left_options = Multiselect.$left.find('> option:selected');
                    Multiselect.$right.eq(0).append($left_options);
     
                    if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                        Multiselect.$right.eq(0).find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$right.eq(0));
                    }
                } else if (button == 'multiselect_rightAll') {
                    var $left_options = Multiselect.$left.children(':visible');
                    Multiselect.$right.eq(0).append($left_options);
     
                    if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                        Multiselect.$right.eq(0).find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$right.eq(0));
                    }
                }
                $options.each(function( index ){
                    /*console.log( index + ": " + $( this ).val() );
                    console.log( index + ": " + $( this ).text() );*/
                    /*var strRole = $("#user_role_" + $( this ).val()).val();
                    var strDisabled = '';
                    var checked1 = ' checked="checked" ';
                    var checked2 = ' checked="checked" ';
                    var checked3 = ' checked="checked" ';
                    var checked4 = ' checked="checked" ';
                    if(strRole == 'student'){
                        strDisabled = ' disabled';
                        checked1 = ' ';
                        checked2 = ' checked="checked" ';
                        checked3 = ' checked="checked" ';
                        checked4 = ' ';
                    }*/
                    /*$('#enroll-course-permission > tbody').append('<tr id="enroll_' + $( this ).val() + '"><td><input type="hidden" name="user_id[]" value="' + $( this ).val() + '">' + $( this ).text() + '</td><td><input type="hidden" value="0" name="create_class[' + $( this ).val() + ']"><input value="1" type="checkbox" name="create_class[' + $( this ).val() + ']" class="create_class" id="create_class_' + $( this ).val() + '" ' + strDisabled +' ' + checked1 +'></td><td><input type="hidden" value="0" name="view_recording[' + $( this ).val() + ']"><input value="1" type="checkbox" name="view_recording[' + $( this ).val() + ']" class="view_recording" id="view_recording_' + $( this ).val() + '" ' + checked2 +'></td><td><input type="hidden" value="0" name="download_recording[' + $( this ).val() + ']"><input value="1" type="checkbox" name="download_recording[' + $( this ).val() + ']" class="download_recording" id="download_recording_' + $( this ).val() + '"' + checked3 +'></td><td><input type="hidden" value="0" name="upload_content[' + $( this ).val() + ']"><input value="1" type="checkbox" name="upload_content[' + $( this ).val() + ']" class="upload_content" id="upload_content_' + $( this ).val() + '" ' + strDisabled +'' + checked4 +'></td></tr>');*/
                });
            },
     
            moveToLeft: function(Multiselect, $options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');

                if (button == 'multiselect_leftSelected') {
                    var $right_options = Multiselect.$right.eq(0).find('> option:selected');
                    Multiselect.$left.append($right_options);
     
                    if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                        Multiselect.$left.find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$left);
                    }
                } else if (button == 'multiselect_leftAll') {
                    var $right_options = Multiselect.$right.eq(0).children(':visible');
                    Multiselect.$left.append($right_options);
     
                    if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                        Multiselect.$left.find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$left);
                    }
                }

                $options.each(function( index ){
                    /*console.log( index + ": " + $( this ).val() );
                    console.log( index + ": " + $( this ).text() );*/
                    //$("#enroll_" + $( this ).val()).remove();
                });
            }
        });

        $("#btnSave").on("click", function(e){
            e.preventDefault();
            if($("#multiselect_to option").length < 1){
                alert("Please assign a tag in this user");
            }
            else{
                $("#frmEnrollUsers").submit();
            }
        })
    });
</script>