<?php
/**
 * AddRecord Class
 *
 */
App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');
App::uses('Space', 'Rooms.Model');

/**
 * AddRecord Class
 *
 */
class AddRecord extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_record';

/**
 * recodes
 *
 * @var array $records
 */
	public $records = array(
		'Plugin' => array(
			//日本語
			array(
				'language_id' => '2',
				'is_origin' => true,
				'is_translation' => true,
				'key' => 'photo_albums',
				'namespace' => 'netcommons/photo_albums',
				'name' => 'フォトアルバム',
				'type' => 1,
				'default_action' => 'photo_albums/index',
				'default_setting_action' => 'photo_album_frame_settings/edit',
			),
			//英語
			array(
				'language_id' => '1',
				'is_origin' => false,
				'is_translation' => true,
				'key' => 'photo_albums',
				'namespace' => 'netcommons/blogs',
				'name' => 'Photo album',
				'type' => 1,
				'default_action' => 'photo_albums/index',
				'default_setting_action' => 'photo_album_frame_settings/edit',
			),
		),
		'PluginsRole' => array(
			array(
				'role_key' => 'room_administrator',
				'plugin_key' => 'photo_albums'
			),
		),

		//PluginsRoomは、beforeでセットする

		'DefaultRolePermission' => array(
			// 写真の投稿権限
			array('role_key' => 'room_administrator', 'type' => 'room_role', 'permission' => 'photo_albums_photo_creatable', 'value' => '1', 'fixed' => '1', ),
			array('role_key' => 'chief_editor', 'type' => 'room_role', 'permission' => 'photo_albums_photo_creatable', 'value' => '1', 'fixed' => '1', ),
			array('role_key' => 'editor', 'type' => 'room_role', 'permission' => 'photo_albums_photo_creatable', 'value' => '1', 'fixed' => '1', ),
			array('role_key' => 'general_user', 'type' => 'room_role', 'permission' => 'photo_albums_photo_creatable', 'value' => '1', 'fixed' => '0', ),
			array('role_key' => 'visitor', 'type' => 'room_role', 'permission' => 'photo_albums_photo_creatable', 'value' => '0', 'fixed' => '1', ),
		)
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		$pluginName = $this->records['Plugin'][0]['key'];
		$this->records['PluginsRoom'] = array(
			//サイト全体
			array(
				'room_id' => Space::getRoomIdRoot(Space::WHOLE_SITE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//パブリックスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::PUBLIC_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//プライベートスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::PRIVATE_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
			//グループスペース
			array(
				'room_id' => Space::getRoomIdRoot(Space::COMMUNITY_SPACE_ID, 'Room'),
				'plugin_key' => $pluginName
			),
		);
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		$this->loadModels([
			'Plugin' => 'PluginManager.Plugin',
		]);

		if ($direction === 'down') {
			$this->Plugin->uninstallPlugin($this->records['Plugin'][0]['key']);
			return true;
		}

		foreach ($this->records as $model => $records) {
			if (!$this->updateRecords($model, $records)) {
				return false;
			}
		}
		return true;
	}

}
