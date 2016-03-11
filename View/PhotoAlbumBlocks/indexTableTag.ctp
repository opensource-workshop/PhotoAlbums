<?php
/**
 * photoAlbum content list view template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_BLOCK_INDEX); ?>

	<div class="tab-content">
		<div class="pull-right">
			<?php echo $this->Button->addLink(); ?>
		</div>

		<table class="table table-hover">
			<thead>
			<tr>
				<th>
					<?php //echo $this->Paginator->sort('PhotoAlbum.status', __d('photoAlbums', 'Status')); ?>
					<?php echo $this->Paginator->sort('PhotoAlbum.status', '状態'); ?>
				</th>
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
							<?php //echo $this->PhotoAlbumStatusLabel->statusLabelManagementWidget($photoAlbum);?>
							<?php echo __d('net_commons', 'Published'); ?>
						</td>

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
									<?php
										echo $this->NetCommonsHtml->link(
											$album['Block']['name'],
											array(
												'plugin' => 'photo_albums',
												'controller' => 'photo_album_blocks',
												'action' => 'add'
											)
										);
									?>
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

		<?php echo $this->element('NetCommons.paginator'); ?>
	</div>
</article>