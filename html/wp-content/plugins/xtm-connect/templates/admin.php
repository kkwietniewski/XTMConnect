<div class="wrap">
    <h1>Hi!</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'xtm_options_group' );
			do_settings_sections( 'xtm_connect' );
			submit_button();
		?>
	</form>
    <h2>Choose Translation section in case you wanted to translate posts.</h2>
</div>