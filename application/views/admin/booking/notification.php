<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3 mt-3 h-100vh">
    <!-- loop -->
    <div class="row mb-1">
        <!-- header -->
        <div class="d-flex justify-content-between mt-3 mb-3 w-100 col-md-12">
            <div class="text-primary f-24">Notification</div>
            <a href="<?php echo base_url(); ?>securepanel" class="btn btn-dark">Back</a>
        </div>
        <div class="clearfix"></div>
        <div>
            <hr>
        </div>
    </div><?php
    if(count($dataRecords) > 0){
        foreach ($dataRecords as $cartmasterId => $arrSubInfo) {
            ?><div class="row mb-1">
                <div class="col-md-12 mt-2">
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <div><?php
                                foreach ($arrSubInfo['serviceAllInfo'] as $key => $value) {
                                    ?><div class="text-dark font-weight-bold f-16"><?php echo(ucwords(strtolower($value['serviceCategory'])) ." " . $value['serviceName']); ?></div>
                                    <div class="text-gray f-16"><?php 
                                        echo $value['person'];
                                        if($value['person'] > 1){
                                            echo " persons";
                                        }
                                        else{
                                            echo " person only";
                                        }
                                    ?></div><?php
                                }
                                ?><small class="text-gray f-16"><?php echo $arrSubInfo['info']['address']; ?></small>
                            </div>

                            <div>
                                <a href="<?php echo base_url().'securepanel/edit-booking/' . $cartmasterId; ?>"
                                    class="btn btn-primary d-flex align-items-center w-100 justify-content-center">
                                    <i class="fas fa-eye"></i>&nbsp;View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php
        }
    }
    else{
        ?>Nothing Found<?php
    }
    
?></div>