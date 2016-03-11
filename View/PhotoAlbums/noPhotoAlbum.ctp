<?php
/**
 * photoAlbum page setting view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Allcreator <info@allcreator.net>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->element('PhotoAlbums.scripts'); ?>

<div ng-controller="PhotoAlbums">

	<article>

		<?php echo $this->element('PhotoAlbums.PhotoAlbums/add_button'); ?>

		<div class="pull-left">
			<?php echo $this->element('PhotoAlbums.PhotoAlbums/answer_status'); ?>
		</div>

		<div class="clearfix"></div>

		<p>
			<?php echo __d('photoAlbums', 'no photoAlbum'); ?>
		</p>

		<?php if (Current::permission('content_creatable')) : ?>
			<p>
				<?php echo __d('photoAlbums', 'Please create new photoAlbum by pressing the "+" button.'); ?>
			</p>
		<?php endif ?>

	</article>

</div>

