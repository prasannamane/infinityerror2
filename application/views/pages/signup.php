<div class="main-page">
    <div class="container">
	   <div class="col-md-6 left-main">
	        <div class="left-main-inner">
	            <div class="row">
		        <h2>Join the Stack Overflow community</h2>
			        <div class="left-box-discribtion">
			            <p><svg width="26" height="26" class="svg-icon mtn2"><path opacity=".5" d="M4.2 4H22a2 2 0 012 2v11.8a3 3 0 002-2.8V5a3 3 0 00-3-3H7a3 3 0 00-2.8 2z"></path><path d="M1 7c0-1.1.9-2 2-2h18a2 2 0 012 2v12a2 2 0 01-2 2h-2v5l-5-5H3a2 2 0 01-2-2V7zm10.6 11.3c.7 0 1.2-.5 1.2-1.2s-.5-1.2-1.2-1.2c-.6 0-1.2.4-1.2 1.2 0 .7.5 1.1 1.2 1.2zm2.2-5.4l1-.9c.3-.4.4-.9.4-1.4 0-1-.3-1.7-1-2.2-.6-.5-1.4-.7-2.4-.7-.8 0-1.4.2-2 .5-.7.5-1 1.4-1 2.8h1.9v-.1c0-.4 0-.7.2-1 .2-.4.5-.6 1-.6s.8.1 1 .4a1.3 1.3 0 010 1.8l-.4.3-1.4 1.3c-.3.4-.4 1-.4 1.6 0 0 0 .2.2.2h1.5c.2 0 .2-.1.2-.2l.1-.7.5-.7.6-.4z"></path></svg>Get unstuck — ask a question</p>
				        <p><svg width="26" height="26" class="svg-icon mtn2"><path d="M12 .7a2 2 0 013 0l8.5 9.6a1 1 0 01-.7 1.7H4.2a1 1 0 01-.7-1.7L12 .7z"></path><path opacity=".5" d="M20.6 16H6.4l7.1 8 7-8zM15 25.3a2 2 0 01-3 0l-8.5-9.6a1 1 0 01.7-1.7h18.6a1 1 0 01.7 1.7L15 25.3z"></path></svg>Unlock new privileges like voting and commenting</p>
				        <p><svg width="26" height="26" class="svg-icon mtn2"><path d="M14.8 3a2 2 0 00-1.4.6l-10 10a2 2 0 000 2.8l8.2 8.2c.8.8 2 .8 2.8 0l10-10c.4-.4.6-.9.6-1.4V5a2 2 0 00-2-2h-8.2zm5.2 7a2 2 0 110-4 2 2 0 010 4z"></path></svg>Save your favorite tags, filters, and jobs</p>
				        <p><svg width="26" height="26" class="svg-icon mtn2"><path d="M21 4V2H5v2H1v5c0 2 2 4 4 4v1c0 2.5 3 4 7 4v3H7s-1.2 2.3-1.2 3h14.4c0-.6-1.2-3-1.2-3h-5v-3c4 0 7-1.5 7-4v-1c2 0 4-2 4-4V4h-4zM5 11c-1 0-2-1-2-2V6h2v5zm11.5 2.7l-3.5-2-3.5 1.9L11 9.8 7.2 7.5h4.4L13 3.8l1.4 3.7h4L15.3 10l1.4 3.7h-.1zM23 9c0 1-1 2-2 2V6h2v3z"></path></svg>Earn reputation and badges</p>
			        </div>
		        </div>
		        
		        <div class="fs-body1 fc-light">Use the power of Stack Overflow inside your organization.<br>Try a <a href="#" target="_blank">free trial of Stack Overflow for Teams</a>.
                </div>
            </div>
	   </div>
	   <div class="col-md-6 right-main">
	       
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
                        <form action="<?=base_url('/home/signup')?>" method="POST">
                            <div class="form-group">
                                <label for="name">Display Name:</label>
                                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
	                            <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required name="checkme"><p>Passwords must contain at least eight characters, including at least 1 letter and 1 number.</p>
                                    </label>
                                </div>
	                       </div>
	                            
	                       <button type="submit" value="1" class="btn btn-info sign-up-btn-form btn-block" name="sumbit">Sign Up</button>
                            <div class="" >
                                By clicking “Sign up”, you agree to our 
                                <a href="#" name="tos" target="_blank" class="-link">terms of service</a>, 
                                <a href="#" name="privacy" target="_blank" class="-link">privacy policy</a> and 
                                <a href="#" name="cookie" target="_blank" class="-link">cookie policy</a>
                                <input type="hidden" name="legalLinksShown" value="1">
                            </div>
                        </form>
                    </div>
		        </div>
		    </div>
	    </div>
	</div>
</div>
</body>