<header id="header" >
    <div class="container clearfix">
        <div class="row">             
            <?php if (theme_get_setting('image_logo','multipurpose')): ?>
            <?php if ($logo): ?>
                <h1 id="site-logo">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo">
                        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
                    </a>
                </h1>
            <?php endif; ?>
            <?php else: ?>
                <h1 id="site-name">
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo">
                        <?php print $site_name; ?>
                    </a>
                </h1>
                <?php if ($site_slogan): ?>
                    <h1 id="site-slogan">
                        <?php print $site_slogan; ?>
                    </h1>
                <?php endif; ?> 
            <?php endif; ?>
            <nav class="navbar navbar-default navbar-fixed-top">
			<div class="nav-container"> 
			<!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
            <button type="button" id="nav-icon" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
            <!--<span class="sr-only">Toggle navigation</span>--> 
            <span></span> <span></span> <span></span> </button>
          </div>
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <div class="nav navbar-nav navbar-right">
                <span class="user-log">
                    <?php if(isset($user->name)){ 
                        $account = user_load($user->uid);
			if(isset($account->field_first_name['und'][0]['safe_value']) )
                           echo "Welcome ".$account->field_first_name['und'][0]['safe_value']."!"; 
                        else echo "Welcome ". $user->name."!";}?>
                </span> 
                <ul>
                    <li><a href="https://www.fia.org" target="_blank">Fia </a></li>
                    <li>
                        <a id = "clickSearch">Search</a>
                        <span id="searchClicked" style="display:none">
                            <?php
                                $block = module_invoke('search', 'block_view', 'search');
                                print render($block);
                            ?>
                        </span>
                     </li>
                 <li>
                    <?php 
                    if(isset($user->name)){?><a href="?q=user" class="active">MY account</a><?php } 
                    else{ ?><div class="userregister"> <a href="?q=user" class="active">Login</a>|<a href="?q=user/register" class="active">Register</a></div><?php }?>
                 </li>
                    <li><a href="https://fimag.fia.org/issue-archives" target="_blank">Archive</a></li>
                    <li><a target="_blank"  href="https://fia.org/advertise">Advertise</a></li>
<?php  if(isset($user->name)){?>
<li><a href="?q=user/logout">Logout</a></li><?php }?>
                </ul>
				</div>
				</div>
				</div>
           </nav>
        </div>
    </div>
</header>