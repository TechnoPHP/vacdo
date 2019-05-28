<aside>	
	<?php
		echo $this->element('Tagents.user_profile');
	?>

	<div class="mt-3">
		<h4>The Quote</h4>
		<p><?php echo $currentuser['Travelagentprofile']['quotes']; ?></p>
	</div><!-- End widget -->
	<hr>
</aside>