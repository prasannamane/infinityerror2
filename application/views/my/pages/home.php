<style>


    .container2 
    {
        position: relative;
        text-align: center;
        color: white;
    }
    .centered 
    {
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
                    			<a href="<?=base_url('#')?>" data-js="recent_questions" class="current"> <i class="icofont icon-ribbon" aria-hidden="true"></i> <span>Recent Questions</span></a>
                    		</li>
                    		<li class="tab">
                    			<a href="<?=base_url('#')?>" data-js="most_responses"> <i class="icofont icon-layers" aria-hidden="true"></i> <span>Popular Questions</span></a>
                    		</li>
                    		<li class="tab">
                    			<a href="<?=base_url('#')?>" data-js="recently_answered"> <i class="icofont icon-global" aria-hidden="true"></i> <span>Recent Responses</span></a>
                    		</li>
                    		<li class="tab">
                    			<a href="<?=base_url('#')?>" data-js="no_answers"> <i class="icofont icon-linegraph" aria-hidden="true"></i> <span>Not Answered</span></a>
                    		</li>
                    	</ul>
                    </div>
                    
				    <div class="tab-inner-warp" style="display: block;">
				        <div class="tab-inner">
					        <?php foreach($quetions as $raw){ ?>
					        <article class="question question-type-normal question_author_yes post-279 type-question status-publish hentry question-category-wordpress question_tags-php question_tags-wordpress" id="post-279" itemscope="" itemtype="http://schema.org/Article">
					            <h2 itemprop="name">
					                <a itemprop="url" href="<?=base_url('home/questions/')?><?=$raw['id']?>" title="Php recursive function not working right" rel="bookmark">
					                <div class="container">
                                        <div class=""><?=$raw['title']?></div>
                                        <img style=" margin: 5px;
    border-radius: 12px;
    border: 5px solid #cee0ed;
" src="<?=base_url('myassets/image/play.jpg')?>" alt="Snow" >
                                        
                                    </div>
                                    </a>
					            </h2> 
					            <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers">
					               <a href="https://fluentthemes.com/wp/knowledge/questions/php-recursive-function-not-working-right/#comments">1 </a>
					            </span> 
					           
					            <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> 
					                <span class="single-question-vote-result question_vote_result">0</span> 
					            </span>
					           
					            <div class="question-author"> 
					                <a href="https://fluentthemes.com/wp/knowledge/author/emily/" data-original-title="<?=$raw['name']?>" class="question-author-img tooltip-n"> 
					                
					                <img alt="<?=$raw['name']?>" src="<?=base_url('myassets/image/emily-image-2-83x83.jpg')?>" data-lazy-src="<?=base_url('myassets/image/emily-image-2-83x83.jpg')?>" class="lazyloaded" data-was-processed="true"><noscript>
					                <img alt='<?=$raw['name']?>' src='<?=base_url('myassets/image/emily-image-2-83x83.jpg')?>'></noscript> 
					                </a>
					                <span class="tick2"> <i class="fa fa-check" aria-hidden="true"></i> </span>
					                
					                
					            </div>
					        
					            <div class="question-inner">
					                <div class="q-meta"> 
					                    <span class="question-date" itemprop="datePublished">
					                    <i class="icon-time"></i><?=$raw['created_at']?></span> 
					                    <span class="question-view">
					                    <i class="icon-eye-open"></i><?=$raw['view']?></span>
					                </div>
					                
					                    
					                <div class="clearfix"></div>
					                <div class="question-desc"><?=$raw['description']?>
					                    <div class="infocenter-question-reporting">
					                        <h3>Please explain why do you think this question should be reported?</h3>
					                        <textarea name="infocenter-question-reporting"></textarea>
					                        <div class="clearfix"></div>
					                        <div class="loader_3"></div> 
					                        <a class="color button small report">Report</a> 
					                        <a class="color button small dark_button cancel">Cancel</a></div>
					                </div>
					                <div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/php/">php</a> 
					                        <a href="https://fluentthemes.com/wp/knowledge/question-tag/wordpress/">wordpress</a>
				                    </div>
					                        <meta itemprop="interactionCount" content="UserAnswers: 1">
					                        <div class="clearfix"></div>
				                </div>
			                </article>
					                        
					                        <?php } ?>
					                        
					        
<div class="textcenter"><div class="pagination"><span class="page-numbers current">1</span> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/">2</a> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/3/">3</a> <a class="next page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/"><i class="icon-angle-right"></i></a></div></div></div> 
					        </div> 
					        
					        
					        
					        
					        
					        <div class="tab-inner-warp" style="display: none;"><div class="tab-inner">
					            <article class="question question-type-normal question_author_yes post-4 type-question status-publish hentry question-category-html question_tags-bootstrap question_tags-css question_tags-html" id="post-4" itemscope="" itemtype="http://schema.org/Article"><h2 itemprop="name"><a itemprop="url" href="https://fluentthemes.com/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/" title="Bootstrap fixed sidebar causes main content to overlap?" rel="bookmark">Bootstrap fixed sidebar causes main content to overlap?</a></h2> <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers"><a href="https://fluentthemes.com/wp/knowledge/questions/bootstrap-fixed-sidebar-causes-main-content-to-overlap/#comments">2 </a></span> <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> <span class="single-question-vote-result question_vote_result">1</span> </span><div class="question-author"> <a href="https://fluentthemes.com/wp/knowledge/author/reader87/" data-original-title="reader87" class="question-author-img tooltip-n"> <span></span> 
					        <img alt="reader87" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg"><noscript>
					        <img alt='reader87' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg'></noscript> </a> <span class="tick2"> <i class="fa fa-check" aria-hidden="true"></i> </span></div><div class="question-inner"><div class="q-meta"> <span class="question-date" itemprop="datePublished"><i class="icon-time"></i>4 years</span> <span class="question-view"><i class="icon-eye-open"></i>3085 views</span></div><div class="clearfix"></div><div class="question-desc"> I am a novice when it comes to Bootstrap and css in general. I would like a site with a fixed sidebar, fixed top nav and main content that scrolls. The navbar is fixed and works ok. The layout of the ...<div class="infocenter-question-reporting"><h3>Please explain why do you think this question should be reported?</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div></div><div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/bootstrap/">bootstrap</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/css/">css</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/html/">html</a></div><meta itemprop="interactionCount" content="UserAnswers: 2"><div class="clearfix"></div></div>
					        </article>
					        <article class="question question-type-normal question_author_yes post-277 type-question status-publish hentry question-category-php question_tags-login question_tags-php" id="post-277" itemscope="" itemtype="http://schema.org/Article"><h2 itemprop="name"><a itemprop="url" href="https://fluentthemes.com/wp/knowledge/questions/php-login-system-not-working-correctly/" title="Php login system not working correctly" rel="bookmark">Php login system not working correctly</a></h2> <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers"><a href="https://fluentthemes.com/wp/knowledge/questions/php-login-system-not-working-correctly/#comments">2 </a></span> <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> <span class="single-question-vote-result question_vote_result">1</span> </span><div class="question-author"> <a href="https://fluentthemes.com/wp/knowledge/author/umar/" data-original-title="Umar Amin" class="question-author-img tooltip-n"> <span></span> 
					        <img alt="Umar Amin" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-83x83.jpg"><noscript>
					        <img alt='Umar Amin' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-83x83.jpg'></noscript> </a> <span class="tick2"> <i class="fa fa-check" aria-hidden="true"></i> </span></div><div class="question-inner"><div class="q-meta"> <span class="question-date" itemprop="datePublished"><i class="icon-time"></i>3 years</span> <span class="question-view"><i class="icon-eye-open"></i>2624 views</span></div><div class="clearfix"></div><div class="question-desc"> I am a novice when it comes to Bootstrap and css in general. I would like a site with a fixed sidebar, fixed top nav and main content that scrolls. The navbar is fixed and works ok. The layout of the ...<div class="infocenter-question-reporting"><h3>Please explain why do you think this question should be reported?</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div></div><div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/login/">login</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/php/">php</a></div><meta itemprop="interactionCount" content="UserAnswers: 2"><div class="clearfix"></div></div></article><article class="question question-type-normal question_author_yes post-25 type-question status-publish hentry question-category-css question_tags-bootstrap question_tags-material" id="post-25" itemscope="" itemtype="http://schema.org/Article"><h2 itemprop="name"><a itemprop="url" href="https://fluentthemes.com/wp/knowledge/questions/choosing-bootstrap-vs-material-design/" title="Choosing bootstrap vs material design" rel="bookmark">Choosing bootstrap vs material design</a></h2> <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers"><a href="https://fluentthemes.com/wp/knowledge/questions/choosing-bootstrap-vs-material-design/#comments">2 </a></span> <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> <span class="single-question-vote-result question_vote_result">0</span> </span><div class="question-author"><div class="question-author-img"> <span></span> 
					        <img alt="" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%2083%2083&#39;%3E%3C/svg%3E" data-lazy-srcset="https://secure.gravatar.com/avatar/2081a9da3d0914881819f9034ee5127a?s=166&amp;d=mm&amp;r=g 2x" class="avatar avatar-83 photo" height="83" width="83" data-lazy-src="https://secure.gravatar.com/avatar/2081a9da3d0914881819f9034ee5127a?s=83&amp;d=mm&amp;r=g"><noscript>
					        <img alt='' src='https://secure.gravatar.com/avatar/2081a9da3d0914881819f9034ee5127a?s=83&#038;d=mm&#038;r=g' srcset='https://secure.gravatar.com/avatar/2081a9da3d0914881819f9034ee5127a?s=166&#038;d=mm&#038;r=g 2x' class='avatar avatar-83 photo' height='83' width='83' /></noscript></div></div><div class="question-inner"><div class="q-meta"> <span class="question-date" itemprop="datePublished"><i class="icon-time"></i>4 years</span> <span class="question-view"><i class="icon-eye-open"></i>2288 views</span></div><div class="clearfix"></div><div class="question-desc"> I am a novice when it comes to Bootstrap and css in general. I would like a site with a fixed sidebar, fixed top nav and main content that scrolls. The navbar is fixed and works ok. The layout of the ...<div class="infocenter-question-reporting"><h3>Please explain why do you think this question should be reported?</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div></div><div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/bootstrap/">bootstrap</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/material/">material</a></div><meta itemprop="interactionCount" content="UserAnswers: 2"><div class="clearfix"></div></div></article><div class="textcenter"><div class="pagination"><span class="page-numbers current">1</span> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/">2</a> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/3/">3</a> <a class="next page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/"><i class="icon-angle-right"></i></a></div></div></div></div><div class="tab-inner-warp" style="display: none;"><div class="tab-inner"><div id="commentlist" class="page-content"><ol class="commentlist clearfix"><li rel="posts-278" class="comment" id="comment-11"><div class="comment-body clearfix" rel="post-278"><div class="avatar-img"> 
					        <img alt="Umar Amin" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg"><noscript> 
					        <img alt='Umar Amin' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg'></noscript></div><div class="comment-text"><div class="author clearfix">  
					        <div class="comment-author"> <a href="https://fluentthemes.com/wp/knowledge/author/"> Umar Amin </a></div><div class="comment-vote"><ul class="single-question-vote"><li class="loader_3"></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-up comment_vote_up vote_not_user" title="Like"><i class="icon-thumbs-up"></i></a></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-down comment_vote_down vote_not_user" title="Dislike"><i class="icon-thumbs-down"></i></a></li></ul></div> <span class="question-vote-result question_vote_result ">0</span><div class="comment-meta"><div class="date"><i class="icon-time"></i>February 26, 2017 at 4:15 am</div></div><div class="comment-reply"> <a class="question_r_l comment_l report_c" href="https://fluentthemes.com/wp/knowledge/#"><i class="icon-flag"></i>Report</a></div></div><div class="text"><div class="infocenter-question-reporting"><h3>Please briefly explain why you feel this answer should be reported .</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div> <a href="https://fluentthemes.com/wp/knowledge/questions/how-to-automatically-generates-html-table-by-javascript/#comment-11">Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></div><div class="clearfix"></div><div class="loader_3"></div><div class="no_vote_more"></div></div></div></li><li rel="posts-279" class="comment" id="comment-10"><div class="comment-body clearfix" rel="post-279"><div class="avatar-img"> 
					        <img alt="Umar Amin" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg"><noscript> 
					        <img alt='Umar Amin' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/umar-image-1-65x65.jpg'></noscript></div><div class="comment-text"><div class="author clearfix"><div class="comment-author"> <a href="https://fluentthemes.com/wp/knowledge/author/"> Umar Amin </a></div><div class="comment-vote"><ul class="single-question-vote"><li class="loader_3"></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-up comment_vote_up vote_not_user" title="Like"><i class="icon-thumbs-up"></i></a></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-down comment_vote_down vote_not_user" title="Dislike"><i class="icon-thumbs-down"></i></a></li></ul></div> <span class="question-vote-result question_vote_result ">0</span><div class="comment-meta"><div class="date"><i class="icon-time"></i>February 26, 2017 at 4:15 am</div></div><div class="comment-reply"> <a class="question_r_l comment_l report_c" href="https://fluentthemes.com/wp/knowledge/#"><i class="icon-flag"></i>Report</a></div></div><div class="text"><div class="infocenter-question-reporting"><h3>Please briefly explain why you feel this answer should be reported .</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div> <a href="https://fluentthemes.com/wp/knowledge/questions/php-recursive-function-not-working-right/#comment-10">Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></div><div class="clearfix"></div><div class="loader_3"></div><div class="no_vote_more"></div></div></div></li><li rel="posts-277" class="comment" id="comment-9"><div class="comment-body clearfix" rel="post-277"><div class="avatar-img"> 
					        <img alt="Randy Axy" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/randy-image-1-65x65.jpg"><noscript> 
					        <img alt='Randy Axy' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/randy-image-1-65x65.jpg'></noscript></div><div class="comment-text"><div class="author clearfix"><div class="comment-author"> <a href="https://fluentthemes.com/wp/knowledge/author/"> Randy Axy </a></div><div class="comment-vote"><ul class="single-question-vote"><li class="loader_3"></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-up comment_vote_up vote_not_user" title="Like"><i class="icon-thumbs-up"></i></a></li><li><a href="https://fluentthemes.com/wp/knowledge/#" class="single-question-vote-down comment_vote_down vote_not_user" title="Dislike"><i class="icon-thumbs-down"></i></a></li></ul></div> <span class="question-vote-result question_vote_result ">0</span><div class="comment-meta"><div class="date"><i class="icon-time"></i>February 26, 2017 at 4:10 am</div></div><div class="comment-reply"> <a class="question_r_l comment_l report_c" href="https://fluentthemes.com/wp/knowledge/#"><i class="icon-flag"></i>Report</a></div></div><div class="text"><div class="infocenter-question-reporting"><h3>Please briefly explain why you feel this answer should be reported .</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div> <a href="https://fluentthemes.com/wp/knowledge/questions/php-login-system-not-working-correctly/#comment-9">Set it as the font John Doe Lorem ipsum dolor sit amet, cons</a></div><div class="clearfix"></div><div class="loader_3"></div><div class="no_vote_more"></div></div></div></li></ol></div><div class="textcenter"><div class="pagination"><span aria-current="page" class="page-numbers current">1</span> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/">2</a> <a class="page-numbers" href="https://fluentthemes.com/wp/knowledge/page/3/">3</a> <a class="next page-numbers" href="https://fluentthemes.com/wp/knowledge/page/2/"><i class="icon-angle-right"></i></a></div></div><div class="clearfix"></div></div></div><div class="tab-inner-warp" style="display: none;"><div class="tab-inner"><article class="question question-type-normal question_author_yes post-5 type-question status-publish hentry question-category-html question_tags-rss-reader question_tags-web" id="post-5" itemscope="" itemtype="http://schema.org/Article"><h2 itemprop="name"><a itemprop="url" href="https://fluentthemes.com/wp/knowledge/questions/how-to-retrieve-rss-from-multiple-website/" title="How to retrieve RSS from multiple website?" rel="bookmark">How to retrieve RSS from multiple website?</a></h2> <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers"><a href="https://fluentthemes.com/wp/knowledge/questions/how-to-retrieve-rss-from-multiple-website/#respond">0 </a></span> <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> <span class="single-question-vote-result question_vote_result">0</span> </span><div class="question-author"> <a href="https://fluentthemes.com/wp/knowledge/author/reader87/" data-original-title="reader87" class="question-author-img tooltip-n"> <span></span> 
					        <img alt="reader87" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg"><noscript>
					        <img alt='reader87' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg'></noscript> </a></div><div class="question-inner"><div class="q-meta"> <span class="question-date" itemprop="datePublished"><i class="icon-time"></i>4 years</span> <span class="question-view"><i class="icon-eye-open"></i>2364 views</span></div><div class="clearfix"></div><div class="question-desc"> I am a novice when it comes to Bootstrap and css in general. I would like a site with a fixed sidebar, fixed top nav and main content that scrolls. The navbar is fixed and works ok. The layout of the ...<div class="infocenter-question-reporting"><h3>Please explain why do you think this question should be reported?</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div></div><div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/rss-reader/">rss-reader</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/web/">web</a></div><meta itemprop="interactionCount" content="UserAnswers: 0"><div class="clearfix"></div></div></article><article class="question question-type-normal question_author_yes post-171 type-question status-publish hentry question-category-css question_tags-bootstrap question_tags-css" id="post-171" itemscope="" itemtype="http://schema.org/Article"><h2 itemprop="name"><a itemprop="url" href="https://fluentthemes.com/wp/knowledge/questions/change-navbar-color-in-twitter-bootstrap-3/" title="Change navbar color in Twitter Bootstrap 3" rel="bookmark">Change navbar color in Twitter Bootstrap 3</a></h2> <span class="question-type-main question-statistic tooltip-s" data-original-title="Answers"><a href="https://fluentthemes.com/wp/knowledge/questions/change-navbar-color-in-twitter-bootstrap-3/#respond">0 </a></span> <span class="question-report question-statistic tooltip-s" data-original-title="Votes"> <span class="single-question-vote-result question_vote_result">1</span> </span><div class="question-author"> <a href="https://fluentthemes.com/wp/knowledge/author/reader87/" data-original-title="reader87" class="question-author-img tooltip-n"> <span></span> 
					        <img alt="reader87" src="data:image/svg+xml,%3Csvg%20xmlns=&#39;http://www.w3.org/2000/svg&#39;%20viewBox=&#39;0%200%200%200&#39;%3E%3C/svg%3E" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg"><noscript> 
					        <img alt='reader87' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/04/fancy-header01-83x83.jpg'></noscript> </a></div><div class="question-inner"><div class="q-meta"> <span class="question-date" itemprop="datePublished"><i class="icon-time"></i>3 years</span> <span class="question-view"><i class="icon-eye-open"></i>2307 views</span></div><div class="clearfix"></div><div class="question-desc"> I am a novice when it comes to Bootstrap and css in general. I would like a site with a fixed sidebar, fixed top nav and main content that scrolls. The navbar is fixed and works ok. The layout of the ...<div class="infocenter-question-reporting"><h3>Please explain why do you think this question should be reported?</h3><textarea name="infocenter-question-reporting"></textarea><div class="clearfix"></div><div class="loader_3"></div> <a class="color button small report">Report</a> <a class="color button small dark_button cancel">Cancel</a></div></div><div class="question-tags"><a href="https://fluentthemes.com/wp/knowledge/question-tag/bootstrap/">bootstrap</a> <a href="https://fluentthemes.com/wp/knowledge/question-tag/css/">css</a></div><meta itemprop="interactionCount" content="UserAnswers: 0"><div class="clearfix"></div></div></article><div class="textcenter"><div class="pagination"></div></div></div></div></div><div class="post-content">
					            
					            <div class="parallex section-padding fun-facts-bg text-center" data-stellar-background-ratio="0.1" style="background: url(&quot;https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/facts-parallex.jpg&quot;) 50% -1558.8px / cover repeat scroll rgba(0, 0, 0, 0);">
					                <div class="container">
					                    <div class="row">
					                        <div class="col-xs-6 col-sm-3 col-md-3">
					                            <div class="statistic-percent" data-perc="126">
					                                <div class="facts-icons"> 
					                                <span class="icon-user"></span>
					                                
					                                </div>
					                                <div class="fact"> 
					                                <span class="percentfactor">126</span><p>Happy Clients</p>
					                                </div>
					                                </div>
					                        </div>
					                        <div class="col-xs-6 col-sm-3 col-md-3">
					                            <div class="statistic-percent" data-perc="226">
					                                <div class="facts-icons"> <span class="icon-trophy"></span>
					                                </div>
					                                <div class="fact"> <span class="percentfactor">226</span><p>Happy Clients</p>
					                                </div>
					                           </div>
					                       </div>
					                       <div class="col-xs-6 col-sm-3 col-md-3">
					                           <div class="statistic-percent" data-perc="336">
					                               <div class="facts-icons"> <span class="icon-megaphone"></span></div>
					                               <div class="fact"> <span class="percentfactor">336</span><p>Happy Clients</p></div>
					                           </div>
					                       </div>
					                       
					                       <div class="col-xs-6 col-sm-3 col-md-3"><div class="statistic-percent" data-perc="446"><div class="facts-icons"> <span class="icon-chat"></span></div><div class="fact"> <span class="percentfactor">446</span><p>Chat Available</p></div></div></div></div></div></div>
					                       
					                      <!-- <section id="blog" class="home-blog-parallex custom-padding">
					                           <div class="container">
					                               <div class="main-heading text-center col-md-8 col-md-offset-2">
					                                   <h2>Latest Articles</h2>
					                                   <div class="slices">
					                                       <span class="slice"></span>
					                                       <span class="slice"></span>
					                                       <span class="slice"></span></div>
					                                       <p>This is sample sub heading text of the blog section of home page template</p></div>
					                                       <div class="row">
					                                           <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					                                               <div class="blog-grid post-224 post type-post status-publish format-standard has-post-thumbnail hentry category-css category-php tag-css tag-knowledge" id="post-224">
					                                                   <div class="blog-image post-img">
					                                                       <img alt="How to prevent my website from being scrolled horizontally?" src="<?=base_url('myassets/image/11.jpg')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/11.jpg" class="lazyloaded" data-was-processed="true">
					                                                       <noscript>
					             <img alt='How to prevent my website from being scrolled horizontally?' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/11.jpg'></noscript></div><div class="blog-content"><h5><a href="https://fluentthemes.com/wp/knowledge/how-to-prevent-my-website-from-being-scrolled-horizontally/">How to prevent my website from being scrolled horizontally?</a></h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis erat sed lorem dictum ullamcorper. Sed vel elit sed nunc ...</p></div><div class="blog-footer"><ul class="like-comment"><li><a href="https://fluentthemes.com/wp/knowledge/how-to-prevent-my-website-from-being-scrolled-horizontally/#comments"><i class="icon-chat"></i>0</a></li></ul> <a href="https://fluentthemes.com/wp/knowledge/how-to-prevent-my-website-from-being-scrolled-horizontally/" class="more-btn pull-right"><i class="fa fa-long-arrow-right"></i> MORE</a></div></div></div><div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><div class="blog-grid post-229 post type-post status-publish format-standard has-post-thumbnail hentry category-css category-web-design tag-css tag-design" id="post-229"><div class="blog-image post-img">
					        <img alt="What’s the best way to implement a 2D interval search in C++?" src="<?=base_url('myassets/image/22.jpg')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/22.jpg" class="lazyloaded" data-was-processed="true"><noscript> 
					        <img alt='What&#8217;s the best way to implement a 2D interval search in C++?' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/22.jpg'></noscript></div><div class="blog-content"><h5><a href="https://fluentthemes.com/wp/knowledge/whats-the-best-way-to-implement-a-2d-interval-search-in-c/">What’s the best way to implement a 2D interval search in C++?</a></h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis erat sed lorem dictum ullamcorper. Sed vel elit sed nunc ...</p></div><div class="blog-footer"><ul class="like-comment"><li><a href="https://fluentthemes.com/wp/knowledge/whats-the-best-way-to-implement-a-2d-interval-search-in-c/#comments"><i class="icon-chat"></i>0</a></li></ul> <a href="https://fluentthemes.com/wp/knowledge/whats-the-best-way-to-implement-a-2d-interval-search-in-c/" class="more-btn pull-right"><i class="fa fa-long-arrow-right"></i> MORE</a></div></div></div><div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><div class="blog-grid post-235 post type-post status-publish format-standard has-post-thumbnail hentry category-design category-php tag-design tag-web" id="post-235"><div class="blog-image post-img"> 
					        <img alt="Access a list within an element of a Pandas DataFrame" src="<?=base_url('myassets/image/66.jpg')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/66.jpg" class="lazyloaded" data-was-processed="true"><noscript>
					            <img alt='Access a list within an element of a Pandas DataFrame' src='https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/02/66.jpg'></noscript></div><div class="blog-content"><h5><a href="https://fluentthemes.com/wp/knowledge/access-a-list-within-an-element-of-a-pandas-dataframe/">Access a list within an element of a Pandas DataFrame</a></h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis erat sed lorem dictum ullamcorper. Sed vel elit sed nunc ...</p></div><div class="blog-footer"><ul class="like-comment"><li><a href="https://fluentthemes.com/wp/knowledge/access-a-list-within-an-element-of-a-pandas-dataframe/#comments"><i class="icon-chat"></i>0</a></li></ul> <a href="https://fluentthemes.com/wp/knowledge/access-a-list-within-an-element-of-a-pandas-dataframe/" class="more-btn pull-right"><i class="fa fa-long-arrow-right"></i> MORE</a></div></div></div><div class="clearfix"></div><div class="text-center clearfix section-padding-40"> <a href="https://fluentthemes.com/wp/knowledge/blog-full-width/" class="btn btn-lg btn-primary">View All Blog Posts</a></div><div class="clearfix"></div></div></div> 
					            </section>
					            -->
					            
<!--					            <section data-stellar-background-ratio="0.1" class="testimonial-bg parallex" style="background: url(&quot;https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/testimonials-2.jpg&quot;) 50% 299.1px repeat fixed;"><div class="container"><div class="row"><div class="col-md-8 "><div id="owl-slider" class="happy-client owl-carousel owl-theme" style="opacity: 1; display: block;"><div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 3000px; left: 0px; display: block; transition: all 800ms ease 0s; transform: translate3d(-750px, 0px, 0px);"><div class="owl-item" style="width: 750px;"><div class="item"> <i class="fa fa-quote-left"> </i><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took.</p><div class="client-info-wrap clearfix">
					                
					                <div class="client-img"> 
					        <img class="img-circle lazyloaded" src="<?=base_url('myassets/image/client-img-two.jpg')?>" alt="image" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client-img-two.jpg" data-was-processed="true"><noscript> 
					        <img class="img-circle" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client-img-two.jpg" alt="image" /></noscript></div><div class="client-info"> <strong> Jasica Alba </strong> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i></div></div></div></div><div class="owl-item" style="width: 750px;"><div class="item"> <i class="fa fa-quote-left"> </i><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took.</p><div class="client-info-wrap clearfix"><div class="client-img">
					             <img class="img-circle lazyloaded" src="<?=base_url('myassets/image/client-img-one.jpg')?>" alt="image" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client-img-one.jpg" data-was-processed="true"><noscript> 
					             <img class="img-circle" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client-img-one.jpg" alt="image" /></noscript></div><div class="client-info"> <strong> Mohammad Yohana </strong> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i> <i class="fa fa-star"> </i></div></div></div></div></div></div><div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page"><span class=""></span></div><div class="owl-page active"><span class=""></span></div></div></div></div></div><div class="col-md-4 no-padding"><div class="success-stories"><div class="main-heading text-center"><h2>SUCCESS STORIES</h2><hr class="main"><p>Cras varius purus in tempus porttitor ut dapibus efficitur sagittis cras vitae lacus metus nunc vulputate facilisis nisi <br>eu lobortis erat consequat ut. Aliquam et justo ante. Nam a cursus velit</p></div></div></div><div class="clearfix"></div></div></div>
					             </section>-->
					             
<!--					             <div class="custom-client-padding home-blog-parallex" id="clients"><div class="container">
					                 <div class="row">
					                     <div class="col-md-2 col-sm-4 col-xs-6 client-block"><div class="client-item client-item-style-2"> 
					                 <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#"> 
					             <img alt="Clients logo" src="<?=base_url('myassets/image/client_5.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_5.png" class="lazyloaded" data-was-processed="true"><noscript>
					                 <img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_5.png"></noscript> </a>
					                 </div>
					                 </div>
					                 
					                 <div class="col-md-2 col-xs-6 col-sm-4 client-block"><div class="client-item client-item-style-2"> 
					                 <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#">
					                      <img alt="Clients logo" src="<?=base_url('myassets/image/client_6.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_6.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_6.png"></noscript> </a></div></div><div class="col-md-2 col-xs-6 col-sm-4 client-block"><div class="client-item client-item-style-2"> <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#"> 
					                      <img alt="Clients logo" src="<?=base_url('myassets/image/client_7.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_7.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_7.png"></noscript> </a></div></div><div class="col-md-2 col-xs-6 col-sm-4 client-block"><div class="client-item client-item-style-2"> <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#"> 
					                      <img alt="Clients logo" src="<?=base_url('myassets/image/client_8.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_8.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_8.png"></noscript> </a></div></div><div class="col-md-2 col-xs-6 col-sm-4 client-block"><div class="client-item client-item-style-2"> <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#"> 
					                      <img alt="Clients logo" src="<?=base_url('myassets/image/client_9.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_9.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_9.png"></noscript> </a></div></div><div class="col-md-2 col-xs-6 col-sm-4 client-block"><div class="client-item client-item-style-2"> <a title="Client Logo" href="https://fluentthemes.com/wp/knowledge/#"> 
					                      <img alt="Clients logo" src="<?=base_url('myassets/image/client_10.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_10.png" class="lazyloaded" data-was-processed="true"><noscript>
					                          <img alt="Clients logo" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/client_10.png"></noscript> 
					                          </a>
					                          </div>
					                          </div>
					                          </div>
					                          </div>
					                          </div>
					                          -->
					                          
<!--					                          <div class="parallex section-padding our-apps text-center" style="background: url(https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/our-apps.jpg) repeat fixed center top;">
					                              <div class="container">
					                                  <div class="main-heading text-center">
					                                      <h2>Download Our Apps</h2>
					                                      <hr class="main">
					                                      </div>
					                                      
					                                      <div class="row">
					                                          <div class="app-content">
					                                              <div class="col-md-4 col-sm-4"> 
					                                              <a href="https://fluentthemes.com/wp/knowledge/#" class="app-grid"> 
					                                              <span class="app-icon"> 
					                      <img alt="image" src="<?=base_url('myassets/image/mobile.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/mobile.png" class="lazyloaded" data-was-processed="true"><noscript>
					                          <img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/mobile.png"></noscript> </span>
					                          <div class="app-title"><h5>Available on the</h5><h3>iOS App Store</h3></div> </a></div>
					                          
					                          <div class="col-md-4 col-sm-4"> 
					                          <a href="https://fluentthemes.com/wp/knowledge/#" class="app-grid"> <span class="app-icon"> 
					                      <img alt="image" src="<?=base_url('myassets/image/play-store.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/play-store.png" class="lazyloaded" data-was-processed="true">
					                      <noscript>
					                          <img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/play-store.png"></noscript> </span>
					                          <div class="app-title"><h5>Available on the</h5><h3>Google Store</h3></div> </a>
					                          </div>
					                          
					                          <div class="col-md-4 col-sm-4"> <a href="https://fluentthemes.com/wp/knowledge/#" class="app-grid"> 
					                          <span class="app-icon"> 
					                      <img alt="image" src="<?=base_url('myassets/image/windows.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/windows.png" class="lazyloaded" data-was-processed="true">
					                      <noscript><img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/windows.png"></noscript> </span>
					                      
					                      <div class="app-title"><h5>Available on the</h5><h3>Windows Store</h3></div> </a>
					                      </div>
					                      </div></div></div>
					                      </div> -->
					                      
					                      <div id="social-media"><div class="block no-padding"><div class="row"><div class="col-md-12"><div class="social-bar"><ul><li class="social1"> <a title="social-url" href="https://www.facebook.com/"> 
					                      <img alt="image" src="<?=base_url('myassets/image/facebook.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/facebook.png" class="lazyloaded" data-was-processed="true"><noscript>
					                          <img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/facebook.png"></noscript> 
					                          
					                          <span>Join Us On<strong>Facebook</strong></span> </a>
					                      </li>
					                      
					                      <li class="social2"> <a title="social-url" href="https://twitter.com/"> 
					                      <img alt="image" src="<?=base_url('myassets/image/twitter.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/twitter.png" class="lazyloaded" data-was-processed="true"><noscript>
					                          <img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/twitter.png"></noscript> 
					                          <span>Join Us On<strong>TWIITER</strong></span> 
					                      </a></li>
					                      <li class="social3"> <a title="social-url" href="https://plus.google.com/"> 
					                      <img alt="image" src="<?=base_url('myassets/image/google-plus.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/google-plus.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/google-plus.png"></noscript> 
					                      <span>Join Us On<strong>GOOGLE PLUS</strong></span> </a></li><li class="social4"> <a title="social-url" href="https://www.linkedin.com/"> 
					                      <img alt="image" src="<?=base_url('myassets/image/linkedin.png')?>" data-lazy-src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/linkedin.png" class="lazyloaded" data-was-processed="true"><noscript><img alt="image" src="https://fluentthemes.com/wp/knowledge/wp-content/uploads/2017/01/linkedin.png"></noscript> <span>Join Us On<strong>LINKEDIN</strong></span> </a></li>
					</ul>
					</div>
				</div>
				</div>
				</div>
				</div>
					<div class="clearfix">
					</div>
				</div>
				</div>
					<aside class="col-md-4 sidebar sticky-sidebar" style=""></aside>
					<div class="clearfix">
					</div>
				</div>
				</div>
				</div>