<?php
/**
 * PhotoAlbums Helper class file.
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppHelper', 'View/Helper');

/**
 * PhotoAlbumsHelper
 *
 *
 */
class PhotoAlbumsHelper extends AppHelper {

/**
 * Other helpers
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'NetCommons.NetCommonsHtml',
		'NetCommons.NetCommonsForm',
		'NetCommons.LinkButton',
		'Workflow.Workflow',
	);

/**
 * Creates a formatted img element for jacket.
 *
 * @param array $data PhotoAlbum data with UploadFile
 * @return img tag
 */
	public function jacket($data) {
		if (isset($data['UploadFile']['jacket']['id'])) {
			$output = $this->Html->image(
				array(
					'plugin' => 'photo_albums',
					'controller' => 'photo_albums',
					'action' => 'jacket',
					Current::read('Block.id'),
					$data['PhotoAlbum']['id']
				),
				array(
					'alt' => __d('photo_albums', 'jacket')
				)
			);
			/* https://github.com/NetCommons3/NetCommons3/issues/161
			$output = $this->NetCommonsHtml->image(
				array(
					'action' => 'jacket',
					$this->_View->request->data['UploadFile']['jacket']['id']
				),
				array(
					'alt' => __d('photo_albums', 'jacket')
				)
			);
			*/
		} else {
			$output = $this->Html->image(
				'PhotoAlbums.noimage.gif',
				array(
					'alt' => __d('photo_albums', 'jacket')
				)
			);
		}

		return $output;
	}

/**
 * Creates a formatted form element for approve Glyphicon.
 *
 * @param string $modelName Model name
 * @param array $data  PhotoAlbumPhoto data
 * @return form tag with approve button
 */
	public function photoActionBar($data) {
		$output = '';

		if ($data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_PUBLISHED) {
			$output .= $this->Workflow->label($data['PhotoAlbumPhoto']['status']);
		}

		if (!Current::permission('content_publishable')) {
			return $this->Html->div('photo-albums-photo-action-bar', $output);
		}
		if ($data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_APPROVED &&
			$data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_DISAPPROVED
		) {
			return $this->Html->div('photo-albums-photo-action-bar', $output);
		}

		$output .= '<div class="pull-right text-right">';

		$output .= $this->NetCommonsForm->create(
			'PhotoAlbumPhoto',
			array(
				'plugin' => 'photo_albums',
				'controller' => 'photo_album_photos',
				'action' => 'edit',
				'class' => 'label'
			)
		);
		$output .= $this->NetCommonsForm->hidden('PhotoAlbumPhoto.id', array('value' => $data['PhotoAlbumPhoto']['id']));

		$onClickScript = 'return confirm(\'' .
			__d('photo_albums', 'Approving the photo. Are you sure to proceed?') .
			'\')';
		$output .= $this->Workflow->publishLinkButton(
			'',
			array(
				'iconSize' => 'btn-xs',
				'onclick' => $onClickScript,
				'ng-class' => '{disabled: sending}',
			)
		);

		$output .= $this->NetCommonsForm->end();

		if (Current::permission('photo_albums_photo_creatable') &&
			$this->Workflow->canEdit('PhotoAlbumPhoto', $data)
		) {
			$output .= $this->LinkButton->edit(
				'',
				array(
					'plugin' => 'photo_albums',
					'controller' => 'photo_album_photos',
					'action' => 'edit',
					$data['PhotoAlbumPhoto']['album_key'],
					$data['PhotoAlbumPhoto']['key']
				),
				array(
					'iconSize' => 'btn-xs',
				)
			);
		}
		$output .= '</div>';

		return $this->Html->div('photo-albums-photo-action-bar', $output);
	}
}
