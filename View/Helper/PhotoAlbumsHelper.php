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
					$data['PhotoAlbum']['id'],
					'medium'
				),
				array(
					'alt' => __d('photo_albums', 'jacket'),
					'class' => 'img-responsive photo-albums-jacket'
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
					'alt' => __d('photo_albums', 'jacket'),
					'class' => 'img-responsive photo-albums-jacket'
				)
			);
		}

		return $output;
	}

/**
 * Creates a formatted div element for jacket by use background-image.
 *
 * @param array $data PhotoAlbum data with UploadFile
 * @return img tag
 */
	public function jacketByBackground($data) {
		if (isset($data['UploadFile']['jacket']['id'])) {
			$imageUrl = $this->Html->url(
				array(
					'plugin' => 'photo_albums',
					'controller' => 'photo_albums',
					'action' => 'jacket',
					Current::read('Block.id'),
					$data['PhotoAlbum']['id']
				)
			);
		} else {
			$imageUrl = $this->assetUrl(
				'PhotoAlbums.noimage.jpg',
				['pathPrefix' => Configure::read('App.imageBaseUrl')]
			);
		}

		$output = $this->Html->div(
			'photo-albums-jacket',
			'',
			['style' => 'background-image:url(' . $imageUrl . ');']
		);

		return $output;
	}

/**
 * Creates action bar element for photo.
 *
 * @param array $data PhotoAlbumPhoto data
 * @return form tag with approve button
 */
	public function photoActionBar($data) {
		$output = '';

		if ($data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_PUBLISHED) {
			$output .= $this->Workflow->label($data['PhotoAlbumPhoto']['status']);
			$output = $this->Html->div('pull-left', $output);
		}

		$operationOutput = $this->approveButton($data);

		if (Current::permission('photo_albums_photo_creatable') &&
			$this->Workflow->canEdit('PhotoAlbumPhoto', $data)
		) {
			$operationOutput .= $this->LinkButton->edit(
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

		if ($operationOutput) {
			$operationOutput = $this->Html->div('pull-right', $operationOutput);
		}

		$output .= $operationOutput;

		return $this->Html->div('photo-albums-photo-action-bar', $output);
	}

/**
 * Creates a formatted form element for approve Glyphicon.
 *
 * @param array $data PhotoAlbumPhoto data
 * @return form tag with approve button
 */
	public function approveButton($data) {
		$output = '';

		if (!Current::permission('content_publishable')) {
			return $output;
		}

		if ($data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_APPROVED &&
				$data['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_DISAPPROVED
		) {
			return $output;
		}

		$output .= $this->NetCommonsForm->create(
			'PhotoAlbumPhoto',
			array(
				'url' => array(
					'plugin' => 'photo_albums',
					'controller' => 'photo_album_photos',
					'action' => 'publish',
					Current::read('Block.id'),
					$data['PhotoAlbumPhoto']['album_key']
				),
				'class' => 'label'
			)
		);
		$options = array('value' => $data['PhotoAlbumPhoto']['id']);
		$output .= $this->NetCommonsForm->hidden('PhotoAlbumPhoto.0.id', $options);

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

		return $output;
	}

/**
 * Creates a formatted form element for approve Glyphicon.
 *
 * @param array $data PhotoAlbumPhoto list data
 * @return form tag with approve button
 */
	public function approveAllButton($data) {
		$output = '';

		if (empty($data)) {
			return $output;
		}
		if (!Current::permission('content_publishable')) {
			return $output;
		}

		$formTag = $this->NetCommonsForm->create(
			'PhotoAlbumPhoto',
			array(
				'url' => array(
					'plugin' => 'photo_albums',
					'controller' => 'photo_album_photos',
					'action' => 'publish',
					Current::read('Block.id'),
					$data[0]['PhotoAlbumPhoto']['album_key']
				),
				'class' => 'text-right'
			)
		);

		$hiddenTags = '';
		foreach ($data as $index => $photo) {
			if ($photo['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_APPROVED &&
				$photo['PhotoAlbumPhoto']['status'] != WorkflowComponent::STATUS_DISAPPROVED
			) {
				continue;
			}

			$fieldName = 'PhotoAlbumPhoto.' . $index . '.id';
			$options = array('value' => $photo['PhotoAlbumPhoto']['id']);
			$hiddenTags .= $this->NetCommonsForm->hidden($fieldName, $options);
		}

		if (!$hiddenTags) {
			return $output;
		}

		$output .= $formTag . $hiddenTags;

		$onClickScript = 'return confirm(\'' .
			__d('photo_albums', 'Approving the photo you are viewing. Are you sure to proceed?') .
			'\')';
		$output .= $this->Workflow->publishLinkButton(
			__d('photo_albums', 'Approving the photo you are viewing'),
			array(
				'onclick' => $onClickScript,
				'ng-class' => '{disabled: sending}',
			)
		);

		$output .= $this->NetCommonsForm->end();

		return $output;
	}

/**
 * Creates a status and photo alert element
 *
 * @param array $data PhotoAlbumAlbum list data
 * @return form tag with approve button
 */
	public function albumListAlert($data) {
		$output = $this->Workflow->label($data['PhotoAlbum']['status']);
		if ($output) {
			$output = $this->Html->div('photo-albums-album-list-status pull-left', $output);
		}

		$pending = '';
		if (Current::permission('content_publishable') &&
			$data['PhotoAlbum']['pending_photo_count']
		) {
			$url = $this->NetCommonsHtml->url(
				array(
					'controller' => 'photo_album_photos',
					'action' => 'index',
					$data['PhotoAlbum']['key'],
					'status' => WorkflowComponent::STATUS_APPROVED,
				)
			);
			$pending = __d(
				'photo_albums',
				'%s pending approval',
				$data['PhotoAlbum']['pending_photo_count']
			);
			$pending = $this->Html->tag('a', $pending, array('href' => $url));
		}

		$disapproved = '';
		if (Current::permission('photo_albums_photo_creatable') &&
			$data['PhotoAlbum']['disapproved_photo_count']
		) {
			$url = $this->NetCommonsHtml->url(
				array(
					'controller' => 'photo_album_photos',
					'action' => 'index',
					$data['PhotoAlbum']['key'],
					'status' => WorkflowComponent::STATUS_DISAPPROVED,
				)
			);
			$disapproved = __d(
				'photo_albums',
				'%s denied',
				$data['PhotoAlbum']['disapproved_photo_count']
			);
			$disapproved = $this->Html->tag('a', $disapproved, array('href' => $url));
		}

		$alert = '';
		if ($pending) {
			$alert = $pending;
		}

		if ($disapproved) {
			$alert .= $disapproved;
		}

		if ($alert) {
			$alert = __d('photo_albums', '%s in this album.', $alert);

			$options = array(
				'type' => 'button',
				'class' => 'close',
				'data-dismiss' => 'alert',
				'aria-label' => 'Close',
			);
			$alert = $this->Html->tag('button',
				'<span aria-hidden="true">&times;</span>',
				$options
			) . $alert;

			$options = array('role' => 'alert');
			$output .= $this->Html->div(
				'alert alert-warning alert-dismissible pull-right',
				$alert,
				$options
			);
		}

		if ($output) {
			$output = $this->Html->div('photo-albums-album-list-alert clearfix', $output);
		}

		return $output;
	}
}
