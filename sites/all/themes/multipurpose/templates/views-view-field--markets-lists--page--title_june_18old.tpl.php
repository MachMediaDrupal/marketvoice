<?php global $base_url;
global $a;?> 
                           
                           <ul class="widget-state-news clearfix">
                                   <li> 
                                       <div class="nl-list clearfix">  
<h5>
                                               
                                                 <?php echo $row->title?> </h5>
                                            <p>
                                                <?php if(trim($row->body_summary)!="") echo $row->body_summary;
else  echo $row->body_value;?>
                                            </p>
                                       </div>
                                   </li>

                           </ul>
