<?php
/**
 * RenamePluginNamespace Class
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Plugin.namespaceを修正するMigration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PhotoAlbums\Config\Migration
 */
class RenamePluginNamespace extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'rename_plugin_namespace';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(),
		'down' => array(),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		if ($direction === 'down') {
			return true;
		}

		$Model = $this->generateModel('Plugin');

		$conditions = array(
			'Plugin.key' => 'photo_albums'
		);
		$update = array(
			'Plugin.namespace' => '\'netcommons/photo-albums\''
		);
		if (! $Model->updateAll($update, $conditions)) {
			return false;
		}
		return true;
	}
}
