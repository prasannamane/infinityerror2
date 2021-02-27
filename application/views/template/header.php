<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="<?=base_url('home')?>">Infinity Errors</a>
            </div>
    
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav ">
                    <li><a href="#myPage">Products</a></li>
                    <li><a href="#band">Customers</a></li>
		            <li><a href="#band">Use cases</a></li>
                </ul>
	            <ul class="nav navbar-nav navbar-right">
	            <?php if($this->session->userdata('userdata') == '') 
      	        { 
      	            ?>
      	            <li><a href="<?=base_url('home/signin')?>" type="button" class="btn btn-primary log-in-btn">Sign-In</a></li>
                    <li><a href="<?=base_url('home/signup')?>" type="button" class="btn btn-primary sign-up-btn">Sign-Up</a></li>
                    <?php
      	        }
      	        else
      	        {
      	            ?>
      	            <li><a href="<?=base_url('home/signout')?>" type="button" class="btn btn-primary log-in-btn">Sign-Out</a></li>
                   
                    <?php
      	        }
      	        ?>
                    
                </ul>
            </div>
        </div>
    </nav>