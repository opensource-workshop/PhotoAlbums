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
	);

/**
 * Creates a formatted IMG element for jacket.
 *
 * @param array $data data with UploadFile
 * @return img tag
 */
	public function jacket($data) {
		if (isset($data['UploadFile']['jacket']['id'])) {
			$output = $this->Html->image(
				array(
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
}
