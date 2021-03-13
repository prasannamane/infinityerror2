
<div class="tab-inner-warp" style="display: block;">
						<div class="tab-inner">
							<?php foreach ($quetions as $raw) { ?>
								<article class="question question-type-normal question_author_yes post-279 type-question status-publish hentry question-category-wordpress question_tags-php question_tags-wordpress" id="post-279" itemscope="" itemtype="http://schema.org/Article">
									<h2 itemprop="name">
										<a itemprop="url" href="<?= base_url('home/questions/') ?><?= $raw['id'] ?>" title="Php recursive function not working right" rel="bookmark">
											<div class="container">
												<div class=""><?= $raw['title'] ?></div>

												<div>
													<?php if ($raw['youtube'] != "") { ?>
														<a href="<?= $raw['youtube'] ?>" target="_blanck"><img style=" margin: 5px; border-radius: 12px; border: 5px solid #cee0ed;" src="<?= base_url('myassets/image/play.jpg') ?>" alt="Snow"></a>
													<?php } ?>
												</div>

												<?php if ($raw['video'] != '') { ?>
													<img style=" margin: 5px; border-radius: 12px; border: 5px solid #cee0ed;" src="<?= base_url('myassets/image/play.jpg') ?>" alt="Snow">
												<?php } ?>
											</div>
										</a>
									</h2>
									<span class="question-type-main question-statistic tooltip-s" data-original-title="Answers">
										<a href="#">1 </a>
									</span>

									<span class="question-report question-statistic tooltip-s" data-original-title="Votes">
										<span class="single-question-vote-result question_vote_result">0</span>
									</span>

									<div class="question-author">
										<a href="<?= base_url() ?>/wp/knowledge/author/emily/" data-original-title="<?= $raw['name'] ?>" class="question-author-img tooltip-n">

											<img alt="<?= $raw['name'] ?>" src="<?= base_url('myassets/image/emily-image-2-83x83.jpg') ?>" data-lazy-src="<?= base_url('myassets/image/emily-image-2-83x83.jpg') ?>" class="lazyloaded" data-was-processed="true"><noscript>
												<img alt='<?= $raw['name'] ?>' src='<?= base_url('myassets/image/emily-image-2-83x83.jpg') ?>'></noscript>
										</a>
										<span class="tick2"> <i class="fa fa-check" aria-hidden="true"></i> </span>


									</div>

									<div class="question-inner">
										<div class="q-meta">
											<span class="question-date" itemprop="datePublished">
												<i class="icon-time"></i><?= $raw['created_at'] ?></span>
											<span class="question-view">
												<i class="icon-eye-open"></i><?= $raw['view'] ?></span>
										</div>


										<div class="clearfix"></div>
										<div class="question-desc"><?= $raw['description'] ?>
											<div class="infocenter-question-reporting">
												<h3>Please explain why do you think this question should be reported?</h3>
												<textarea name="infocenter-question-reporting"></textarea>
												<div class="clearfix"></div>
												<div class="loader_3"></div>
												<a class="color button small report">Report</a>
												<a class="color button small dark_button cancel">Cancel</a>
											</div>
										</div>
										<!--<div class="question-tags"><a href="<?= base_url() ?>/wp/knowledge/question-tag/php/">php</a>
											<a href="<?= base_url() ?>/wp/knowledge/question-tag/wordpress/">wordpress</a>
										</div>-->
										<meta itemprop="interactionCount" content="UserAnswers: 1">
										<div class="clearfix"></div>
									</div>
								</article>

							<?php } ?>

							<style>
								.pagination strong {
									margin: 5px 5px 0 0;
									padding: 5px 11px;
									background-color: #c03f1d;
									float: left;
									-moz-border-radius: 2px;
									-webkit-border-radius: 2px;
									border-radius: 2px;

								}
							</style>
							<div class="textcenter">
								<div class="pagination">
									<p><?= $links ?></p>
								</div>
							</div>
						</div>
					</div>