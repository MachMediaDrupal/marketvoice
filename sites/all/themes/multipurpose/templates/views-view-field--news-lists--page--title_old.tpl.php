<?php global $base_url;?> 
                           
                           <ul class="widget-state-news clearfix">
                                   <li>
                                       <div class="nl-list clearfix">
                                          <?php /* <h4><?php echo strtoupper($row->name)?> </h4>*/?>
                                            <h5><a href="?q=<?php echo drupal_get_path_alias('node/'.$row->nid)?>"><?php echo $row->title?></a></h5>
                                            <p>
                                                <?php if(trim($row->body_summary)!="") echo $row->body_summary;
else  echo $row->body_value;?>
                                            </p>
                                       </div>
                                   </li>

                           </ul>
