<?php global $base_url;
global $a;?> 
                           
                           <ul class="widget-state-news clearfix">
                                   <li> 
                                       <div class="nl-list clearfix"> <?php 
 
					if (@in_array(strtoupper($row->name), $a)) 
					{}else {?>
                                           <h4><?php $a []= strtoupper($row->name); 
                                             echo strtoupper($row->name)?> </h4><?php 
                                        } $a []= strtoupper($row->name);?>
                                            <h5>
                                              <a href="?q=<?php echo drupal_get_path_alias('node/'.$row->nid)?>">
                                                 <?php echo $row->title?></a></h5>
                                            <p>
                                                <?php if(trim($row->body_summary)!="") echo $row->body_summary;
else  echo $row->body_value;?>
                                            </p>
                                       </div>
                                   </li>

                           </ul>
