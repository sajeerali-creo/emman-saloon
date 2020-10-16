<style>
.small-box .icon {
    font-size: 60px !important;
    top: 8px;
}
.dashboard-cols .small-box .inner {
    min-height: 150px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1>Dashboard</h1>
    </section>
    
    <section class="content dashboard-cols">
        <div class="row"><?php 
        $previosClass = 0;
        $counter = 1;
        $numRec = 3;
        if($role == ROLE_SUPERADMIN){
          $numRec = 15;
        }
        if($classInfo){
        foreach($classInfo as $key => $val){
          if($previosClass != $val->classId && $counter <= $numRec){
            $counter++;
            
            ?><div class="col-lg-3 col-xs-12">
          
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h4 style="font-size:22px;font-weight:bold;">Upcoming Course</h4><?php 
                    if(isset($val->courseName)){
                      ?><p>Role : <?php echo $val->myStatus; ?></p>
                      <p>Class : <?php echo $val->class_name; ?></p>
                      <p>Date : <?php echo $val->class_time; ?></p>
                      <p>Time : <?php echo $val->class_time_exact; ?></p>
                      <p>Duration : <?php echo $val->duration; ?></p>
                      <p>Timezone : <?php echo $val->timeZoneName; ?></p>
                      <p>GMT : <?php echo $val->gmtTime; ?></p><?php 
                      if($val->datetimeDifffInMinutes <=0){
                        ?><p>Status  : Live (<?php echo ($val->datetimeDifffInMinutes * -1); ?> Minutes Over)</p><?php 
                      }
                      else{
                        ?><p>Time Left  : <?php echo $val->dateTimeDiffInTime; ?></p><?php
                      }
                     
                    }
                    else{
                      ?><p>No Courses</p><?php
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fa fa-mortar-board"></i>
                  </div><?php 
                  if(isset($val->link) && !empty($val->link)){
                    ?><a href="<?php echo $val->link; ?>" class="small-box-footer" target="_blank">Launch Class <i class="fa fa-arrow-circle-right"></i></a><?php
                  }
                  else if(isset($val->courseName)){
                    ?><a href="<?php echo base_url(); ?>/securepanel/viewclasses/<?php echo $val->courseId; ?>/<?php echo $val->classId; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a><?php
                  }
                  else{
                    ?><a href="<?php echo base_url(); ?>/securepanel/courses/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a><?php
                  }
               ?> </div>
            
            </div><!-- ./col --><?php 
                }
                $previosClass = $val->classId;
              }
            }
            else{
              ?><div class="col-lg-3 col-xs-12">
          
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4 style="font-size:22px;font-weight:bold;">Upcoming Course</h4>
                  <p>No Courses</p>
                  </div><div class="icon">
                    <i class="fa fa-mortar-board"></i>
                  </div>
                  </div>
            
            </div><!-- ./col --><?php
            }
            if($role == ROLE_SUPERADMIN || $role == ROLE_ADMIN){
              ?><div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4 style="font-size:22px;font-weight:bold;">Users</h4><?php 
                  if(isset($activeAdminCount) && isset($inActiveAdminCount)){
                    ?><p><b>Admin</b> :- Active: <?php echo $activeAdminCount; ?>, Inactive : <?php echo $inActiveAdminCount; ?></p><?php 
                  }            
                  if(isset($activeTeacherCount) && isset($inActiveTeacherCount)){                  
                    ?><p><b>Teachers</b> :- Active: <?php echo $activeTeacherCount; ?>, Inactive : <?php echo $inActiveTeacherCount; ?></p><?php 
                  }
                  ?><p><b>Students</b> :- Active: <?php echo $activeStudentCount; ?>, Inactive : <?php echo $inActiveStudentCount; ?></p>                  
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>securepanel/users" class="small-box-footer">View more <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col --><?php 
            }
            if($role == ROLE_TEACHER || $role == ROLE_STUDENT){
              
              if($arrCompletedCourse){
                foreach($arrCompletedCourse as $key => $val){
                  if($previosClass != $val->classId && $counter <= $numRec){
                    $counter++;
                    
                    ?><div class="col-lg-3 col-xs-12">
                  
                        <div class="small-box bg-yellow">
                          <div class="inner">
                            <h4 style="font-size:22px;font-weight:bold;">Last Attended Class</h4><?php 
                            if(isset($val->courseName)){
                              ?><p>Role : <?php echo $val->myStatus; ?></p>
                              <p>Class : <?php echo $val->class_name; ?></p>
                              <p>Date : <?php echo $val->class_time; ?></p>
                              <p>Time : <?php echo $val->class_time_exact; ?></p>
                              <p>Duration : <?php echo $val->duration; ?></p>
                              <p>Timezone : <?php echo $val->timeZoneName; ?></p>
                              <p>GMT : <?php echo $val->gmtTime; ?></p>
                              <p>Download Link : <?php if(!empty($val->download_recording)){ echo $arrCompletedCourse->download_recording; } else { echo "Link not available"; } ?></p><?php
                              
                             
                            }
                            else{
                              ?><p>No Courses</p><?php
                            }
                            ?>
                          </div>
                          <div class="icon">
                            <i class="fa fa-book"></i>
                          </div><?php 
                          if(isset($val->courseName)){
                            ?><a href="<?php echo base_url(); ?>/securepanel/viewclasses/<?php echo $val->courseId; ?>/<?php echo $val->classId; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a><?php
                          }
                          else{
                            ?><a href="<?php echo base_url(); ?>/securepanel/courses/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a><?php
                          }
                       ?> </div>
                    
                    </div><!-- ./col --><?php 
                        }
                        $previosClass = $val->classId;
                      }
                    }
                    else{
                      ?><div class="col-lg-3 col-xs-12">
                  
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h4 style="font-size:22px;font-weight:bold;">Last Attended Class</h4>
                          <p>No Courses</p>
                          </div><div class="icon">
                            <i class="fa fa-book"></i>
                          </div>
                          </div>
                    
                    </div><!-- ./col --><?php
                    }
            
            } 
             ?>
            
            
            
    </section>
</div>