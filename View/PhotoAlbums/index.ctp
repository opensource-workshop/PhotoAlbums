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

<?php echo $this->NetCommonsHtml->script('/photo_albums/js/photo_albums.js'); ?>

<article class="block-setting-body">
	<div class="tab-content">
		<div class="text-right">
			<?php echo $this->Button->addLink(); ?>
		</div>

		<div class="text-right" style="margin: 10px 0px;">
			<span class="btn-group text-left">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					新着順
					<span class="caret">
					</span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="">登録順</a>
					</li>
					<li>
						<a href="">タイトル順</a>
					</li>
				</ul>
			</span>
			<span class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					5件
					<span class="caret">
					</span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="">1件</a>
					</li>
					<li class="active">
						<a href="">5件</a>
					</li>
					<li>
						<a href="">10件</a>
					</li>
					<li>
						<a href="">20件</a>
					</li>
					<li>
						<a href="">50件</a>
					</li>
					<li>
						<a href="">100件</a>
					</li>
				</ul>
			</span>
		</div>



		<table class="table table-hover" ng-controller="PhotoAlbumsAlbumController as AlbumController">
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
										<?php
											echo $this->NetCommonsHtml->image(
												'PhotoAlbums.' . $album['PhotoAlbum']['jacket'],
												array(
													'alt' => $album['Block']['name'],
													'class' => 'img-responsive',
													'style' => 'width: 140px;height:140px;',
													'url' => $this->NetCommonsHtml->url(
														array(
															'plugin' => 'photo_albums',
															'controller' => 'photo_album_photos',
															'action' => 'slide'
														)
													)
												)
											);
										?>
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
										echo '<h2 style="display: inline-block;margin:15px 10px; 0">' . $album['Block']['name'] . '</h2>';
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
										<button type="button" class="btn btn-default" ng-click="AlbumController.slide(<?php echo $album['PhotoAlbum']['id']; ?>)">
											<span class="glyphicon glyphicon-play" aria-hidden="true"></span> スライドショー
										</button>
										<!--
										<a href="/photo_albums/photo_album_photos/slide?frame_id=37" class="btn btn-default">
											<span class="glyphicon glyphicon-play"></span> スライドショー
										</a>
										 -->
										<a href="/photo_albums/photo_album_photos/index?frame_id=37" class="btn btn-default">
											<span class="glyphicon glyphicon-th"></span> 写真一覧
										</a>
									</div>

								</div>
							</div>
						</td>

						<td style="padding:40px 20px 0 0;">
							<?php
								echo $album['PhotoAlbum']['photo_count'] . '枚の写真';
								if ($album['PhotoAlbum']['isEdit']) {
									echo '<br><span class="label label-warning">11枚未承認</span>';
									echo '<br><span class="label label-warning">3枚差し戻し</span>';
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
								if ($album['PhotoAlbum']['isEdit']) {
									echo $this->Button->editLink(
										'',
										array(
											'plugin' => 'photo_albums',
											'controller' => 'photo_albums',
											'action' => 'edit',
											'key' => ''
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
		<div class="text-center">
			<ul class="pagination">
				<li class="active">
					<a>1</a>
				</li>
				<li>
					<a href="/videos/videos/view/6/ceda84f7987a7da0788fa7dff55f3719/page:2?frame_id=9">2</a>
				</li>
				<li>
					<a href="/videos/videos/view/6/ceda84f7987a7da0788fa7dff55f3719/page:3?frame_id=9">3</a>
				</li>
				<li>
					<a href="/videos/videos/view/6/ceda84f7987a7da0788fa7dff55f3719/page:3?frame_id=9" rel="last">»</a>
				</li>
			</ul>
		</div>
	</div>
</article>
