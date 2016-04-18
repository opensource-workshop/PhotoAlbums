<?php
/**
 * PhotoAlbumSettings Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 *
 */
class PhotoAlbumBlockRolePermissionsController extends PhotoAlbumsAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbumSetting',
		'Blocks.Block'
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'NetCommons.Permission' => array(
			'allow' => array(
				'edit' => 'block_permission_editable',
			),
		),
		'Workflow.Workflow',
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'frame_settings',
				'role_permissions'
			)
		),
		'Blocks.BlockRolePermissionForm',
		'NetCommons.Date',
	);

/**
 * edit
 *
 * @return void
 */
	public function edit() {
		$permissions = $this->Workflow->getBlockRolePermissions(
			array(
				'content_creatable',
				'content_publishable',
				'photo_albums_photo_creatable'
			)
		);
		$this->set('roles', $permissions['Roles']);

		if ($this->request->is(array('post', 'put'))) {
			if ($this->PhotoAlbumSetting->savePhotoAlbumSetting($this->request->data)) {
				$this->redirect(NetCommonsUrl::backToPageUrl());
				return;
			}
			$this->NetCommons->handleValidationError($this->PhotoAlbumSetting->validationErrors);

			$this->request->data['BlockRolePermission'] = Hash::merge(
				$permissions['BlockRolePermissions'],
				$this->request->data['BlockRolePermission']
			);

		} else {
			$this->request->data = $this->PhotoAlbumSetting->getSetting();
			$this->request->data['BlockRolePermission'] = $permissions['BlockRolePermissions'];
			$this->request->data['Frame']['id'] = Current::read('Frame.id');
			$this->request->data['Block'] = Current::read('Block');
		}
	}
}
