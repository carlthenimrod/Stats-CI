<div class="login-ctn">
	<h2><?php if($this->session->flashdata('errors')) echo $this->session->flashdata('errors'); ?></h2>

	<div class="sign-in">
		<p>Please Login Below!</p>

		<form method="POST" action="<?php echo current_url(); ?>" accept-charset="UTF-8">
			<div class="text-field">
				<label for="email">Email:</label>

				<input type="email" id="email" autofocus="autofocus" name="email" />
			</div><!-- .text-field -->

			<div class="text-field">
				<label for="password">Password:</label>

				<input type="password" id="password" name="password" />
			</div><!-- .text-field -->	

			<div class="sign-in-button">
				<input type="submit" name="submit" class="btn" value="Login" />
			</div>
		</form>
	</div><!-- .sign-in -->
</div><!-- .login-ctn -->