<div class="accordion" fillSpace="sidebar"><!-- fillSpace="sidebar" -->
					<?php foreach ($list as $value) { ?>
						<div class="accordionHeader">
							<h2><span>Folder</span><?php echo $value['name']; ?></h2>
						</div> 
							<div class="accordionContent">
								<?php foreach ($value['childs'] as $va) { ?>
									<ul class="tree treeFolder">
										<li><a><?php echo $va['name'] ?></a>
											<ul>
												<?php foreach ($va['childs'] as $v) { ?>
													<li><a href="<?php $url = $v['methods'] . "/turnpage/" . $v['id'] ?><?php echo site_url($url) ?>" target="navTab"  rel="page<?php echo $v['id'] ?>"><?php echo $v['name'] ?></a></li>
												<?php } ?>
											</ul>
										</li>
									</ul>
								<?php } ?>
							</div>
						<?php } ?>
				</div> 