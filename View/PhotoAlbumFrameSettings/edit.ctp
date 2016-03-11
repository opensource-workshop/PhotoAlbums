<?php
/**
 * PhotoAlbumFrameSettings edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_FRAME_SETTING); ?>

	<div class="tab-content">
		<?php
			echo $this->element('Blocks.edit_form', array(
				'model' => 'PhotoAlbumFrameSetting',
				'callback' => 'PhotoAlbums.frame_setting'
			));
		?>
	</div>
</article>
