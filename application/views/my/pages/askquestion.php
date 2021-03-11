<div class="container main-content page-right-sidebar">
	<div class="row">
		<div class="with-sidebar-container">
			<div class="col-md-8">
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
			        <div class="boxedtitle page-title"><h2>Add Question</h2></div>
									<script type="text/javascript">
							jQuery(function () {
								var question_poll = jQuery("#question_poll-191:checked").length;
								if (question_poll == 1) {
									jQuery(".poll_options").slideDown(500);
								}else {
									jQuery(".poll_options").slideUp(500);
								}
								
								jQuery("#question_poll-191").click(function () {
									var question_poll_c = jQuery("#question_poll-191:checked").length;
									if (question_poll_c == 1) {
										jQuery(".poll_options").slideDown(500);
									}else {
										jQuery(".poll_options").slideUp(500);
									}
								});
							});
						</script>
						<div class="form-posts">
						    <div class="form-style form-style-3 question-submit">
				                <div class="ask_question">
					                <div>
						            <form class="infocenter-q-form" method="post" enctype="multipart/form-data" action="<?=base_url('home/askquestion')?>">
							            <div class="infocenter_error_display display"></div>
							            <div class="form-inputs clearfix">
							                <p>
									        <label for="question-title-191" class="required">Question Title<span>*</span></label>
									        <input required name="title" id="question-title-191" class="the-title" type="text" value="">
									        <span class="infocenter-qform-desc">Please type your question title here.</span>
								            </p>

											<p>
									        <label for="" class="required">Youtube Link</label>
									        <input required name="youtube" id="" class="the-title" type="text" value="" placeholder="https://www.youtube.com/">
									        
								            </p>
								           <!-- 
								            <p>
										    <label for="question_tags-191">Tags</label>
										    <input type="checkbox" id="" class="" name="tag[]" value="1">PHP


										    <span class="infocenter-qform-desc">Please input your Keywords here. Example : <span class="color">html , php</span> .</span>
									        </p>-->
											<!--										    <input type="text" class="input question_tags" name="question_tags" id="question_tags-191" value="" data-seperator="," style="display: none;"><ul class="taglist"><li class="input"><input type="text"><span style="display: none;"></span></li></ul>-->
									        
									       <!-- <p>
									            <label for="question-category-191" class="required">Category<span>*</span></label>
									            <span class="styled-select"><select name="category" id="question-category-191" class="postform">
	                                            <option value="-1">Select a Category</option>
	<option class="level-0" value="7">CSS</option>
	<option class="level-0" value="10">HTML</option>
	<option class="level-0" value="12">PHP</option>
	<option class="level-0" value="15">WordPress</option>
</select>
</span>
									<span class="infocenter-qform-desc">Please choose correct category for the question.</span>
								</p>-->
								
								
								
								<div id="respond-textarea">
							<p>
								<label class="required" for="comment">Description<span>*</span>
								</label>
								<textarea id="comment" name="description" aria-required="true" cols="58" rows="10" spellcheck="false"></textarea>
							</p>
							<p class="form-allowed-tags">You may use these &lt;abbr title="HyperText Markup Language"&gt;HTML&lt;/abbr&gt; tags and attributes: <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code>
							</p>
						</div>
								
							<!--	<p>
									            <label for="question-category-191" class="required">Description<span>*</span></label>
									            <span class="styled-select">
									                
									                <textarea name='description'></textarea>
									                
									                </span>

								</p>
							-->	
								<!--<p class="question_poll_p">
										<label for="question_poll-191">Poll</label>
										<input type="checkbox" id="question_poll-191" class="question_poll" value="1" name="question_poll">
										<span class="question_poll">This question is a poll ?</span>
										<span class="poll-description">If you want to create a poll click here .</span>
									</p>
								-->	
									<div class="clearfix"></div>
									<!--<div class="poll_options" style="display: none;">
										<p class="form-submit add_poll">
											<button type="button" class="button color small submit add_poll_button add_poll_button_js"><i class="icon-plus"></i>Add Field</button>
										</p>
										<ul class="question_poll_item question_polls_item ui-sortable"><li id="poll_li_1" class="ui-sortable-handle">
													<div class="poll-li">
														<p><input id="ask[1][title]" class="ask" name="ask[1][title]" value="" type="text"></p>
														<input id="ask[1][value]" name="ask[1][value]" value="" type="hidden">
														<input id="ask[1][id]" name="ask[1][id]" value="1" type="hidden">
														<div class="del-poll-li"><i class="icon-remove"></i></div>
														<div class="move-poll-li"><i class="icon-fullscreen"></i></div>
													</div>
												</li></ul>
										<script> var nextli = 2;</script>
										<div class="clearfix"></div>
									</div>-->
									
									<!--<label>Attachment</label> -->
									<!--<div class="question-multiple-upload">
										<div class="clearfix"></div>
										<p class="form-submit add_poll">
											<button type="button" class="button color small submit add_poll_button add_upload_button_js"><i class="icon-plus"></i>Add Field</button>
										</p>
										<ul class="question_poll_item question_upload_item ui-sortable"></ul>
										<script> var next_attachment = 1;</script>
										<div class="clearfix"></div>
									</div>-->
							</div>
							
						<!--	<p>
									            <label for="question-category-191" class="required">Description<span>*</span></label>
									            <span class="styled-select">
									                
									               <input type="file" class="" name="attachment" >
									                
									                </span>

								</p>-->
							
							<ul class="question_poll_item question_upload_item ui-sortable">
							    <li id="poll_li_1">
							        <div class="poll-li">
							            <div class="fileinputs" style="width: 100% !important;">
							                <!--
											<input type="file" class="file" name="attachment" >
							                <div class="fakefile" >
							                    <button type="button" class="button small margin_0">Select file</button>
							                    <span><i class="icon-arrow-up"></i>Browse</span>
							                </div>
											
							                <div class="del-poll-li">
							                    <i class="icon-remove"></i>
							                </div>-->
							                <div class="move-poll-li"><i class="icon-fullscreen"></i></div></div></div></li></ul>
<!--							<div>
								<label for="question-details-191" class="required">Details<span>*</span></label><div class="the-details the-textarea"><div id="wp-question-details-191-wrap" class="wp-core-ui wp-editor-wrap tmce-active"><link rel="stylesheet" id="editor-buttons-css" href="https://bedkihal.com/projects.com/infinityerror4/wp-includes/css/editor.min.css?ver=5.4.2" type="text/css" media="all">
<div id="wp-question-details-191-editor-tools" class="wp-editor-tools hide-if-no-js"><div id="wp-question-details-191-media-buttons" class="wp-media-buttons"><button type="button" id="insert-media-button" class="button insert-media add_media" data-editor="question-details-191"><span class="wp-media-buttons-icon"></span> Add Media</button></div>
<div class="wp-editor-tabs"><button type="button" id="question-details-191-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="question-details-191">Visual</button>
<button type="button" id="question-details-191-html" class="wp-switch-editor switch-html" data-wp-editor-id="question-details-191">Text</button>
</div>
</div>
<div id="wp-question-details-191-editor-container" class="wp-editor-container"><div id="qt_question-details-191_toolbar" class="quicktags-toolbar"><input type="button" id="qt_question-details-191_strong" class="ed_button button button-small" aria-label="Bold" value="b"><input type="button" id="qt_question-details-191_em" class="ed_button button button-small" aria-label="Italic" value="i"><input type="button" id="qt_question-details-191_link" class="ed_button button button-small" aria-label="Insert link" value="link"><input type="button" id="qt_question-details-191_block" class="ed_button button button-small" aria-label="Blockquote" value="b-quote"><input type="button" id="qt_question-details-191_del" class="ed_button button button-small" aria-label="Deleted text (strikethrough)" value="del"><input type="button" id="qt_question-details-191_ins" class="ed_button button button-small" aria-label="Inserted text" value="ins"><input type="button" id="qt_question-details-191_img" class="ed_button button button-small" aria-label="Insert image" value="img"><input type="button" id="qt_question-details-191_ul" class="ed_button button button-small" aria-label="Bulleted list" value="ul"><input type="button" id="qt_question-details-191_ol" class="ed_button button button-small" aria-label="Numbered list" value="ol"><input type="button" id="qt_question-details-191_li" class="ed_button button button-small" aria-label="List item" value="li"><input type="button" id="qt_question-details-191_code" class="ed_button button button-small" aria-label="Code" value="code"><input type="button" id="qt_question-details-191_more" class="ed_button button button-small" aria-label="Insert Read More tag" value="more"><input type="button" id="qt_question-details-191_close" class="ed_button button button-small" title="Close all open tags" value="close tags"></div><div id="mceu_24" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 100%;"><div id="mceu_24-body" class="mce-container-body mce-stack-layout"><div id="mceu_25" class="mce-top-part mce-container mce-stack-layout-item mce-first"><div id="mceu_25-body" class="mce-container-body"><div id="mceu_26" class="mce-toolbar-grp mce-container mce-panel mce-first mce-last" hidefocus="1" tabindex="-1" role="group"><div id="mceu_26-body" class="mce-container-body mce-stack-layout"><div id="mceu_27" class="mce-container mce-toolbar mce-stack-layout-item mce-first" role="toolbar"><div id="mceu_27-body" class="mce-container-body mce-flow-layout"><div id="mceu_28" class="mce-container mce-flow-layout-item mce-first mce-last mce-btn-group" role="group"><div id="mceu_28-body"><div id="mceu_0" class="mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox mce-first mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_0" role="button" aria-haspopup="true"><button id="mceu_0-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Paragraph</span> <i class="mce-caret"></i></button></div><div id="mceu_1" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Bold (Ctrl+B)"><button id="mceu_1-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bold"></i></button></div><div id="mceu_2" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Italic (Ctrl+I)"><button id="mceu_2-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-italic"></i></button></div><div id="mceu_3" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Bulleted list (Shift+Alt+U)"><button id="mceu_3-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bullist"></i></button></div><div id="mceu_4" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Numbered list (Shift+Alt+O)"><button id="mceu_4-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-numlist"></i></button></div><div id="mceu_5" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Blockquote (Shift+Alt+Q)"><button id="mceu_5-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-blockquote"></i></button></div><div id="mceu_6" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align left (Shift+Alt+L)"><button id="mceu_6-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignleft"></i></button></div><div id="mceu_7" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align center (Shift+Alt+C)"><button id="mceu_7-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-aligncenter"></i></button></div><div id="mceu_8" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align right (Shift+Alt+R)"><button id="mceu_8-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignright"></i></button></div><div id="mceu_9" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Insert/edit link (Ctrl+K)"><button id="mceu_9-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-link"></i></button></div><div id="mceu_10" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Insert Read More tag (Shift+Alt+T)"><button id="mceu_10-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-wp_more"></i></button></div><div id="mceu_11" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Fullscreen"><button id="mceu_11-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-fullscreen"></i></button></div><div id="mceu_12" class="mce-widget mce-btn mce-last" tabindex="-1" role="button" aria-label="Toolbar Toggle (Shift+Alt+Z)"><button id="mceu_12-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-wp_adv"></i></button></div></div></div></div></div><div id="mceu_29" class="mce-container mce-toolbar mce-stack-layout-item mce-last" role="toolbar" style="display: none;"><div id="mceu_29-body" class="mce-container-body mce-flow-layout"><div id="mceu_30" class="mce-container mce-flow-layout-item mce-first mce-last mce-btn-group" role="group"><div id="mceu_30-body"><div id="mceu_13" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Strikethrough (Shift+Alt+D)"><button id="mceu_13-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-strikethrough"></i></button></div><div id="mceu_14" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Horizontal line"><button id="mceu_14-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-hr"></i></button></div><div id="mceu_15" class="mce-widget mce-btn mce-splitbtn mce-colorbutton" role="button" tabindex="-1" aria-haspopup="true" aria-label="Text color"><button role="presentation" hidefocus="1" type="button" tabindex="-1"><i class="mce-ico mce-i-forecolor"></i><span id="mceu_15-preview" class="mce-preview"></span></button><button type="button" class="mce-open" hidefocus="1" tabindex="-1"> <i class="mce-caret"></i></button></div><div id="mceu_16" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Paste as text"><button id="mceu_16-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-pastetext"></i></button></div><div id="mceu_17" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Clear formatting"><button id="mceu_17-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-removeformat"></i></button></div><div id="mceu_18" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Special character"><button id="mceu_18-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-charmap"></i></button></div><div id="mceu_19" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Decrease indent"><button id="mceu_19-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-outdent"></i></button></div><div id="mceu_20" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Increase indent"><button id="mceu_20-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-indent"></i></button></div><div id="mceu_21" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Undo (Ctrl+Z)" aria-disabled="true"><button id="mceu_21-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-undo"></i></button></div><div id="mceu_22" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Redo (Ctrl+Y)" aria-disabled="true"><button id="mceu_22-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-redo"></i></button></div><div id="mceu_23" class="mce-widget mce-btn mce-last" tabindex="-1" role="button" aria-label="Keyboard Shortcuts (Shift+Alt+H)"><button id="mceu_23-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-wp_help"></i></button></div></div></div></div></div></div></div></div></div><div id="mceu_31" class="mce-edit-area mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;"><iframe id="question-details-191_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press Alt-Shift-H for help." style="width: 100%; height: 254px; display: block;"></iframe></div><div id="mceu_32" class="mce-statusbar mce-container mce-panel mce-stack-layout-item mce-last" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;"><div id="mceu_32-body" class="mce-container-body mce-flow-layout"><div id="mceu_33" class="mce-path mce-flow-layout-item mce-first"><div class="mce-path-item">&nbsp;</div></div><div id="mceu_34" class="mce-flow-layout-item mce-last mce-resizehandle"><i class="mce-ico mce-i-resize"></i></div></div></div></div></div><textarea class="wp-editor-area" rows="10" autocomplete="off" cols="40" name="comment" id="question-details-191" style="display: none;" aria-hidden="true"></textarea></div>
</div>

</div><p><span class="infocenter-qform-desc">Type your question description here.<br></span></p><div class="htmlallowing">
								You can use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code></div><p></p>
							</div>-->
							
							
							
							
					<!--		<div class="form-inputs clearfix">
									<p class="question_poll_p">
										<label for="video_description-191">Video description</label>
										<input type="checkbox" id="video_description-191" class="video_description_input" name="video_description" value="1">
										<span class="question_poll">Do you want to add a video to the description?</span>
									</p>-->
									
<!--									<div class="video_description" style="">
										<p>
											<label for="video_type-191">Video type</label>
											<span class="styled-select">
												<select id="video_type-191" name="video_type">
													<option value="youtube">Youtube</option>
													<option value="vimeo">Vimeo</option>
													<option value="daily">Dialymotion</option>
												</select>
											</span>
											<span class="infocenter-qform-desc">Choose video type .</span>
										</p>
										
										<p>
											<label for="video_id-191">Video ID</label>
											<input name="video_id" id="video_id-191" class="video_id" type="text" value="">
											<span class="infocenter-qform-desc">Put your video id here : http://www.youtube.com/watch?v=7TF00hJI78Y EX : '7TF00hJI78Y' .</span>
										</p>
									</div>
							<p class="question_poll_p">
								<label for="remember_answer-191">Notified</label>
								<input type="checkbox" id="remember_answer-191" name="remember_answer" value="1">
								<span class="question_poll">Notify by e-mail for incoming answers .</span>
							</p></div>
-->							
							<p class="form-submit">
								<input type="hidden" name="form_type" value="add_question">
								<input type="hidden" name="post_type" value="add_question">
								<input type="submit" name="askquestion" value="Publish Your Question" class="button color small submit add_qu publish-question">
							</p>
						
						</form>
					</div>
				</div>
			</div></div>		</div><!-- End page-content -->
									
				</div><!-- End main -->
									<aside class="col-md-4 sidebar sticky-sidebar" data-top-position="1262" style="">
						<div id="search-2" class="widget widget_search">		<form method="get" role="search" action="https://bedkihal.com/projects.com/infinityerror4/" id="searchform">
            <div class="form-group">
                <input id="s" type="text" placeholder="Search.." class="form-control" name="s">
                <button class="sea-icon" type="submit"><i class="icon-magnifying-glass"></i></button>
            </div>
		</form><!--This form's full css can be found under custom.css file's 'Sidebar Search CSS Start' text--></div>		<div id="recent-posts-2" class="widget widget_recent_entries">		<h3 class="widget_title">Recent Posts</h3>		<ul>
											<li>
					<a href="https://bedkihal.com/projects.com/infinityerror4/2020/08/08/hello-world/">Hello world!</a>
									</li>
											<li>
					<a href="https://bedkihal.com/projects.com/infinityerror4/2017/04/16/how-to-change-my-social-urls/">How to change my social URLs?</a>
									</li>
											<li>
					<a href="https://bedkihal.com/projects.com/infinityerror4/2017/04/16/where-can-i-put-my-custom-css/">Where can I put my Custom CSS?</a>
									</li>
											<li>
					<a href="https://bedkihal.com/projects.com/infinityerror4/2017/04/16/how-can-i-edit-my-site-html/">How can I edit my site HTML?</a>
									</li>
											<li>
					<a href="https://bedkihal.com/projects.com/infinityerror4/2017/03/30/visual-composer-how-to-update/">Visual Composer — How to update?</a>
									</li>
					</ul>
		</div><div id="recent-comments-2" class="widget widget_recent_comments"><h3 class="widget_title">Recent Comments</h3><ul id="recentcomments"><li class="recentcomments"><span class="comment-author-link"><a href="https://bedkihal.com/projects.com/infinityerror4" rel="external nofollow ugc" class="url">prasannamane7@gmail.com</a></span> on <a href="https://bedkihal.com/projects.com/infinityerror4/questions/must-i-use-java/#comment-23">Must I use Java</a></li><li class="recentcomments"><span class="comment-author-link"><a href="https://bedkihal.com/projects.com/infinityerror4" rel="external nofollow ugc" class="url">prasannamane7@gmail.com</a></span> on <a href="https://bedkihal.com/projects.com/infinityerror4/questions/beanfactorypostprocessor/#comment-22">BeanFactoryPostProcessor</a></li><li class="recentcomments"><span class="comment-author-link"><a href="https://bedkihal.com/projects.com/infinityerror4" rel="external nofollow ugc" class="url">prasannamane7@gmail.com</a></span> on <a href="https://bedkihal.com/projects.com/infinityerror4/questions/how-to-upload-a-video/#comment-21">How to Upload a video</a></li><li class="recentcomments"><span class="comment-author-link"><a href="https://bedkihal.com/projects.com/infinityerror4" rel="external nofollow ugc" class="url">prasannamane7@gmail.com</a></span> on <a href="https://bedkihal.com/projects.com/infinityerror4/questions/beanfactorypostprocessor/#comment-20">BeanFactoryPostProcessor</a></li><li class="recentcomments"><span class="comment-author-link"><a href="https://bedkihal.com/projects.com/infinityerror4" rel="external nofollow ugc" class="url">prasannamane7@gmail.com</a></span> on <a href="https://bedkihal.com/projects.com/infinityerror4/questions/beanfactorypostprocessor/#comment-19">BeanFactoryPostProcessor</a></li></ul></div>					</aside><!-- End sidebar -->
								<div class="clearfix"></div>
			</div><!-- End with-sidebar-container -->
		</div><!-- End row -->
	</div>