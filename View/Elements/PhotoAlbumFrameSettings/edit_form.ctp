<?php
/**
 * PhotoAlbum frame edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
 ?>

 <?php echo $this->NetCommonsForm->hidden('id'); ?>
<?php echo $this->NetCommonsForm->hidden('frame_key'); ?>
<?php echo $this->NetCommonsForm->hidden('Frame.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Block.id'); ?>

<?php
	echo $this->DisplayNumber->select(
		'PhotoAlbumFrameSetting.default_albums_per_page',
		array(
			//'label' => __d('PhotoAlbums', 'Show albums per page'),
			'label' => 'アルバム表示件数',
			//'style' => 'width:auto;'
		)
	);

	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.default_sort_key_value',
		array(
			'type' => 'select',
			'options' => array(
				'PhotoAlbums.created DESC' => __d('NetCommons', 'Newest'),
				'PhotoAlbums.created ASC' => __d('NetCommons', 'Oldest'),
				'Blocks.name ASC' => __d('NetCommons', 'Title')
			),
			//'label' => __d('PhotoAlbums', 'Show albums per page')
			'label' => 'アルバムの表示順',
			//'style' => 'width:auto;'
		)
	);
?>

<div style="margin:40px 0 60px 40px;">
<?php
	echo $this->DisplayNumber->select(
		'PhotoAlbumFrameSetting.default_albums_per_page',
		array(
			//'label' => __d('PhotoAlbums', 'Show albums per page'),
			'label' => '写真の表示件数',
			//'style' => 'width:auto;'
		)
	);

	echo $this->NetCommonsForm->input(
		'PhotoAlbumFrameSetting.default_sort_key_value',
		array(
			'type' => 'select',
			'options' => array(
					'PhotoAlbums.created DESC' => __d('NetCommons', 'Newest'),
					'PhotoAlbums.created ASC' => __d('NetCommons', 'Oldest'),
					'Blocks.name ASC' => __d('NetCommons', 'Title')
			),
			//'label' => __d('PhotoAlbums', 'Show albums per page')
			'label' => '写真の表示順',
			//'style' => 'width:auto;'
		)
	);
?>
</div>

<div class="form-group">
	<?php //echo $this->NetCommonsForm->label(__d('PhotoAlbums', 'Select display albums.')); ?>
	<?php echo $this->NetCommonsForm->label('表示したいアルバム'); ?>

	<div style="height:600px;overflow-y:scroll;border-top: 1px solid #ddd;">
		<table class="table table-hover">
			<thead>
			<tr>
				<th>
					<?php //echo $this->Paginator->sort('PhotoAlbum.status', __d('photoAlbums', 'Status')); ?>
					<?php echo $this->Paginator->sort('PhotoAlbum.status', '表示'); ?>
				</th>
				<!--
				<th>
					<?php //echo $this->Paginator->sort('PhotoAlbum.status', __d('photoAlbums', 'Status')); ?>
					<?php echo $this->Paginator->sort('PhotoAlbum.status', '状態'); ?>
				</th>
				 -->
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
			</tr>
			</thead>

			<tbody>
				<?php foreach ($albums as $album) : ?>
					<tr>
						<td>
							<?php
								echo $this->NetCommonsForm->input(
									'PhotoAlbumDisplayAlbum.album_key',
									array(
										'type' => 'checkbox',
										'label' => false,
										'style' => 'width:25px; margin-left:0'
									)
								);
							?>
						</td>

						<!--
						<td>
							<?php //echo $this->PhotoAlbumStatusLabel->statusLabelManagementWidget($photoAlbum);?>
							<?php echo __d('net_commons', 'Published'); ?>
						</td>
						 -->

						<td>
							<!--
							<div class="media">
								<div class="media-left col-sm-2 col-md-3">
							 -->
								<div class="pull-left col-sm-2 col-md-3">
									<div class="thumbnail">
										<?php
											echo $this->NetCommonsHtml->image(
												'PhotoAlbums.' . $album['PhotoAlbum']['jacket'],
												array(
													'alt' => $album['Block']['name'],
													'class' => 'img-responsive',
													'style' => 'height:80px;'
												)
											);
										?>
									</div>
								</div>

								<!-- <div class='media-body' style='padding:10px 30px;'> -->
								<div class="col-sm-2 col-md-3" style='margin:10px 30px;'>
									<?php echo $album['Block']['name']; ?>
									<div>
										<?php //echo sprintf('%s枚の写真があります。', $album['PhotoAlbum']['photo_count']); ?>
									</div>
								</div>
							</div>
						</td>

						<td>
							<?php echo $album['PhotoAlbum']['photo_count'] . '枚'; ?>
						</td>

						<td>
							<?php echo $this->Date->dateFormat($album['PhotoAlbum']['modified']); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>