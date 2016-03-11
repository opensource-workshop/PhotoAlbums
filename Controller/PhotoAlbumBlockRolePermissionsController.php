<?php
/**
 * PhotoAlbumBlockRolePermissions Controller
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppController', 'PhotoAlbums.Controller');

/**
 * PhotoAlbumBlockRolePermissions Controller
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
		//'Questionnaires.QuestionnaireSetting',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'edit' => 'block_permission_editable',
			),
		),
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'block_index' => false,
				'role_permissions' => true,
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
	}
}
