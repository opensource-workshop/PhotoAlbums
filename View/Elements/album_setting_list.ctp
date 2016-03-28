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


<div style="height:600px;overflow-y:scroll;border-top: 1px solid #ddd;">
	<table class="table table-hover">

		<tbody>
			<?php foreach ($albums as $album) : ?>
				<tr>
					<td style="vertical-align:middle;">
						<?php
							echo $this->Form->input(
								'PhotoAlbumDisplayAlbum..album_key',
								array(
									'type' => 'checkbox',
									'value' =>$album['PhotoAlbum']['key'],
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
									'value' =>$album['PhotoAlbum']['key'],
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
					</td>

					<td>
						<div class="pull-left">
							<div class="thumbnail" style="width: 150px;height:150px;">
								<?php echo $this->PhotoAlbums->jacket($album); ?>
							</div>
						</div>

						<div class="" style='margin:0 10px 10px 180px;'>
							<?php
								echo '<h2 style="display: inline-block;margin:15px 10px; 0">' . $album['PhotoAlbum']['name'] . '</h2>';
								echo $this->Workflow->label($album['PhotoAlbum']['status']);
							?>
							<p style="margin: 0 0 5px 20px;height: 6em;overflow: hidden;">
								<?php echo $album['PhotoAlbum']['description']; ?>
							</p>
						</div>
					</td>

					<td style="padding:40px 20px 0 0;">
						<?php
							echo __d('photo_albums', '%s photos', $album['PhotoAlbum']['photo_count']);
							if (Current::permission('content_publishable')) {
								echo '<br><span class="label label-warning">' .
										__d('photo_albums', '%s waiting approval', $album['PhotoAlbum']['approval_waiting_photo_count']) .
										'</span>';
							}
							if (Current::permission('photo_albums_photo_creatable')) {
								echo '<br><span class="label label-warning">' .
										__d('photo_albums', '%s denied', $album['PhotoAlbum']['disapproved_photo_count']) .
										'</span>';
							}
						?>
						<br>
						<br>
						<?php echo $this->DisplayUser->handleLink($album); ?>
						<br>
						<?php echo $this->Date->dateFormat($album['PhotoAlbum']['modified']); ?>
					</td>

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php
// TODO 改ページ
//echo $this->element('NetCommons.paginator');
?>
