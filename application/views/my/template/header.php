<header id="header" class="">
	<div class="container clearfix" itemscope="" itemtype="http://schema.org/Thing">
		<div class="logo"> <a class="logo-img" href="<?=base_url('home')?>" itemprop="url" title="Knowledge Q/A Theme"> 
            <img class="default_logo lazyloaded" itemprop="logo" alt="Knowledge Q/A Theme" src="<?=base_url('myassets/image/logo-knowledge.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/logo-knowledge.png" data-was-processed="true">
            <noscript>
                <img class="default_logo" itemprop="logo" alt="Knowledge Q/A Theme" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/logo-knowledge.png">
            </noscript> 
            <img class="retina_logo" itemprop="logo" alt="Knowledge Q/A Theme" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/logo-knowledge.png"><noscript>
                <img class="retina_logo" itemprop="logo" alt="Knowledge Q/A Theme" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/logo-knowledge.png"></noscript> </a>
			<meta itemprop="name" content="Knowledge Q/A Theme">
		</div>
		<nav class="navigation">
			<div class="header-menu">
				<ul><!--
					<li id="menu-item-271" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-271"> <a href="https://fluentthemes.com/wp/knowledge/how-it-works/">How It Works</a></li>
					<li id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6"> <a href="https://fluentthemes.com/wp/knowledge/questions/">Browse Questions</a></li>
					<li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-263 parent-list"> <a href="https://fluentthemes.com/wp/knowledge/blog-full-width/">Blog </a>
						<ul class="sub-menu" style="overflow: hidden; height: auto; padding-top: 0px; display: none;">
							<li id="menu-item-266" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-266"> <a href="https://fluentthemes.com/wp/knowledge/blog-full-width/">Blog Full Width</a></li>
							<li id="menu-item-265" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-265"> <a href="https://fluentthemes.com/wp/knowledge/blog-right-sidebar/">Blog Right Sidebar</a></li>
							<li id="menu-item-264" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-264"> <a href="https://fluentthemes.com/wp/knowledge/blog-left-sidebar/">Blog Left Sidebar</a></li>
							<li id="menu-item-267" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-267"> <a href="https://fluentthemes.com/wp/knowledge/how-to-prevent-my-website-from-being-scrolled-horizontally-2/">Blog Details Page</a></li>
						</ul>
					</li> -->
					<!--
					<li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-20 parent-list"> <a href="https://fluentthemes.com/wp/knowledge/#">Pages </a>
						<ul class="sub-menu" style="display: none;">
							<li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-13 current_page_item menu-item-23"> <a href="https://fluentthemes.com/wp/knowledge/" aria-current="page">Home – Default Style</a></li>
							<li id="menu-item-307" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-307"><a href="http://fluentthemes.com/wp/knowledgebase/">Home – Help Desk Sylte</a></li>
							<li id="menu-item-221" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-221"> <a href="https://fluentthemes.com/wp/knowledge/questions/">Questions Page</a></li>
							<li id="menu-item-125" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-125"><a href="https://fluentthemes.com/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/">Question Detail</a></li>
							<li id="menu-item-220" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-220"><a href="https://fluentthemes.com/wp/knowledge/add-question/">Add Question Page</a></li>
							<li id="menu-item-219" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-219"> <a href="https://fluentthemes.com/wp/knowledge/sign-in-to-your-account/">Login Page</a></li>
							<li id="menu-item-177" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-177"><a href="https://fluentthemes.com/wp/knowledge/users/">Users</a></li>
							<li id="menu-item-129" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-129"><a href="https://fluentthemes.com/wp/knowledge/contact/">Contact Us</a></li>
							<li id="menu-item-270" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-270"> <a href="https://fluentthemes.com/wp/knowledge/contact-with-map/">Contact With Map</a></li>
						</ul>
					</li> -->
				<li class="menu-item-pq publish-question">
			<?php	
				 if($this->session->userdata('userdata') == '') 
      	    { 
      	        ?>
      	        <a href="<?=base_url('Home/signin')?>">Post Question</a>
      	        <?php 
      	    }
      	    else
      	    {
      	        ?><a href="<?=base_url('Home/askquestion')?>">Post Question</a> <?php
      	    }
				?>
				</ul>
			</div>
		</nav>
		<nav class="navigation_mobile navigation_mobile_main">
			<div class="infocenter_mobile_click">Go to...</div>
			<ul><!--
				<li id="menu-item-271" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-271"><a href="https://fluentthemes.com/wp/knowledge/how-it-works/">How It Works</a></li>
				<li id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6"><a href="https://fluentthemes.com/wp/knowledge/questions/">Browse Questions</a></li>
				<li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-263"><a href="https://fluentthemes.com/wp/knowledge/blog-full-width/">Blog</a>
					<ul class="sub-menu">
						<li id="menu-item-266" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-266"><a href="https://fluentthemes.com/wp/knowledge/blog-full-width/">Blog Full Width</a></li>
						<li id="menu-item-265" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-265"><a href="https://fluentthemes.com/wp/knowledge/blog-right-sidebar/">Blog Right Sidebar</a></li>
						<li id="menu-item-264" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-264"><a href="https://fluentthemes.com/wp/knowledge/blog-left-sidebar/">Blog Left Sidebar</a> </li>
						<li id="menu-item-267" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-267"><a href="https://fluentthemes.com/wp/knowledge/how-to-prevent-my-website-from-being-scrolled-horizontally-2/">Blog Details Page</a></li>
					</ul>
				</li>
				<li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-20"> <a href="https://fluentthemes.com/wp/knowledge/#">Pages</a>
					<ul class="sub-menu">
						<li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-13 current_page_item menu-item-23"> <a href="https://fluentthemes.com/wp/knowledge/" aria-current="page">Home – Default Style</a></li>
						<li id="menu-item-307" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-307"><a href="http://fluentthemes.com/wp/knowledgebase/">Home – Help Desk Sylte</a></li>
						<li id="menu-item-221" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-221"> <a href="https://fluentthemes.com/wp/knowledge/questions/">Questions Page</a></li>
						<li id="menu-item-125" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-125">
							< a href="https://fluentthemes.com/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/">Question Detail</a>
						</li>
						<li id="menu-item-220" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-220"><a href="https://fluentthemes.com/wp/knowledge/add-question/">Add Question Page</a></li>
						<li id="menu-item-219" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-219"> <a href="https://fluentthemes.com/wp/knowledge/sign-in-to-your-account/">Login Page</a></li>
						<li id="menu-item-177" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-177"> <a href="https://fluentthemes.com/wp/knowledge/users/">Users</a></li>
						<li id="menu-item-129" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-129"><a href="https://fluentthemes.com/wp/knowledge/contact/">Contact Us</a></li>
						<li id="menu-item-270" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-270"><a href="https://fluentthemes.com/wp/knowledge/contact-with-map/">Contact With Map</a></li>
					</ul>
				</li>-->
				<li class="menu-item-pq publish-question ">
			<?php	
				 if($this->session->userdata('userdata') == '') 
      	    { 
      	        ?>
      	        <a  href="<?=base_url('Home/signin')?>">Post Question</a>
      	        <?php 
      	    }
      	    else
      	    {
      	         ?><a href="<?=base_url('Home/askquestion')?>">Post Question</a> <?php
      	    }
				?>
				
				</li>
			</ul> 
		</nav>
	</div>
</header>