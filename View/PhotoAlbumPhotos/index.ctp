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

<h2>アルバムのタイトル</h2>

<div class="text-right">
	<?php echo $this->Button->addLink(); ?>
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

<div class="row">
	<?php foreach ($photos as $index => $photo) : ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<a href="/photo_albums/photo_album_photos/slide?frame_id=37">
					<img src="<?php echo $photo['PhotoAlbumPhoto']['src'] ?>" alt="...">
				</a>
				<div class="caption">
					<h3>
						<a href="/photo_albums/photo_album_photos/view?frame_id=37">
							<?php echo $photo['PhotoAlbumPhoto']['title'] ?>
						</a>
					</h3>
					<p>
						<?php if ($photo['PhotoAlbumPhoto']['status'] == 1): ?>
							<span class="label" style="display: inline;"></span>
						<?php else: ?>
							<?php echo $this->Workflow->label($photo['PhotoAlbumPhoto']['status']); ?>
						<?php endif; ?>

						<span class="pull-right">
							<?php if ($photo['PhotoAlbumPhoto']['status'] == 2 || $photo['PhotoAlbumPhoto']['status'] == 4): ?>
								<a href="" class="btn btn-warning">
									<span class="glyphicon glyphicon-ok"></span>
								</a>
							<?php endif; ?>

							<?php
								echo $this->Button->editLink(
									'',
									array(
										'plugin' => 'photo_albums',
										'controller' => '/photo_albums/photo_album_photos/index?frame_id=37',
										'action' => 'edit',
										'key' => ''
									)
								);
							?>
						</span>
					</p>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	<?php foreach ($photos as $index => $photo) : ?>
		<?php if ($index == 4) { break;} ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<a href="/photo_albums/photo_album_photos/slide?frame_id=37">
					<img src="<?php echo $photo['PhotoAlbumPhoto']['src'] ?>" alt="...">
				</a>
				<div class="caption">
					<h3>
						<a href="/photo_albums/photo_album_photos/view?frame_id=37">
							<?php echo $photo['PhotoAlbumPhoto']['title'] ?>
						</a>
					</h3>
					<p>
						<?php if ($photo['PhotoAlbumPhoto']['status'] == 1): ?>
							<span class="label" style="display: inline;"></span>
						<?php else: ?>
							<?php echo $this->Workflow->label($photo['PhotoAlbumPhoto']['status']); ?>
						<?php endif; ?>

						<span class="pull-right">
							<?php if ($photo['PhotoAlbumPhoto']['status'] == 2 || $photo['PhotoAlbumPhoto']['status'] == 4): ?>
								<a href="" class="btn btn-warning">
									<span class="glyphicon glyphicon-ok"></span>
								</a>
							<?php endif; ?>

							<?php
								echo $this->Button->editLink(
									'',
									array(
										'plugin' => 'photo_albums',
										'controller' => '/photo_albums/photo_album_photos/index?frame_id=37',
										'action' => 'edit',
										'key' => ''
									)
								);
							?>
						</span>
					</p>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<div class="text-right">
	<a href="" class="btn btn-warning">
		<span class="glyphicon glyphicon-ok"></span> 表示している写真をすべて承認する
	</a>
</div>
<hr>
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
<hr>
<footer>
	<div class="row">
		<div class="col-xs-12 text-center">
			<?php echo $this->BackTo->pageLinkButton(__d("videos", "アルバム一覧へ戻る"), array('icon' => '')); ?>
		</div>
	</div>
</footer>