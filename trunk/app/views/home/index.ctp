<div class="home">
	<a href="<?= $html->url(__('home:products_by_categories_url', true)) ?>" style="display:block; width:347px; height:445px; float:left; margin:0 45px 0 0;">
		<img src="<?= $html->url('/img/home-categories.jpg') ?>" alt="" />
		<p style="padding-left:5px"><?= __('home:products_by_categories') ?></p>
	</a>
	<a href="<?= $html->url(__('home:products_by_deployment_url', true)) ?>" style="display:block; width:347px; height:445px; float:left; margin:0;">
		<img src="<?= $html->url('/img/home-deployment.jpg') ?>" alt="" />
		<p style="padding-left:5px"><?= __('home:products_by_deployment') ?></p>
	</a>
	<br class="clear" />
</div>
