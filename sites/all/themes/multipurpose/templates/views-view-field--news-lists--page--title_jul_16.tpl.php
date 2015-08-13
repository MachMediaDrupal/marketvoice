<?php global $base_url;
global $a;?> 
    <ul class="widget-state-news clearfix">
        <li> 
             <div class="nl-list clearfix"> <?php
                if (@in_array(strtoupper($row->name), $a)) {}
                else {?>
                   <h4><?php $a []= strtoupper($row->name); 
                   echo strtoupper($row->name)?> </h4><?php 
                } $a []= strtoupper($row->name);?>
                <h5> <?php 
                    echo $row->title?>
                </h5>
<?php if($row->field_sub_title_value){?>
                <h2> 
                    <?php 
                    if($row->field_sub_title_value){?>
                        <span class="subtitle"><?php echo $row->field_sub_title_value?></span><?php 
                    }?> 
                </h2>
<?php }?>

<?php if($row->field_news_deck_text_value){?>
                        <span class="decktext"><?php echo $row->field_news_deck_text_value?></span>       
                    <?php }  ?>
                <div class="widget-area-txt">
                   <p><?php echo$row->body_value;?> </p>
                   <div class="widget-contents clearfix"> 
                       <?php if($row->field_left_side_bar_value){?>
                           <div class="blue-container align-left width-small"><?php
                               echo $row->field_left_side_bar_value;?>
                           </div>
                           <?php echo $row->field_right_sidebar_value;           
                       }?>
                  </div>

                  <?php if($row->field_add_text_sidebar_value) { ?>   
                      <div class="widget-contents clearfix"> 
                          <div class="content-container-aside">
                              <div class="widget-business-story align-left width-small">
                                  <h3><?php echo $row->field_add_text_sidebar_value;?></h3><?php 
                                  if( $row->field_add_text_sidebar_head_value) {?>
                                      <div class="secodary-head">
                                          <h6><?php echo $row->field_add_text_sidebar_head_value?></h6><?php 
                                          if( $row->field_add_text_sidebar_small_hea_value)  
                                          echo  $row->field_add_text_sidebar_small_hea_value; ?>
                                      </div><?php 
                                  }?>
                              </div>
                          </div> <?php 
                          if( $row->field_add_text_right_sidebar_value)   echo $row->field_add_text_right_sidebar_value; ?>
                       </div><?php 
                  }
                 if( $row->field_add_text_after_sidebar_value) {?>
                     <div class="widget-multiple-list cleartfix"><?php 
                         echo $row->field_add_text_after_sidebar_value; ?>
                     </div> <?php 
                 }
                if($row->field_add_text_sidebar1_value) {?>
                    <div class="widget-contents clearfix"> 
                        <div class="content-container-aside">
                             <div class="widget-business-story align-left width-small">
                                 <h3><?php echo $row->field_add_text_sidebar1_value?></h3><?php 
                                 if($row->field_add_text_sidebar_head1_value) { ?>
                                     <div class="secodary-head">
                                         <h6><?php echo $row->field_add_text_sidebar_head1_value?></h6><?php  
                                         if( $row->field_add_text_sidebar_small1_value) { 
                                             echo $row->field_add_text_sidebar_small1_value;}?>
                                     </div> <?php 
                                 }?>
                              </div>
                        </div> <?php  
                        if( $row->field_add_text_right_sidebar1_value) { echo $row->field_add_text_right_sidebar1_value;}?>
                    </div> <?php 
                }
                if($row->field_after_sidebar_value){?>
                    <div class="clearfix"><p> <?php 
                       echo $row->field_after_sidebar_value; ?> </p> 
                    </div><?php 
                }
                if($row->field_bottom_side_bar_value){?>
                    <div class="clearfix"><p> <?php 
                        echo $row->field_bottom_side_bar_value ?> </p> 
                    </div> <?php 
                }?>
          </div>
      </div>
   </li>
</ul>












