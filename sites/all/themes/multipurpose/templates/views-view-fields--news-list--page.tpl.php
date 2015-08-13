<div class="nl-list clearfix">
    <h5><?php print  $fields["title"]->content; ?></h5>
    <p> <?php
        $fields["body"]->content = preg_replace("/<img[^>]+\>/i", "", $fields["body"]->content);
        print  $fields["body"]->content?>
    </p>
</div>










                                                                      

                           
