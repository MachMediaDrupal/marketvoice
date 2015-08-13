<?php global $base_url;
 if(!$row->field_memoriam_value){ ?>
    <div class="list-people">
        <p>
            <?php  //echo  $row->body_value;

echo $test = str_replace('<img src="/', '<img src="$base_url/', $row->body_value);
?>
        </p>
 </div>

 <?php }
if($row->field_memoriam_value){ ?>
 <div class="large-side-bar width-full">
 <h6>In Memorium</h6> 
 <?php  
        echo $row->body_summary;?>
             <a href="#" id="mySlideToggler">Read More</a> 
              <span id="mySlideContent" style = "display:none">
                  <?php  echo $row->body_value;?>
<a id="ClickTOggle">Read Less</a>
                </span>
                
                </p>
            </div>
 <?php }?>

 
