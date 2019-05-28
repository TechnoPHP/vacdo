<div class="container">
	<div id="<?php echo $key; ?>" class="<?php echo !empty($params['class']) ? $params['class'] : 'bg-warning'; ?>">
		<span class="border-danger border-bottom w-100 d-inline-block">Message failure</span>
		<?php echo $message; ?>
	</div>
</div>
