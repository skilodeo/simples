<?php echo $html->doctype('xhtml-strict') ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php echo $html->charset(); ?>
	
	<title><?php echo $title_for_layout; ?></title>
	
	<meta name="description" content="" />
	
    <link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	
	<?php 
        echo $html->css('simples/main');
    ?>
    
    <!--[if lte IE 7]><?php echo $html->css('simples/ie67') ?><![endif]-->
    
    <!-- JQuery Light MVC -->
    <script type="text/javascript" src="<?php echo $html->url(array('controller' => 'assets', 'action' => 'jlm')); ?>"></script>
    <script type="text/javascript">
    //<![CDATA[
        $.jlm.config({
            base: '<?php echo $this->base ?>',
            controller: '<?php echo $this->params['controller'] ?>',
            action: '<?php echo $this->params['action'] ?>' 
        });

        $(function() {
           $.jlm.dispatch(); 
        });
    //]]>
    </script>
    
</head>
<body>

<div id="wrap">
    <div id="header">
        <h1 id="site-title">
            <?php echo $html->link($siteName, '/', array('title' => 'View site home page')) ?>
        </h1>
        
        <div id="login-info">
            <?php echo $html->link('Log out', '/users/logout', array('id' => 'logout')); ?>
        </div>
    </div>

    <div id="sidebar">
        <h4>Site</h4>
        <?php 
            echo $navigation->create(array(
                'Dashboard' => '/' . Configure::read('Routing.admin'),
                'Pages' => array('controller' => 'pages'),
                'Messages' => array('controller' => 'messages'),
                'Files' => array('controller' => 'uploads'),
                'Users' => array('controller' => 'users'),
                'Settings' => array('controller' => 'settings')), array('class' => 'navigation'));
        ?>
        
        <h4>Blog</h4>
        <?php 
            echo $navigation->create(array(
                'Posts' => array('controller' => 'posts'),
                'Categories' => array('controller' => 'categories'),
                'Comments' => array('controller' => 'comments')), array('class' => 'navigation'));
        ?>
        
        <h4>Common tasks</h4>
        <ul id="common-tasks" class="navigation">
            <li><?php echo $html->link('<span>Write a new post</span>', '#WriteNewPost', array('class' => 'add-new-post', 'rel' => 'post'), null, false) ?></li>
            <li><?php echo $html->link('<span>Add a new page</span>', '#AddNewPage', array('class' => 'add-new-page', 'rel' => 'page'), null, false) ?></li>
        </ul>
        
    </div>
    
    <div id="content">
        <?php echo $content_for_layout ?>
        <span class="cleaner"></span>
    </div>
    <div id="push"></div>
</div>

<p id="footer">
    <?php echo $html->link('Powered by Simples', array('controller' => 'pages', 'action' => 'about')) ?> &bull; 
    <?php echo $html->link('Icons by DryIcons', 'http://dryicons.com') ?>
</p>

</body>
</html>

