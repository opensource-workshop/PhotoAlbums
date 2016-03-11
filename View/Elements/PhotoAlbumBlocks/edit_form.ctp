<?php
/**
 * PhotoAlbum edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->element('Blocks.form_hidden'); ?>

<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.id'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.key'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.language_id'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.id'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbumSetting.faq_key'); ?>

<div class = "media" style="padding-bottom:50px;">
	<div class="media-left">
		<div class="thumbnail" style="width:150px">
			<?php
				// ↓画面イメージ用Dummy
				echo $this->NetCommonsHtml->image(
					'PhotoAlbums.athletic_meet.jpg',
					array(
						'alt' => '運動会',
						'class' => 'img-responsive'
					)
				);
				// ↑画面イメージ用Dummy
			?>
		</div>

		<?php
			// ↓画面イメージ用Dummy
			echo $this->NetCommonsForm->uploadFile(
				'sample',
				array(
					'label' => false
				)
			);
			// ↑画面イメージ用Dummy
		?>
	</div>

	<?php
		echo $this->NetCommonsForm->input('Block.name', array(
			'value' => '2015年度の運動会',
			'type' => 'text',
			//'label' => __d('PhotoAlbums', 'Album Name'),
			'label' => __d('PhotoAlbums', 'アルバム名'),
			'required' => true,
			'div' => array(
				'class' => 'media-body',
				'style' => 'padding:30px 0px;'
			)
		));
	?>
</div>

<?php
	echo $this->NetCommonsForm->input('PhotoAlbum.description', array(
		'value' => '',
		'type' => 'textarea',
		//'label' => __d('PhotoAlbums', 'Album Name'),
		'label' => __d('PhotoAlbums', 'アルバムの説明'),
	));
?>

<?php //echo $this->element('Blocks.public_type');
