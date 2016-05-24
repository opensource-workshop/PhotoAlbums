<?php
/**
 * PhotoAlbum album list template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>


<div class="photo-albums-album-setting-list">
	<div class="row table table-hover">
		<?php foreach ($albums as $album) : ?>
			<div class="col-sm-6">
				<?php echo $this->PhotoAlbums->jacketByBackground($album); ?>

				<div class="carousel-caption photo-albums-caption">
					<?php
						echo $this->Form->input(
							'PhotoAlbumDisplayAlbum..album_key',
							array(
								'type' => 'checkbox',
								'value' => $album['PhotoAlbum']['key'],
								'checked' => in_array($album['PhotoAlbum']['key'], $displayAlbumKeys),
								'label' => false,
								'div' => false,
								'class' => false,
								'hiddenField' => false,
								//'ng-model' => 'FrameSettingController.checkModel[' . $index . ']',
								'ng-disabled' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS,
								'ng-hide' => 'FrameSettingController.displayType != ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS
							)
						);

						echo $this->Form->input(
							'PhotoAlbumDisplayAlbum..album_key',
							array(
								'type' => 'radio',
								'options' => array($album['PhotoAlbum']['key'] => null),
								'value' => $album['PhotoAlbum']['key'],
								'checked' => in_array($album['PhotoAlbum']['key'], $displayAlbumKeys),
								'label' => false,
								'div' => false,
								'class' => false,
								'hiddenField' => false,
								//'ng-model' => 'FrameSettingController.checkModel[' . $index . ']',
								'ng-disabled' => 'FrameSettingController.displayType == ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS,
								'ng-hide' => 'FrameSettingController.displayType == ' . PhotoAlbumFrameSetting::DISPLAY_TYPE_ALBUMS
							)
						);
					?>

					<?php echo $this->element('PhotoAlbums.album_caption', ['album' => $album]); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php
// ＴＯＤＯ 改ページ
//echo $this->element('NetCommons.paginator');
