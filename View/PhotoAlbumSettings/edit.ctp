<?php
/**
 * BlockRolePermission edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_PERMISSION); ?>

	<div class="tab-content">
		<?php
			echo $this->element(
				'Blocks.edit_form',
				array(
					'model' => 'PhotoAlbumSetting',
					'callback' => 'PhotoAlbums.setting'
				)
			);
		?>
	</div>
</div>
