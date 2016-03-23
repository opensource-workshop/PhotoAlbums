<?php
/**
 * Album form template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.key'); ?>
<?php echo $this->NetCommonsForm->hidden('PhotoAlbum.language_id'); ?>

<div class = "row">
	<div class="col-md-4">
		<div class="thumbnail">
			<?php
				if (isset($this->request->data['UploadFile']['jacket']['id'])) {
					echo $this->Html->image(
						array(
							'action' => 'jacket',
							Current::read('Block.id'),
							$this->request->data['UploadFile']['jacket']['id']
						),
						array(
							'alt' => __d('PhotoAlbums', 'jacket')
						)
					);
					/* https://github.com/NetCommons3/NetCommons3/issues/161
					echo $this->NetCommonsHtml->image(
						array(
							'action' => 'jacket',
							$this->_View->request->data['UploadFile']['jacket']['id']
						),
						array(
							'alt' => __d('PhotoAlbums', 'jacket')
						)
					);
					*/
				} else {
					echo $this->Html->image(
						'PhotoAlbums.noimage.gif',
						array(
							'alt' => __d('PhotoAlbums', 'jacket')
						)
					);
				}
			?>
		</div>
		<?php
			echo $this->NetCommonsForm->uploadFile(
				PhotoAlbum::ATTACHMENT_FIELD_NAME,
				array(
					'label' => false
				)
			);
		?>
	</div>

	<div class="col-md-8">
		<?php
			echo $this->NetCommonsForm->input(
				'PhotoAlbum.name',
				array(
					'type' => 'text',
					'label' => __d('PhotoAlbums', 'Album Name'),
					'required' => true,
				)
			);
		?>
	</div>
</div>

<?php
	echo $this->NetCommonsForm->input(
		'PhotoAlbum.description',
		array(
			'type' => 'textarea',
			'label' => __d('PhotoAlbums', 'Description'),
		)
	);
?>
