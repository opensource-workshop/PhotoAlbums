<?php
/**
 * UpdateRecord Class
 *
 */
App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * UpdateRecord Class
 *
 */
 class UpdateRecord extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'update_record';

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		$Plugin = $this->generateModel('Plugin');
		$query = array(
			'conditions' => array(
				'Plugin.key' => 'photo_albums'
			),
			'recursive' => -1
		);
		$plugins = $Plugin->find('all', $query);

		foreach ($plugins as $plugin) {
			$plugin['Plugin']['default_setting_action'] = 'photo_albums/setting';
			if (!$Plugin->save($plugin, false)) {
				return false;
			}
		}
		return true;
	}
}
