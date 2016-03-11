<?php
/**
 * Blocks view for editor template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Allcreator <info@allcreator.net>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsComponent::MAIN_TAB_BLOCK_INDEX); ?>

	<div class="tab-content">
		<div class="pull-right">
			<?php echo $this->element('PhotoAlbums.PhotoAlbums/add_button'); ?>
		</div>

		<div class="text-left">
			<?php echo __d('net_commons', 'Not found.'); ?>
		</div>
	</div>
</article>