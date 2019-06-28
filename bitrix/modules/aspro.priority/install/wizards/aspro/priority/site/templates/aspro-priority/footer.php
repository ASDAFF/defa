					<?if(!$isIndex):?>
						<?CPriority::checkRestartBuffer();?>
					<?endif;?>
					<?IncludeTemplateLangFile(__FILE__);?>
					<?global $arTheme, $isIndex, $is404, $isCatalog, $isServices;?>
					<?if(!$isIndex && !$isCatalog && !$isProjects):?>
							<?if($is404):?>
								</div>
							<?else:?>
									<?if(!$isMenu):?>
										</div><?// class=col-md-12 col-sm-12 col-xs-12 content-md?>
									<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "LEFT" && !$isBlog):?>
										<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
										</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<?elseif($isMenu && ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT" || $isBlog)):?>
										<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
										</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
										<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
											<?CPriority::ShowPageType('left_block')?>
										</div>
									<?endif;?>					
								<?endif;?>					
								</div><?// class=row?>	
						<?if($APPLICATION->GetProperty("FULLWIDTH")!=='Y'):?>
							</div><?// class="maxwidth-theme?>				
						<?endif;?>
					<?elseif($isIndex):?>
						<?CPriority::ShowPageType('indexblocks');?>
					<?endif;?>
				</div><?// class=container?>
				<?CPriority::get_banners_position('FOOTER');?>
			</div><?// class=main?>			
		</div><?// class=body?>		
		<?CPriority::ShowPageType('footer', '', 'FOOTER_TYPE');?>
		<div class="bx_areas">
			<?CPriority::ShowPageType('bottom_counter');?>
		</div>
		<?CPriority::SetMeta();?>
		<?CPriority::ShowPageType('search_title_component');?>
		<?CPriority::ShowPageType('basket_component');?>
		<?CPriority::AjaxAuth();?>
	</body>
</html>