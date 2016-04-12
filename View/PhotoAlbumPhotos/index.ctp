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

<?php echo $this->element('PhotoAlbums.value_provider_js'); ?>

<h2><?php echo $album['PhotoAlbum']['name']; ?></h2>
<p>
<?php echo $album['PhotoAlbum']['description']; ?>
</p>

<div class="text-right" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<?php if (Current::permission('photo_albums_photo_creatable')): ?>
		<?php
			echo $this->Button->addLink(
				'',
				'#',
				array(
					'ng-click' => 'PhotoController.openAdd(\'' .
						$this->NetCommonsHtml->url(
							array(
								'plugin' => 'photo_albums',
								'controller' => 'photo_album_photos',
								'action' => 'add',
								$album['PhotoAlbum']['key'],
							)
						) .
					'\')'
				)
			);
		?>
	<?php endif; ?>
</div>

<div style="margin: 10px 0px;">
	<div class="pull-left form-group questionnaire-list-select">
		<span class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				全て表示
				<span class="caret">
				</span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="/questionnaires/questionnaires/index/12/answer_status:viewall?frame_id=11">未承認のみ</a>
				</li>
				<li>
					<a href="/questionnaires/questionnaires/index/12/answer_status:unanswered?frame_id=11">差し戻しのみ</a>
				</li>
				<li>
					<a href="/questionnaires/questionnaires/index/12/answer_status:answered?frame_id=11">一時保存のみ</a>
				</li>
			</ul>
		</span>
	</div>

	<div class="text-right">
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
</div>

<hr>

<div class="row" ng-controller="PhotoAlbumsPhotoController as PhotoController">
	<?php foreach ($photos as $index => $photo) : ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<a href="/photo_albums/photo_album_photos/slide?frame_id=37">
					<?php
						echo $this->Html->image(
							array(
								'controller' => 'photo_album_photos',
								'action' => 'photo',
								Current::read('Block.id'),
								$photo['PhotoAlbumPhoto']['album_key'],
								$photo['PhotoAlbumPhoto']['id']
							),
							array(
								'alt' => __d('photo_albums', 'photo')
							)
						);
					?>
				</a>
				<div class="caption" style="overflow: hidden;height: 4em;">
					<?php echo nl2br($photo['PhotoAlbumPhoto']['description']) ?>
				</div>

				<?php echo $this->PhotoAlbums->photoActionBar($photo); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php echo $this->PhotoAlbums->approveAllButton($photos); ?>

<hr>
<?php echo $this->element('NetCommons.paginator'); ?>
<hr>

<footer>
	<div class="row">
		<div class="col-xs-12 text-center">
			<?php echo $this->BackTo->pageLinkButton(__d("videos", "アルバム一覧へ戻る"), array('icon' => '')); ?>
		</div>
	</div>
</footer>