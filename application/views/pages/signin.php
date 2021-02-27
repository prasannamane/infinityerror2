<div class="main-page">
    <div class="container">
	    <div class="col-md-6 right-main max-auto">
	        
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
            
	        <div class="right-main-inner">
	            <div class="row">
		            <div class="">
                        <form action="<?=base_url('/home/signin')?>" method="POST">
                            
                            <div class="form-group">
                                <label for="name">Username:</label>
                                <input type="email" class="form-control" id="name" placeholder="Enter email" name="email">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">password:<span class="pull-right fright"><a href="#" class="pull-right fright">Forgot Password</a></span></label>
                                <input type="password" class="form-control" id="email" placeholder="Enter password" name="password">
                            </div>
                            
                            <button type="submit" name="login" value="1" class="btn btn-info sign-up-btn-form btn-block">Log In</button>
	                        
	                        <div class="" >
                                <div class="mx-auto ta-center fs-body1 p16 pb0 mb24 w100 wmx3" bis_skin_checked="1">
                                    Don't have an account? <a href="<?=base_url('/home/signup')?>">Sign up</a>
                                
                                    <div class="mt12" bis_skin_checked="1">
                                        Are you an employer? <a href="login.php" name="talent">Sign up on Talent 
                                        <svg aria-hidden="true" class="va-text-bottom sm:d-none svg-icon iconShareSm" width="14" height="14" viewBox="0 0 14 14"><path d="M5 1H3a2 2 0 00-2 2v8c0 1.1.9 2 2 2h8a2 2 0 002-2V9h-2v2H3V3h2V1zm2 0h6v6h-2V4.5L6.5 9 5 7.5 9.5 3H7V1z"></path></svg></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
		        </div>
		    </div>
	    </div>
	</div>
</div>