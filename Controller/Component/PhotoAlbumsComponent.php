<?php
/**
 * PhotoAlbums Component
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Component', 'Controller');

/**
 * PhotoAlbums Component
 *
 */
class PhotoAlbumsComponent extends Component {

/**
 * Initialize album setting and frame setting
 *
 * @return void
 */
	public function initializeSetting() {
		$blockKey = Current::read('Block.key');
		if (!isset($blockKey)) {
			$photoAlbumSetting = ClassRegistry::getObject('PhotoAlbums.PhotoAlbumSetting');
			if (!$photoAlbumSetting) {
				$photoAlbumSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumSetting');
			}

			$data = $photoAlbumSetting->create();
			$data['Frame']['id'] = Current::read('Frame.id');
			if (!$photoAlbumSetting->savePhotoAlbumSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			// Save BlockRolePermission
			$this->__initializeBlockRolePermission();
		}

		$frameSetting = ClassRegistry::getObject('PhotoAlbums.PhotoAlbumFrameSetting');
		if (!$frameSetting) {
			$frameSetting = ClassRegistry::init('PhotoAlbums.PhotoAlbumFrameSetting');
		}

		$query = array(
			'conditions' => array(
				'PhotoAlbumFrameSetting.frame_key' => Current::read('Frame.key')
			),
			'recursive' => -1
		);
		if (!$frameSetting->find('count', $query)) {
			$data = $frameSetting->create();
			if (!$frameSetting->savePhotoAlbumFrameSetting($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}
	}

/**
 * Initialize block role permissiona
 *
 * @return void
 */
	public function __initializeBlockRolePermission() {
		$rolePermission = ClassRegistry::getObject('Roles.DefaultRolePermission');
		if (!$rolePermission) {
			$rolePermission = ClassRegistry::init('Roles.DefaultRolePermission');
		}
		$query = array(
			'conditions' => array(
				'DefaultRolePermission.permission' => 'photo_albums_photo_creatable',
				'DefaultRolePermission.fixed' => 0
			),
			'recursive' => -1
		);
		$defaultPermissions = $rolePermission->find('all', $query);

		$rolesRoom = ClassRegistry::getObject('Rooms.RolesRoom');
		if (!$rolesRoom) {
			$rolesRoom = ClassRegistry::init('Rooms.RolesRoom');
		}
		$query = array(
			'conditions' => array(
				'RolesRoom.room_id' => Current::read('Room.id'),
				'RolesRoom.role_key' => Hash::extract($defaultPermissions, '{n}.DefaultRolePermission.role_key')
			),
			'fields' => array(
				'RolesRoom.role_key',
				'RolesRoom.id'
			),
			'recursive' => -1
		);
		$rolesRoomIds = $rolesRoom->find('list', $query);

		$rolePermission = ClassRegistry::getObject('Blocks.BlockRolePermission');
		if (!$rolePermission) {
			$rolePermission = ClassRegistry::init('Blocks.BlockRolePermission');
		}
		foreach ($defaultPermissions as $defaultPermission) {
			$roleKey = $defaultPermission['DefaultRolePermission']['role_key'];
			$blockPermission = array(
				'roles_room_id' => $rolesRoomIds[$roleKey],
				'block_key' => Current::read('Block.key'),
				'permission' => $defaultPermission['DefaultRolePermission']['permission'],
				'value' => $defaultPermission['DefaultRolePermission']['value'],
			);

			// TODO transaction....
			if (!$rolePermission->save($blockPermission)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}
	}

/**
 * Set album data to view
 *
 * @param Controller $controller Controller
 * @param array $query find条件
 * @return void
 */
	public function setAlbums(Controller $controller, $query = array()) {

	}
}
