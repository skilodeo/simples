<h1 class="float"><?= __('h1:'.$pageKey); ?></h1>
<h2 class="follow">»<?= $needle; ?>«</h2>
<br class="clear" /><hr />

<div class="showcase">
	<?= $list->createProductList($results,$lang) ?>
</div>