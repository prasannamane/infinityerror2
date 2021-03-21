<div class="container main-content page-right-sidebar">
	<div class="row">
		<div class="with-sidebar-container">
			<div class="col-md-8">
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<?php echo $this->session->flashdata('success') ?>
					</div>
				<?php }
				if ($this->session->flashdata('danger')) { ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('danger') ?>
					</div>
				<?php } ?>

				<?php foreach ($details as $row) {
					//			    SELECT `id`, `title`, `user_id`, `video`, `description`, `vote`, `view`, `answer`, `created_at`, `updated_at` FROM `quetions` WHERE 1
				?>
					<article class="question single-question question-type-normal post-279 type-question status-publish hentry question-category-wordpress question_tags-php question_tags-wordpress" id="post-279" itemscope="" itemtype="http://schema.org/Article">
						<h2 itemprop="name"><?= $row['title'] ?></h2>
						<a class="question-report report_q" href="#">Report</a>
						<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
						<div class="question-inner">
							<span class="question-date" itemprop="datePublished">
								<i class="icon-time"></i><?= $row['created_at'] ?></span>
							<span class="question-view"><i class="icon-eye-open"></i><?= $row['view'] ?> views</span>

							<div class="clearfix"></div>
							<div class="question-desc" itemprop="mainContentOfPage">
								<div class="infocenter-question-reporting">

									<h3>Please explain why do you think this question should be reported?</h3>
									<textarea name="infocenter-question-reporting"></textarea>
									<div class="clearfix"></div>
									<div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a>
								</div>
								<p><?= $row['description'] ?></p>
								<div>
									<?php if ($row['youtube'] != "") { ?>
										<a href="<?= $row['youtube'] ?>" target="_blanck"><img style=" margin: 5px; border-radius: 12px; border: 5px solid #cee0ed;" src="<?= base_url('myassets/image/play.jpg') ?>" alt="Snow"></a>
									<?php } ?>
								</div>
								<p><strong>Video Structure</strong>
								</p>
								<div>
									<div id="highlighter_95752" class="syntaxhighlighter php">
										<?php if ($row['video'] != "") { ?>
											<video controls>
												<source src="<?= base_url() ?>/<?= $row['video'] ?>" type="video/mp4">
											</video>
										<?php } ?>



										<!--			<table border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td class="gutter">
													<div class="line number1 index0 alt2">1</div>
													<div class="line number2 index1 alt1">2</div>
													<div class="line number3 index2 alt2">3</div>
													<div class="line number4 index3 alt1">4</div>
													<div class="line number5 index4 alt2">5</div>
													<div class="line number6 index5 alt1">6</div>
													<div class="line number7 index6 alt2">7</div>
													<div class="line number8 index7 alt1">8</div>
													<div class="line number9 index8 alt2">9</div>
													<div class="line number10 index9 alt1">10</div>
													<div class="line number11 index10 alt2">11</div>
													<div class="line number12 index11 alt1">12</div>
													<div class="line number13 index12 alt2">13</div>
													<div class="line number14 index13 alt1">14</div>
													<div class="line number15 index14 alt2">15</div>
													<div class="line number16 index15 alt1">16</div>
													<div class="line number17 index16 alt2">17</div>
												</td>
												<td class="code">
													<div class="container">
														<div class="line number1 index0 alt2"><code class="php plain">&lt;section </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"row"</code><code class="php plain">&gt;</code>
														</div>
														<div class="line number2 index1 alt1"></div>
														<div class="line number3 index2 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;div </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"col-sm-3 col-md-2 sidebar"</code><code class="php plain">&gt;</code>
														</div>
														<div class="line number4 index3 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;ul </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"nav nav-sidebar"</code><code class="php plain">&gt;</code>
														</div>
														<div class="line number5 index4 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;li </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"active"</code><code class="php plain">&gt;&lt;a href=</code><code class="php string">"#"</code><code class="php plain">&gt;Overview&lt;/a&gt;&lt;/li&gt;</code>
														</div>
														<div class="line number6 index5 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;li&gt;&lt;a href=</code><code class="php string">"#"</code><code class="php plain">&gt;Reports&lt;/a&gt;&lt;/li&gt;</code>
														</div>
														<div class="line number7 index6 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;li&gt;&lt;a href=</code><code class="php string">"#"</code><code class="php plain">&gt;Analytics&lt;/a&gt;&lt;/li&gt;</code>
														</div>
														<div class="line number8 index7 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;li&gt;&lt;a href=</code><code class="php string">"#"</code><code class="php plain">&gt;Export&lt;/a&gt;&lt;/li&gt;</code>
														</div>
														<div class="line number9 index8 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;/ul&gt;</code>
														</div>
														<div class="line number10 index9 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;/div&gt;</code>
														</div>
														<div class="line number11 index10 alt2"></div>
														<div class="line number12 index11 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;div </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"col-sm-9"</code><code class="php plain">&gt;</code>
														</div>
														<div class="line number13 index12 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;h1 </code><code class="php keyword">class</code><code class="php plain">=</code><code class="php string">"page-header"</code><code class="php plain">&gt;Dashboard&lt;/h1&gt;</code>
														</div>
														<div class="line number14 index13 alt1"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class="php plain">&lt;/div&gt;</code>
														</div>
														<div class="line number15 index14 alt2"><code class="php plain">&lt;/section&gt;</code>
														</div>
														<div class="line number16 index15 alt1"></div>
														<div class="line number17 index16 alt2"><code class="php spaces">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>-->
									</div>
								</div>
								<!--<p>I have tried adding a margin to the left of the main content to push it over but it looks horrible when resized to smaller device.</p>
							<p>What is the correct way to achieve a fixed sidebar whilst still maintaining responsiveness?</p>
							-->
								<div class="loader_2"></div>
								<div class="no_vote_more"></div>
							</div>
							<!-- <div class="question-tags"><a href="<?= base_url() ?>/wp/knowledge/question-tag/php/">php</a>  
						<a href="<?= base_url() ?>/wp/knowledge/question-tag/wordpress/">wordpress</a> -->
						</div>
						<div class="clearfix"></div>
			
			</article>
		<?php } ?>

		<div id="comments"></div>
		<div id="commentlist" class="page-content ">
			<div class="thread-reply">
				<h2>Thread Reply</h2>
			</div>
			<ol class="commentlist clearfix">
				<?php foreach ($reply as $row) { ?>
					<li class="comment byuser comment-author-umar even thread-even depth-1 comment " id="li-comment-10">
						<div id="comment-10" class="comment-body clearfix" rel="post-279">
							<div class="avatar-img">

								<?php $cond = array('id' => $row['user_id']);
								$tbl = "signup";
								$signup = $this->HomeModel->select_cond_data($tbl, $cond); ?>
								<img alt="<?= $signup[0]['name'] ?>" src="<?= base_url('myassets/image/logo.png') ?>" data-lazy-src="<?= base_url('myassets/image/logo.png') ?>" class="lazyloaded" data-was-processed="true">

							</div>
							<div class="comment-text">
								<div class="author clearfix">
									<div class="comment-author">
										<?php


										$cond = array(
											'id' => $row['user_id']
										);

										$tbl = "signup";
										$user_details = $this->HomeModel->select_cond_data($tbl, $cond);
										?>

										<div class="fnone"> <a href=""> <?= $user_details[0]['name'] ?> </a>

										</div>
										<div class="date fnone">Got <span class="fnone question-vote-result question_vote_result "><?= $row['vote'] ?></span> Votes</div>
									</div>
									<div class="comment-meta">
										<div class="date"><i class="icon-time"></i><?= $row['created_at'] ?></div>
									</div>
									<div class="comment-reply"> <a class="question_r_l comment_l report_c" href="#"><i class="icon-flag"></i>Report</a>
									</div>

								</div>
								<div class="text">
									<div class="infocenter-question-reporting">
										<h3>Please briefly explain why you feel this answer should be reported .</h3>
										<textarea name="infocenter-question-reporting"></textarea>
										<div class="clearfix"></div>
										<div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a>
									</div>
									<div class="timeline-content">

										<div>
											<?php if ($row['youtube'] != "") { ?>
												<a href="<?= $row['youtube'] ?>" target="_blanck"><img style=" margin: 5px; border-radius: 12px; border: 5px solid #cee0ed;" src="<?= base_url('myassets/image/play.jpg') ?>" alt="Snow"></a>
											<?php } ?>
										</div>
										<p>
											<?php if ($row['video'] != "") { ?>
												<video controls>
													<source src="<?= base_url() ?>/<?= $row['video'] ?>" type="video/mp4">
												</video>
											<?php } ?>
											<!--<a title="" href="#" rel="nofollow">John Doe</a> 
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. 
											Donec non est at libero vulputate rutrum.-->
										</p>
										<pre class="brush: php;">

											    <!--public function popular($parent = null,$child = null)
  {     
    $products =  Product::with('subcategory')-&gt;with('subchild')-&gt;paginate(16)-&gt;sortByDesc('view_cache');
    return view('Frontend.listing.popular')-&gt;with(['products'=&gt;$products]);
   }
   
   
   namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' =&gt; [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\UserEventListener',
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
																		 -->
																		  <?= $row['description'] ?>
																		 </pre>

										<p></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
								<div class="loader_3"></div>
								<div class="text">
									<div class="comment-vote">
										<ul class="single-question-vote">
											<li class="loader_3"></li>
											<li><span class="like<?= $row['id'] ?>"><?= $row['like_'] ?></span>
												<a href="#" class="single-question-vote-up comment_vote_up vote_not_user" onclick="mylike(<?= $row['id'] ?>, <?= $row['like_'] ?>)" title="Like">
													<i class="icon-thumbs-up"></i></a>
											</li>
											<li><span class="dislike<?= $row['id'] ?>"><?= $row['dislike'] ?></span>
												<a href="#" class="single-question-vote-down comment_vote_down vote_not_user" title="Dislike" onclick="mydislike(<?= $row['id'] ?>, <?= $row['dislike'] ?>)">
													<i class="icon-thumbs-down"></i></a>

											</li>
										</ul>
									</div>
								</div>
								<div class="no_vote_more"></div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ol>
		</div>
		<div class="pagination comments-pagination"></div>
		<div id="respond" class="comment-respond page-content clearfix ">
			<div class="boxedtitle page-title">
				<h2>Leave an answer</h2>
			</div>

			<?php
			if ($this->session->userdata('userdata') == '') {
			?>
				<a href="<?= base_url('Home/signin') ?>" style="background: black; color: white;  padding: 14px;">FOR REPLY - LOGIN</a>
			<?php
			} else {
				//redirect(base_url('home'));

			?>

				<form action="<?= base_url('home/questions/' . $id) ?>" method="post" id="commentform" enctype="multipart/form-data">
					<div class="ask_error"></div>
					<!--			<div id="respond-inputs" class="clearfix">
							<p>
								<label class="required" for="comment_name">Name<span>*</span>
								</label>
								<input name="author" type="text" value="" id="comment_name" aria-required="true">
							</p>
							<p>
								<label class="required" for="comment_email">E-Mail<span>*</span>
								</label>
								<input name="email" type="text" value="" id="comment_email" aria-required="true">
							</p>
							<p class="last">
								<label class="required" for="comment_url">Website</label>
								<input name="url" type="text" value="" id="comment_url">
							</p>
						</div>
						<div class="clearfix">
							<label for="attachment">Attachment</label>
							<div class="fileinputs">
								<input type="file" name="attachment" id="attachment">
								<div class="fakefile">
									<button type="button" class="small margin_0">Select file</button> <span><i class="icon-arrow-up"></i>Browse</span>
								</div>
							</div>
						</div>-->
					<div id="">
						<p>
							<label for="" class="required">Youtube Link</label>
							<input name="youtube" id="" class="the-title" type="text" value="" placeholder="https://www.youtube.com/">

						</p>
						<p class="form-allowed-tags">You may use these &lt;abbr title="HyperText Markup Language"&gt;HTML&lt;/abbr&gt; tags and attributes: <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code>
						</p>
					</div>

					<div id="respond-textarea">
						<p>
							<label class="required" for="comment">Comment<span>*</span>
							</label>
							<textarea required id="comment" name="description" aria-required="true" cols="58" rows="10"></textarea>
						</p>
						<p class="form-allowed-tags">You may use these &lt;abbr title="HyperText Markup Language"&gt;HTML&lt;/abbr&gt; tags and attributes: <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code>
						</p>
					</div>
					<div class="cancel-comment-reply"><a rel="nofollow" id="cancel-comment-reply-link" href="/wp/knowledge/questions/php-recursive-function-not-working-right/#respond" style="display:none;">Click here to cancel reply.</a>
					</div>
					<p class="form-submit">
						<input name="reply" type="submit" id="submit" value="Post your answer" class="button small color">
						<input type="hidden" name="comment_post_ID" value="279" id="comment_post_ID">
						<input type="hidden" name="comment_parent" id="comment_parent" value="0">
					</p>
				</form>
			<?php } ?>
		</div>
		<div class="post-next-prev clearfix">
			<p class="prev-post"> <a href="<?= base_url() ?>/wp/knowledge/questions/change-navbar-color-in-twitter-bootstrap-3/" rel="prev"><i class="icon-angle-left"></i>&nbsp;Previous question</a>
			</p>
			<p class="next-post"></p>
		</div>
		</div>
		<aside class="col-md-4 sidebar">
			<div id="questions-widget-2" class="widget questions-widget">
				<h3 class="widget_title">Hot Questions</h3>
				<ul class="related-posts">
					<li class="related-item">
						<div class="questions-div">
							<h3> <a href="<?= base_url() ?>/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/" title="Bootstrap fixed sidebar causes main content to overlap?" rel="bookmark"> <i class="icon-angle-right"></i> Bootstrap fixed sidebar causes main </a></h3>
						</div>
					</li>
					<li class="related-item">
						<div class="questions-div">
							<h3> <a href="<?= base_url() ?>/wp/knowledge/questions/choosing-bootstrap-vs-material-design/" title="Choosing bootstrap vs material design" rel="bookmark"> <i class="icon-angle-right"></i> Choosing bootstrap vs material design </a></h3>
						</div>
					</li>
					<li class="related-item">
						<div class="questions-div">
							<h3> <a href="<?= base_url() ?>/wp/knowledge/questions/php-login-system-not-working-correctly/" title="Php login system not working correctly" rel="bookmark"> <i class="icon-angle-right"></i> Php login system not working </a></h3>
						</div>
					</li>
					<li class="related-item">
						<div class="questions-div">
							<h3> <a href="<?= base_url() ?>/wp/knowledge/questions/php-recursive-function-not-working-right/" title="Php recursive function not working right" rel="bookmark"> <i class="icon-angle-right"></i> Php recursive function not working </a></h3>
						</div>
					</li>
					<li class="related-item">
						<div class="questions-div">
							<h3> <a href="<?= base_url() ?>/wp/knowledge/questions/how-to-automatically-generates-html-table-by-javascript/" title="How to automatically generates HTML table by JavaScript?" rel="bookmark"> <i class="icon-angle-right"></i> How to automatically generates HTML </a></h3>
						</div>
					</li>
				</ul>
			</div>
			<div id="questions_categories-widget-2" class="widget questions_categories-widget">
				<h3 class="widget_title">Questions Categories</h3>
				<ul>
					<li> <a href="<?= base_url() ?>/wp/knowledge/question-category/css/">CSS <span> ( <span>2 Questions</span> ) </span> </a>
					</li>
					<li> <a href="<?= base_url() ?>/wp/knowledge/question-category/html/">HTML <span> ( <span>3 Questions</span> ) </span> </a>
					</li>
					<li> <a href="<?= base_url() ?>/wp/knowledge/question-category/php/">PHP <span> ( <span>1 Questions</span> ) </span> </a>
					</li>
					<li> <a href="<?= base_url() ?>/wp/knowledge/question-category/wordpress/">WordPress <span> ( <span>1 Questions</span> ) </span> </a>
					</li>
				</ul>
			</div>
			<div class="advertising">
				<a href="javascript:void(0)">
					<img alt="" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/your-ad-here.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/your-ad-here.jpg" class="error" data-was-processed="true">
					<noscript>
						<img alt="" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/your-ad-here.jpg">
					</noscript>
				</a>
			</div>
			<div class="clearfix"></div>
			<div id="comments-post-widget-2" class="widget comments-post-widget">
				<h3 class="widget_title">Comments</h3>
				<div class="widget_highest_points widget_comments">
					<ul>
						<li>
							<div class="author-img">
								<a href="<?= base_url() ?>/wp/knowledge/author/umar/">
									<img alt="Umar Amin" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg" class="lazyloaded" data-was-processed="true">
									<noscript>
										<img alt='Umar Amin' src='<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg'>
									</noscript>
								</a>
							</div>
							<h6><a href="<?= base_url() ?>/wp/knowledge/questions/how-to-automatically-generates-html-table-by-javascript/#comment-11">Umar Amin : Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></h6>
						</li>
						<li>
							<div class="author-img">
								<a href="<?= base_url() ?>/wp/knowledge/author/umar/">
									<img alt="Umar Amin" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg" class="lazyloaded" data-was-processed="true">
									<noscript>
										<img alt='Umar Amin' src='<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg'>
									</noscript>
								</a>
							</div>
							<h6><a href="<?= base_url() ?>/wp/knowledge/questions/php-recursive-function-not-working-right/#comment-10">Umar Amin : Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></h6>
						</li>
						<li>
							<div class="author-img">
								<a href="<?= base_url() ?>/wp/knowledge/author/randy/">
									<img alt="Randy Axy" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/randy-image-1-65x65.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/randy-image-1-65x65.jpg" class="lazyloaded" data-was-processed="true">
									<noscript>
										<img alt='Randy Axy' src='<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/randy-image-1-65x65.jpg'>
									</noscript>
								</a>
							</div>
							<h6><a href="<?= base_url() ?>/wp/knowledge/questions/php-login-system-not-working-correctly/#comment-9">Randy Axy : Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></h6>
						</li>
						<li>
							<div class="author-img">
								<a href="<?= base_url() ?>/wp/knowledge/author/emily/">
									<img alt="Emily Cooper" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/emily-image-2-65x65.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/emily-image-2-65x65.jpg" class="lazyloaded" data-was-processed="true">
									<noscript>
										<img alt='Emily Cooper' src='<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/emily-image-2-65x65.jpg'>
									</noscript>
								</a>
							</div>
							<h6><a href="<?= base_url() ?>/wp/knowledge/questions/php-login-system-not-working-correctly/#comment-8">Emily Cooper : Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></h6>
						</li>
						<li>
							<div class="author-img">
								<a href="<?= base_url() ?>/wp/knowledge/author/jasica/">
									<img alt="Jasica" src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/jasica-image-1-65x65.jpg" data-lazy-src="<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/jasica-image-1-65x65.jpg" class="lazyloaded" data-was-processed="true">
									<noscript>
										<img alt='Jasica' src='<?= base_url() ?>/wp/knowledge/wp-content/uploads/2017/02/jasica-image-1-65x65.jpg'>
									</noscript>
								</a>
							</div>
							<h6><a href="<?= base_url() ?>/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/#comment-7">Jasica : I am trying to use file_get_contents However that gives me e</a></h6>
						</li>
					</ul>
				</div>
			</div>
			<div id="tag_cloud-2" class="widget widget_tag_cloud">
				<h3 class="widget_title">Tag Cloud</h3>
				<div class="tagcloud"><a href="<?= base_url() ?>/wp/knowledge/question-tag/bootstrap/" class="tag-cloud-link tag-link-5 tag-link-position-1" style="font-size: 22pt;" aria-label="bootstrap (3 items)">bootstrap</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/css/" class="tag-cloud-link tag-link-4 tag-link-position-2" style="font-size: 16.4pt;" aria-label="css (2 items)">css</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/design/" class="tag-cloud-link tag-link-40 tag-link-position-3" style="font-size: 8pt;" aria-label="design (1 item)">design</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/html/" class="tag-cloud-link tag-link-3 tag-link-position-4" style="font-size: 16.4pt;" aria-label="html (2 items)">html</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/jquery/" class="tag-cloud-link tag-link-39 tag-link-position-5" style="font-size: 8pt;" aria-label="jquery (1 item)">jquery</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/login/" class="tag-cloud-link tag-link-38 tag-link-position-6" style="font-size: 8pt;" aria-label="login (1 item)">login</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/material/" class="tag-cloud-link tag-link-15 tag-link-position-7" style="font-size: 8pt;" aria-label="material (1 item)">material</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/php/" class="tag-cloud-link tag-link-37 tag-link-position-8" style="font-size: 16.4pt;" aria-label="php (2 items)">php</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/rss-reader/" class="tag-cloud-link tag-link-6 tag-link-position-9" style="font-size: 8pt;" aria-label="rss-reader (1 item)">rss-reader</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/web/" class="tag-cloud-link tag-link-7 tag-link-position-10" style="font-size: 8pt;" aria-label="web (1 item)">web</a> <a href="<?= base_url() ?>/wp/knowledge/question-tag/wordpress/" class="tag-cloud-link tag-link-41 tag-link-position-11" style="font-size: 8pt;" aria-label="wordpress (1 item)">wordpress</a>
				</div>
			</div>
		</aside>
		<div class="clearfix"></div>
	</div>
</div>
</div>

<script>
	function mylike(id, countlike) {
		jQuery.ajax({
			url: "<?= base_url('home/like') ?>",
			type: "POST",
			data: {
				id: id
			},
			dataType: "html",
			cache: false,
			success: function(html) {
				var obj = JSON.parse(html);
				jQuery(".like" + id).html('<span>' + obj.a + '<span>');
				jQuery(".dislike" + id).html('<span>' + obj.b + '<span>');
			}
		});
	}

	function mydislike(id, countlike) {
		jQuery.ajax({
			url: "<?= base_url('home/dislike') ?>",
			type: "POST",
			data: {
				id: id
			},
			dataType: "html",
			cache: false,
			success: function(html) {
				var obj = JSON.parse(html);
				jQuery(".like" + id).html('<span>' + obj.a + '<span>');
				jQuery(".dislike" + id).html('<span>' + obj.b + '<span>');
			}
		});
	}
</script>