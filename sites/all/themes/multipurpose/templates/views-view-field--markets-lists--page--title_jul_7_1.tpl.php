<?php global $base_url;
global $a;?> 
                           
<ul class="widget-state-news clearfix">
    <li> 
        <div class="nl-list clearfix">  
            <h5> <?php echo $row->title?> </h5> <?php 
            if($row->field_markets_sub_title_value) { ?>
                <h2><span class="subtitle"> <?php 
                    echo $row->field_markets_sub_title_value?>
                </span> </h2><?php 
             }  ?>
             <div class="widget-area-txt">
                 <p><?php echo $row->body_value;?> </p> <?php 
                 if($row->field_markets_left_sidebar_value) { ?>
                     <div class="widget-contents clearfix"> 
                         <div class="blue-container align-left width-small"><?php
                             echo $row->field_markets_left_sidebar_value; ?>
                         </div> <?php 
                         echo $row->field_markets_right_sidebar_value;?>
                     </div><?php 
                 }
                 if($row->field_markets_text_bar_value) { ?>
                     <div class="widget-contents clearfix"> 
                         <div class="content-container-aside">
                             <div class="widget-business-story align-left width-small">
                                 <h3><?php echo $row->field_markets_text_bar_value ?></h3>
                                 <?php if($row->field_markets_text_bar_head_value){?>
                                     <div class="secodary-head">
                                         <h6><?php echo $row->field_markets_text_bar_head_value?></h6> <?php 
                                         if($row->field_markets_text_bar_small_hea_value){ 
                                            echo $row->field_markets_text_bar_small_hea_value;
                                         }?>
                                     </div> <?php 
                                 }?>
                             </div>
                        </div> <?php 
                        if($row->field_markets_right_text_bar_value) {?>
                            <div class="widget-multiple-list cleartfix"> <?php 
                                echo $row->field_markets_right_text_bar_value; ?>
                            </div> <?php 
                        }?>
                    </div> <?php 
                 }
                 if($row->field_markets_text_bar1_value) {?> 
                    <div class="widget-contents clearfix"> 
                        <div class="content-container-aside">
                            <div class="widget-business-story align-left width-small">
                                <h3><?php echo $row->field_markets_text_bar1_value;?></h3> <?php 
                                if($row->field_markets_text_bar_head1_value) { ?>
                                    <div class="secodary-head">
                                        <h6><?php echo $row->field_markets_text_bar_head1_value;?></h6> <?php 
                                        if($row->field_markets_text_bar1_small_he_value) { 
                                            echo $row->field_markets_text_bar1_small_he_value ;
                                        }?>
                                    </div> <?php 
                                }?>
                            </div>
                        </div> <?php 
                        if($row->field_markets_right_text_bar1_value) echo $row->field_markets_right_text_bar1_value;?>
                    </div> <?php
                 }
                 if($row->field_markets_after_text_bar_value) {?>
                     <div class="clearfix"><p> <?php 
                         echo  $row->field_markets_after_text_bar_value ?> </p> 
                     </div> <?php 
                 }?>   
             </div>
         </div>
    </li>
</ul>
