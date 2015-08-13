<?php global $base_url;
 if(!$row->field_memoriam_value){ ?>
<?php if($row->field_people_deck_text_value){?>
                        <span class="decktext"><?php echo $row->field_people_deck_text_value?></span>       
                    <?php }  ?>
    <div class="list-people">
        <p>
            <?php  echo $row->body_value;?>
        </p>
 </div>

 <?php }
if($row->field_memoriam_value){ ?>
 <div class="large-side-bar width-full">
 <h6>IN MEMORIAM</h6> 
 <?php  
        echo $row->body_summary; 
        if(strip_tags( $row->body_value !="")){ ?>
             <a href="#" id="mySlideToggler">Read More</a> 
              <span id="mySlideContent" style = "display:none">
                  <?php  echo $row->body_value;?>
<a id="ClickTOggle">Read Less</a>
                </span>
                <?php }?>
                </p>
            </div>
 <?php }?>

 
