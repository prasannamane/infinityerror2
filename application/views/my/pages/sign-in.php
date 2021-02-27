<div class="container main-content page-full-width">
	<div class="row">
		<div class="with-sidebar-container">
			<div class="col-md-12">
				<div class="login">
			        <div class="row">
						<div class="col-md-6">
					    <?php if($this->session->flashdata('success')){?>
                            <div class="alert alert-success">      
                                <?php echo $this->session->flashdata('success')?>
                            </div>
                        <?php } ?>
            
                        <?php if($this->session->flashdata('danger')){?>
                            <div class="alert alert-danger">      
                                <?php echo $this->session->flashdata('danger')?>
                            </div>
                        <?php } ?>
						<div class="page-content">
							<h2>Login</h2>
							<div class="form-style form-style-3">
								<div class="ask_form inputs">
			<form class="" action="<?=base_url('Home/signin')?>" method="post">
				<div class="ask_error"></div>
				
				<div class="form-inputs clearfix">
					<p class="login-text">
						<input class="required-item" type="text" placeholder="email" value="" onfocus="if (this.value == 'Username') {this.value = '';}" 
						onblur="if (this.value == '') {this.value = 'Username';}" name="email">
						<i class="icon-user"></i>
					</p>
					<p class="login-password">
						<input class="required-item" type="password" value="" placeholder="password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}" name="pwd">
						<i class="icon-lock"></i>
						<a href="#">Forgot ?</a>
					</p>
				</div>
				<p class="form-submit login-submit">
					<span class="loader_2"></span>
					<input type="submit" value="Log in" name="login" class="button color small login-submit submit sidebar_submit">
					
				</p>
				<div class="rememberme">
					<label><input type="checkbox" name="rememberme" checked="checked"> Remember Me</label>
				</div>
				
				<input type="hidden" name="redirect_to" value="https://fluentthemes.com/wp/knowledge/sign-in-to-your-account/">
				<input type="hidden" name="login_nonce" value="be8f0d127a">
				<input type="hidden" name="ajax_url" value="https://fluentthemes.com/wp/knowledge/wp-admin/admin-ajax.php">
				<input type="hidden" name="form_type" value="ask-login">
				<div class="errorlogin"></div>
			</form>
		</div>							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
					<div class="col-md-6">
						<div class="page-content">
							<h2>Register Now</h2>
							<p>When you Register, you agree to our User Agreement and acknowledge reading our User Privacy Notice.</p>
							<a class="button small color signup">Create an account</a>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
							</div><!-- End row -->
		</div><!-- End login -->
									
				</div><!-- End main -->
									<aside class="col-md-4 sidebar sticky-sidebar" style="">
											</aside><!-- End sidebar -->
								<div class="clearfix"></div>
			</div><!-- End with-sidebar-container -->
		</div><!-- End row -->
	</div>