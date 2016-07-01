<?php
/**
 * PhotoAlbums Json Helper class file.
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppHelper', 'View/Helper');

/**
 * PhotoAlbumsJsonHelper
 *
 *
 */
class PhotoAlbumsJsonHelper extends AppHelper {

/**
 * Creates JSON for frame setting
 * displayType: 表示タイプradio用
 * checkDisplayTypeSlide: 表示タイプがスライドの場合のcheckbox用
 * checkAlbumKeys: 表示アルバムcheckbox用
 * checkAlbumKey: 表示アルバムradio用
 *
 * @return JSON encoded string
 */
	public function frameSetting() {
		$values = array(
			'displayType' => $this->request->data['PhotoAlbumFrameSetting']['display_type'],
			'checkDisplayTypeSlide' => false,
			'albums' => $this->_View->viewVars['albums'],
			'displayAlbumKeys' => $this->_View->viewVars['displayAlbumKeys'],
		);

		if ($values['displayType'] == PhotoAlbumFrameSetting::DISPLAY_TYPE_SLIDE) {
			// スライド選択時に強制的に写真一覧を選択させるため
			$values['displayType'] = PhotoAlbumFrameSetting::DISPLAY_TYPE_PHOTOS;
			$values['checkDisplayTypeSlide'] = true;
		}

		return json_encode($values);
	}

}
