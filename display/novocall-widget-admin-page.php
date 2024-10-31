<div class='wrap'>
	<h1>Novocall</h1>

	<p style="
		color: #31708f; 
		background-color: #d9edf7; 
		padding: 15px;
		border: 1px solid #bce8f1;
		border-radius: 4px;
		line-height: 190%;"> 
			Find Novocall code in your dashboard on <a href="https://call.novocall.co" target="_blank">here</a>.
			<br>
			Navigate to Settings > Widget Settings > Installations from the dashboard.
	</p>

	<form method="post" action="options.php">
		<?php
			$active_novocall = get_option('novocall-widget-active-novocall');
			$code_novocall = get_option('novocall-widget-code-novocall');

			settings_fields( $this->plugin_name . '-settings' );
			do_settings_sections( $this->plugin_name . '-settings' );
		?>

		<div style="margin-top: 3em;">
			<h2>Settings:</h2>
	    <label for="<?php echo $this->plugin_name . '-active_novocall'; ?>">
	      <input type="checkbox" 
	      			 name="<?php echo $this->plugin_name . '-active-novocall'; ?>"
	      			 value="1" 
	      			 <?php checked($active_novocall, 1); ?> />
	      <span>Enable Novocall on my website</span>
      </label>
    </div>

		<div style="margin-top: 3em;">
			<h2>Insert code:</h2>
			<textarea name="<?php echo $this->plugin_name . '-code-novocall';?>"
								cols="100" 
								rows="6" 
								placeholder="Enter Novocall code here">
				<?php echo $code_novocall;?>
			</textarea>
		</div>

		<?php submit_button('Save Settings'); ?>
	</form>
</div>