<style>
	.container2 {
		position: relative;
		text-align: center;
		color: white;
	}

	.centered {
		width: 27%;
		align-items: center;
		position: absolute;
		top: 20%;
		color: white;
		left: 17%;
		transform: translate(-50%, -50%);
	}
</style>
<div class="container main-content page-full-width">
	<div class="row">
		<div class="with-sidebar-container">
			<div class="col-md-12">
				<div class="tabs-warp question-tab">
					<div class="borderbottom">
						<ul class="tabs">
							<li class="tab">
								<a href="<?= base_url('#') ?>" data-js="recent_questions" class="current"> 
								<i class="icofont icon-ribbon" aria-hidden="true"></i> <span>Recent Questions</span></a>
							</li>
							<li class="tab">
								<a href="<?= base_url('#') ?>" data-js="most_responses"> <i class="icofont icon-layers" aria-hidden="true"></i> 
								<span>Popular Questions</span></a>
							</li>
							<li class="tab">
								<a href="<?= base_url('#') ?>" data-js="recently_answered"> 
								<i class="icofont icon-global" aria-hidden="true"></i> <span>Recent Responses</span></a>
							</li>
							<li class="tab">
								<a href="<?= base_url('#') ?>" data-js="no_answers"> 
								<i class="icofont icon-linegraph" aria-hidden="true"></i> <span>Not Answered</span></a>
							</li>
						</ul>
					</div>

					<?php $this->load->view('my/pages/home-recent-questions'); ?> 
					<?php $this->load->view('my/pages/home-most-responses'); ?> 
					<?php $this->load->view('my/pages/home-recently-answered'); ?> 
					<?php $this->load->view('my/pages/home-no-answers'); ?> 

				<div class="post-content">

					<div class="parallex section-padding fun-facts-bg text-center" data-stellar-background-ratio="0.1" style="background: url(&quot;<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/facts-parallex.jpg&quot;) 50% -1558.8px / cover repeat scroll rgba(0, 0, 0, 0);">
						<div class="container">
							<div class="row">
								<div class="col-xs-6 col-sm-3 col-md-3">
									<div class="statistic-percent" data-perc="126">
										<div class="facts-icons">
											<span class="icon-user"></span>

										</div>
										<div class="fact">
											<span class="percentfactor">126</span>
											<p>Happy Clients</p>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-sm-3 col-md-3">
									<div class="statistic-percent" data-perc="226">
										<div class="facts-icons"> <span class="icon-trophy"></span>
										</div>
										<div class="fact"> <span class="percentfactor">226</span>
											<p>Happy Clients</p>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-sm-3 col-md-3">
									<div class="statistic-percent" data-perc="336">
										<div class="facts-icons"> <span class="icon-megaphone"></span></div>
										<div class="fact"> <span class="percentfactor">336</span>
											<p>Happy Clients</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-sm-3 col-md-3">
									<div class="statistic-percent" data-perc="446">
										<div class="facts-icons"> <span class="icon-chat"></span></div>
										<div class="fact"> <span class="percentfactor">446</span>
											<p>Chat Available</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>







					<div id="social-media">
						<div class="block no-padding">
							<div class="row">
								<div class="col-md-12">
									<div class="social-bar">
										<ul>
											<li class="social1"> <a title="social-url" href="https://www.facebook.com/">
													<img alt="image" src="<?= base_url('myassets/image/facebook.png') ?>" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/facebook.png" class="lazyloaded" data-was-processed="true"><noscript>
														<img alt="image" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/facebook.png"></noscript>

													<span>Join Us On<strong>Facebook</strong></span> </a>
											</li>

											<li class="social2"> <a title="social-url" href="https://twitter.com/">
													<img alt="image" src="<?= base_url('myassets/image/twitter.png') ?>" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/twitter.png" class="lazyloaded" data-was-processed="true"><noscript>
														<img alt="image" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/twitter.png"></noscript>
													<span>Join Us On<strong>TWIITER</strong></span>
												</a></li>
											<li class="social3"> <a title="social-url" href="https://plus.google.com/">
													<img alt="image" src="<?= base_url('myassets/image/google-plus.png') ?>" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/google-plus.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="image" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/google-plus.png"></noscript>
													<span>Join Us On<strong>GOOGLE PLUS</strong></span> </a></li>
											<li class="social4"> <a title="social-url" href="https://www.linkedin.com/">
													<img alt="image" src="<?= base_url('myassets/image/linkedin.png') ?>" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/linkedin.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="image" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/01/linkedin.png"></noscript> <span>Join Us On<strong>LINKEDIN</strong></span> </a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				
					</div>
				</div>
			</div>
		
		
			</div>
		</div>
	</div>
</div></div>