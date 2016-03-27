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

<script>
	NetCommonsApp.value('photoAlbumsValues', {
		addUrl: '<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'add',
							Current::read('Block.id')
						)
					) . '/';
				?>',
		slideUrl: '<?php
					echo $this->Html->url(
						array(
							'controller' => 'photo_album_photos',
							'action' => 'slide',
							Current::read('Block.id')
						)
					). '/';
				?>'
	});
</script>

<table class="table table-hover" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<!--
	<thead>
	<tr>
		<th>
			<?php //echo $this->Paginator->sort('PhotoAlbum.title', __d('photoAlbums', 'Title')); ?>
			<?php echo $this->Paginator->sort('PhotoAlbum.status', 'アルバム'); ?>
		</th>
		<th>
			<?php //echo $this->Paginator->sort('PhotoAlbum.title', __d('photoAlbums', 'Title')); ?>
			<?php echo $this->Paginator->sort('PhotoAlbum.status', '写真数'); ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('PhotoAlbum.modified', __d('net_commons', 'Updated date')); ?>
		</th>

		<th>
		</th>
	</tr>
	</thead>
	 -->

	<tbody>
		<?php foreach ($albums as $album) : ?>
			<tr>
				<td>
					<!--
					<div class="media">
						<div class="media-left col-sm-2 col-md-3">
					 -->
						<div class="pull-left">
							<div class="thumbnail" style="width: 150px;height:150px;">
								<?php echo $this->PhotoAlbums->jacket($album); ?>
							</div>
						</div>

						<!-- <div class='media-body' style='padding:10px 30px;'> -->
						<div class="" style='margin:0 10px 10px 180px;'>
							<?php
								/*echo $this->NetCommonsHtml->link(
									$album['Block']['name'],
									$this->NetCommonsHtml->url(
										array(
											'plugin' => 'photo_albums',
											'controller' => 'photo_album_photos',
											'action' => 'slide'
										)
									)
								);*/
								echo '<h2 style="display: inline-block;margin:15px 10px; 0">' . $album['PhotoAlbum']['name'] . '</h2>';
								echo $this->Workflow->label($album['PhotoAlbum']['status']);
							?>
							<p style="margin:5px 0 0 20px; height: 50px;">
								<?php echo $album['PhotoAlbum']['description']; ?>
							</p>

							<div>
								<?php //echo sprintf('%s枚の写真があります。', $album['PhotoAlbum']['photo_count']); ?>
								<!--
								<button type="button" class="btn btn-default" ng-click="$modal.open({templateUrl: 'http://localhost:9090/trial/test/phpinfo.php'});">
								 -->
								<button type="button" class="btn btn-default" ng-click="PhotoController.slide('<?php echo $album['PhotoAlbum']['key']; ?>')">
									<span class="glyphicon glyphicon-play" aria-hidden="true"></span> スライドショー
								</button>
								<!--
								<a href="/photo_albums/photo_album_photos/slide?frame_id=37" class="btn btn-default">
									<span class="glyphicon glyphicon-play"></span> スライドショー
								</a>
								 -->
								<a href="<?php echo $this->NetCommonsHtml->url(array('controller' => 'photo_album_photos', 'action' => 'index', $album['PhotoAlbum']['key'])); ?>" class="btn btn-default">
									<span class="glyphicon glyphicon-th"></span> <?php echo __d('photoAlbums', 'Photo list'); ?>
								</a>
							</div>

						</div>
					</div>
				</td>

				<td style="padding:40px 20px 0 0;">
					<?php
						echo __d('photoAlbums', '%s photos', $album['PhotoAlbum']['photo_count']);
						if (Current::permission('content_publishable')) {
							echo '<br><span class="label label-warning">' .
									__d('photoAlbums', '%s waiting approval', $album['PhotoAlbum']['approval_waiting_photo_count']) .
									'</span>';
						}
						if (Current::permission('photo_albums_photo_creatable')) {
							echo '<br><span class="label label-warning">' .
									__d('photoAlbums', '%s denied', $album['PhotoAlbum']['disapproved_photo_count']) .
									'</span>';
						}
					?>
					<br>
					<br>
					<?php echo $this->DisplayUser->handleLink($album); ?>
					<br>
					<?php echo $this->Date->dateFormat($album['PhotoAlbum']['modified']); ?>
				</td>

				<td style="vertical-align:middle;">
					<?php
						if ($this->Workflow->canEdit('PhotoAlbum', $album)) {
							echo $this->Button->editLink(
								'',
								array(
									'plugin' => 'photo_albums',
									'controller' => 'photo_albums',
									'action' => 'edit',
									'key' =>  $album['PhotoAlbum']['key']
								),
								array(
									'tooltip' => __d('photoAlbums', 'Edit album')
								)
							);
						}

						if (Current::permission('photo_albums_photo_creatable')) {
							echo $this->Button->addLink(
								'',
								'#',
								array(
									'tooltip' => __d('photoAlbums', 'Add photo'),
									'ng-click' => 'PhotoController.add(\'' . $album['PhotoAlbum']['key'] . '\')'
								)
							);
						}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php echo $this->element('NetCommons.paginator'); ?>
