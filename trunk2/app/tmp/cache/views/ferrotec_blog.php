<!--cachetime:--><?php
			App::import('Controller', 'Posts');
			$controller =& new PostsController();
				$controller->plugin = $this->plugin = '';
				$controller->helpers = $this->helpers = unserialize('a:15:{i:0;s:5:"Cache";i:1;s:8:"Category";i:2;s:4:"Form";i:3;s:5:"Habtm";i:4;s:4:"Html";i:5;s:4:"List";i:6;s:9:"PostsList";i:7;s:3:"Rss";i:8;s:7:"Textile";i:9;s:4:"Time";i:10;s:10:"Breadcrumb";i:11;s:3:"Cms";i:12;s:10:"Javascript";i:13;s:10:"Navigation";i:14;s:9:"Paginator";}');
				$controller->base = $this->base = '/ferrotec';
				$controller->layout = $this->layout = 'default';
				$controller->webroot = $this->webroot = '/ferrotec/';
				$controller->here = $this->here = '/ferrotec/blog';
				$controller->namedArgs  = $this->namedArgs  = '';
				$controller->argSeparator = $this->argSeparator = '';
				$controller->params = $this->params = unserialize(stripslashes('a:13:{s:4:\"pass\";a:0:{}s:5:\"named\";a:0:{}s:6:\"plugin\";N;s:10:\"controller\";s:5:\"posts\";s:6:\"action\";s:5:\"index\";s:4:\"form\";a:0:{}s:3:\"url\";a:1:{s:3:\"url\";s:4:\"blog\";}s:10:\"breadcrumb\";a:2:{i:0;a:2:{s:5:\"title\";s:4:\"Home\";s:3:\"url\";s:1:\"/\";}i:1;a:1:{s:5:\"title\";s:4:\"News\";}}s:7:\"current\";a:2:{s:4:\"type\";s:4:\"post\";s:4:\"slug\";s:4:\"blog\";}s:6:\"isAjax\";b:0;s:6:\"paging\";a:1:{s:4:\"Post\";a:8:{s:4:\"page\";i:1;s:7:\"current\";i:5;s:5:\"count\";i:8;s:8:\"prevPage\";b:0;s:8:\"nextPage\";b:1;s:9:\"pageCount\";i:2;s:8:\"defaults\";a:4:{s:5:\"limit\";i:5;s:4:\"step\";i:1;s:5:\"order\";a:1:{s:12:\"Post.created\";s:4:\"desc\";}s:10:\"conditions\";s:14:\"Post.draft = 0\";}s:7:\"options\";a:4:{s:4:\"page\";i:1;s:5:\"limit\";i:5;s:5:\"order\";a:1:{s:12:\"Post.created\";s:4:\"desc\";}s:10:\"conditions\";s:14:\"Post.draft = 0\";}}}s:7:\"Simples\";a:1:{s:4:\"view\";a:8:{s:8:\"siteName\";s:10:\"Wildflower\";s:15:\"siteDescription\";s:13:\"A CakePHP CMS\";s:8:\"isLogged\";b:0;s:12:\"isAuthorized\";b:0;s:6:\"isPage\";b:0;s:7:\"isPosts\";b:1;s:6:\"isHome\";b:0;s:10:\"homePageId\";i:52;}}s:6:\"models\";a:3:{i:0;s:4:\"Post\";i:1;s:7:\"Setting\";i:2;s:4:\"User\";}}'));
				$controller->action = $this->action = unserialize('s:5:"index";');
				$controller->data = $this->data = unserialize(stripslashes('N;'));
				$controller->themeWeb = $this->themeWeb = '';
				Router::setRequestInfo(array($this->params, array('base' => $this->base, 'webroot' => $this->webroot)));
				$loadedHelpers = array();
				$loadedHelpers = $this->_loadHelpers($loadedHelpers, $this->helpers);
				foreach (array_keys($loadedHelpers) as $helper) {
					$camelBackedHelper = Inflector::variable($helper);
					${$camelBackedHelper} =& $loadedHelpers[$helper];
					$this->loaded[$camelBackedHelper] =& ${$camelBackedHelper};
				}
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <title>News &bull; Wildflower - A CakePHP CMS</title>
    
    <meta name="description" content="" />
    
    <link rel="icon" href="/ferrotec/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/ferrotec/favicon.ico" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="Wildflower Feed" href="/ferrotec/posts/feed" />
    
    
	<link rel="stylesheet" type="text/css" href="/ferrotec/css/ferrotec/main.css" />
        
    <script type="text/javascript">
        BASE = '/ferrotec';
    </script>
</head>
<body>

    <div id="wrap">
    
        <div id="header">   
            <h1><a href="/ferrotec/"><span>News &bull; Wildflower - A CakePHP CMS</span></a></h1>
        </div>
        
        <hr />
        
        <ul><li class=""><a href="/ferrotec/"><span>Home</span></a></li>
<li class=""><a href="/ferrotec/feature-tour"><span>Feature tour</span></a></li>
<li class="current"><a href="/ferrotec/blog"><span>Blog</span></a></li>
<li class=""><a href="/ferrotec/documentation"><span>Documentation</span></a></li>
<li class=""><a href="/ferrotec/contact"><span>Contact</span></a></li>
</ul>
        
        <hr />
        
        <div id="content">
            <div id="primary-content">

    
        <div class="post" id="post-1">
        <h2><a href="/ferrotec/blog/a-shiny-new-post">There are not many posts out there</a></h2>
        <small class="post-date">Posted Thu, Sep 11th 2008, 14:48</small>
        
        <div class="entry">
            <div id="lipsum">
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In imperdiet odio in augue. Sed pharetra. Nullam faucibus odio. Nam rhoncus tristique augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer congue dapibus metus. Phasellus sed elit sodales orci iaculis tincidunt. Duis hendrerit, nulla eu hendrerit fermentum, diam sapien commodo enim, sed rutrum purus sapien sed pede. Phasellus vitae quam. Morbi aliquam, leo vitae consectetuer consectetuer, ligula diam volutpat eros, imperdiet egestas nulla tortor ac dui. Etiam feugiat, dui nec pharetra pharetra, erat augue vulputate sapien, ut tristique lacus felis at eros. Pellentesque eu erat. Nullam aliquet mollis dolor. Ut est orci, tempus pellentesque, semper sit amet, scelerisque in, quam. Aliquam consequat, orci nec ullamcorper condimentum, nibh ligula dictum nulla, eget pulvinar velit lacus sit amet nulla. Etiam semper faucibus mi. Aenean nunc sapien, venenatis vitae, dapibus sit amet, auctor non, lacus. Phasellus porttitor ante sit amet turpis. Vestibulum nec erat. Maecenas eros.</p>
<p>Nullam quis nulla non sapien interdum varius. Cras hendrerit elementum leo. Fusce tincidunt, justo eu eleifend elementum, ante arcu blandit dolor, quis ullamcorper dui tellus sit amet quam. Vestibulum vulputate. Morbi mi odio, consectetuer ut, vulputate vitae, tristique ut, ipsum. Donec ipsum tortor, pulvinar a, pulvinar eget, commodo non, odio. Nullam dolor. Aliquam erat volutpat. Phasellus libero. Vivamus luctus lobortis libero. Ut ut elit. Sed elementum quam nec arcu. Nam id tellus non odio fermentum convallis. Nam a lacus.</p>
<p>Phasellus ante arcu, gravida a, lobortis sit amet, volutpat non, velit. Nulla consectetuer quam gravida nulla. Integer eu purus. Morbi sit amet nunc. Mauris vehicula lacus ac lectus. Proin tortor nisl, faucibus non, molestie nec, tincidunt non, justo. Suspendisse massa lectus, hendrerit aliquam, elementum et, iaculis non, nunc. Etiam non dui. Morbi gravida massa sollicitudin ipsum. Suspendisse magna ante, facilisis ac, sagittis et, placerat et, diam. Fusce facilisis, nulla ac accumsan facilisis, mi nisi tristique quam, malesuada pulvinar neque leo ut augue. Mauris dui.</p>
<p>Etiam nec risus at leo ullamcorper lobortis. In rhoncus massa ac velit. Nullam mollis consequat ligula. Integer iaculis, enim sed cursus hendrerit, neque dolor hendrerit erat, dignissim egestas quam quam vel quam. Etiam tellus libero, molestie non, mattis in, venenatis sed, dui. Proin non nisl ut massa ullamcorper interdum. Aliquam erat volutpat. Sed gravida. Quisque quis magna. Quisque non metus. Nullam euismod suscipit elit. Vivamus quis risus. Phasellus ut lectus. Nunc velit sem, viverra sed, convallis eu, convallis a, nisl. Maecenas bibendum orci in enim. Sed orci. Nullam adipiscing pellentesque purus. Sed risus orci, consequat nec, ornare sed, condimentum semper, mi. Fusce hendrerit, justo non volutpat pretium, neque mauris placerat est, id pretium mauris libero id eros.</p>
<p>Sed risus mi, vestibulum ac, tincidunt at, condimentum id, tortor. Donec non mauris sed leo auctor auctor. Nullam facilisis. Quisque eu ipsum. Donec quis sem. Morbi rutrum magna in justo. Vestibulum eu orci. Praesent placerat, ipsum eget bibendum vulputate, velit dolor ultrices metus, tempus congue est lorem a eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam consectetuer erat et urna.</p>
</div>        </div>
        
                <p class="postmeta">Posted in <a href="/ferrotec/tag/personal-develompent">Personal Development</a>.</p>
                
                
    </div>
        <div class="post" id="post-27">
        <h2><a href="/ferrotec/blog/my-new-post">my new post</a></h2>
        <small class="post-date">Posted Tue, Sep 9th 2008, 21:04</small>
        
        <div class="entry">
                    </div>
        
                <p class="postmeta">Posted in <a href="/ferrotec/tag/personal-develompent">Personal Development</a>.</p>
                
                
    </div>
        <div class="post" id="post-26">
        <h2><a href="/ferrotec/blog/lala-lala-la">lala lala la</a></h2>
        <small class="post-date">Posted Sun, Aug 17th 2008, 18:53</small>
        
        <div class="entry">
                    </div>
        
                
                
    </div>
        <div class="post" id="post-25">
        <h2><a href="/ferrotec/blog/test">test</a></h2>
        <small class="post-date">Posted Sun, Aug 17th 2008, 18:02</small>
        
        <div class="entry">
            <p><img src="/wildflower/img/thumb/vetton_ru_501.jpg/120/120/1" alt="" /><img src="/wildflower/img/thumb/Good_Vibrations-1440x900.jpg/120/120/1" alt="" /></p>
<p>Abcdedfgh.</p>        </div>
        
                
                
    </div>
        <div class="post" id="post-23">
        <h2><a href="/ferrotec/blog/loool-post">loool post</a></h2>
        <small class="post-date">Posted Sun, Aug 17th 2008, 17:59</small>
        
        <div class="entry">
            <p>dasdas</p>        </div>
        
                
                
    </div>
        
    <div class="paginator"><span class="paginate-page paginate-prev">« Previous</span> <a href="/ferrotec/blog" class="paginate-page current">1</a> <a href="/ferrotec/blog/index/page:2" class="paginate-page">2</a> <a href="/ferrotec/blog/index/page:2" class="paginate-page paginate-next">Next »</a></div>    
</div>
            <span class="cleaner">&nbsp;</span>
        </div>
        
        <hr />
        
        <div id="footer">
	        <p>Powered by <img src="/ferrotec/img/simples/small-logo.gif" alt="Simples" class="simples-icon" /> <a href="/ferrotec/">Simples</a>. </p>
	        
	            <div class="wilflower-in-debug" style="background:#eee;font-size:14px;color:#000;
        text-align:left;width:300px;padding:3px;margin:15px auto;">
        <h6 style="margin:0 4px;font-size:14px;">Site is in debug mode #1</h6>
        <p style="background:#fff;color:#000;padding:3px;">
            In production turn this to <em>0</em> in <em>/app/config/core.php</em></p>
    </div>
	    </div>
        
    </div>
    
    <!-- Google Analytic turned off in debug mode. -->    
</body>
</html>

