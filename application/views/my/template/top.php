<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 ">
                <ul id="menu-left-top-bar" class="top-nav nav-left">
                    <li><a href="<?=base_url('home')?>">Home</a></li>
                  <!--  <li><a href="<?=base_url('home/blog')?>">Blog</a></li> -->
                    <li><a href="<?=base_url('home/contact')?>">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <ul id="menu-not-login-top-bar" class="top-nav nav-right">
             <?php       
                     if($this->session->userdata('userdata') == '') 
      	    { 
      	        ?>
      	         <li id="nav-menu-item-100" class=" dropdown menu-item-even menu-item-depth-0 login-comments menu-item menu-item-type-custom menu-item-object-custom">
                        <a href="https://fluentthemes.com/wp/knowledge/#">
                            <i class="fa fa-lock" aria-hidden="true"></i>SIGNIN</a>
                    </li>
                    
                    <li id="nav-menu-item-99" class=" dropdown menu-item-even menu-item-depth-0 signup menu-item menu-item-type-custom menu-item-object-custom">
                        <a href="https://fluentthemes.com/wp/knowledge/#">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>SIGNUP</a>
                    </li>
                    <?php
      	    }
      	    else
      	    {
      	        ?>
      	          <li id="nav-menu-item-98" class=" dropdown menu-item-even menu-item-depth-0 lost-password menu-item menu-item-type-custom menu-item-object-custom">
                        <a href="<?=base_url('home/signout')?>">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>SIGNOUT</a>
                    </li>
      	        <?php
      	      
      	    }
      	    
      	    ?>
                    
                   
                    
                  
                </ul>
            </div>
        </div>
    </div>
</div>