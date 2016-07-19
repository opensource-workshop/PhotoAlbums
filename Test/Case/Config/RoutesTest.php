<?php
/**
 * Config/routes.phpのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsRoutesTestCase', 'NetCommons.TestSuite');

/**
 * Config/routes.phpのテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Pages\Test\Case\Routing\Route\SlugRoute
 */
class RoutesTest extends NetCommonsRoutesTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'photo_albums';

/**
 * DataProvider
 *
 * ### 戻り値
 * - url URL
 * - expected 期待値
 *
 * @return array テストデータ
 */
	public function dataProvider() {
		return array(
			array(
				'url' => '/photo_albums/photo_album_photos/photo/1/content_key/2/thumb',
				'expected' => array(
					'plugin' => 'photo_albums', 'controller' => 'photo_album_photos', 'action' => 'photo',
					'block_id' => '1', 'key' => 'content_key', 'content_id' => '2', 'size' => 'thumb'
				)
			),
			array(
				'url' => '/photo_albums/photo_album_photos/photo/1/content_key/2',
				'expected' => array(
					'plugin' => 'photo_albums', 'controller' => 'photo_album_photos', 'action' => 'photo',
					'block_id' => '1', 'key' => 'content_key', 'content_id' => '2', 'size' => 'big'
				)
			),
			array(
				'url' => '/photo_albums/photo_albums/jacket/1/content_key/thumb',
				'expected' => array(
					'plugin' => 'photo_albums', 'controller' => 'photo_albums', 'action' => 'jacket',
					'block_id' => '1', 'key' => 'content_key', 'size' => 'thumb'
				)
			),
		);
	}

}
