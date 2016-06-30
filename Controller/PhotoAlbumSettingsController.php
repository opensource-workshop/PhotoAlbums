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
 * PhotoAlbumSettings Controller
 *
 * @property PhotoAlbumFrameSetting $PhotoAlbumFrameSetting
 * @property PhotoAlbum $PhotoAlbum
 * @property PhotoAlbumDisplayAlbum $PhotoAlbumDisplayAlbum
 * @property PaginatorComponent $Paginator
 * @property PageLayoutComponent $PageLayout
 * @property PermissionComponent $Permission
 * @property PhotoAlbumsComponent $PhotoAlbums
 */
class PhotoAlbumSettingsController extends PhotoAlbumsAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'PhotoAlbums.PhotoAlbum',
		'PhotoAlbums.PhotoAlbumFrameSetting',
		'PhotoAlbums.PhotoAlbumDisplayAlbum'
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
				'index' => 'page_editable',
			),
		),
		'Paginator',
		'PhotoAlbums.PhotoAlbums'
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'block_index' => array(
					'url' => array(
						'plugin' => 'photo_albums',
						'controller' => 'photo_album_settings',
						'action' => 'index'
					),
					'label' => array('net_commons', 'List')
				),
				'frame_settings',
				'role_permissions'
			)
		),
		'NetCommons.DisplayNumber',
		'NetCommons.Date',
		'NetCommons.TableList',
		'Blocks.BlockIndex',
		'Workflow.Workflow',
	);

/**
 * edit method
 *
 * @return void
 */
	public function index() {
		$this->PhotoAlbums->initializeSetting();

		$frameSetting = $this->PhotoAlbumFrameSetting->getFrameSetting();

		$conditions = $this->PhotoAlbum->getWorkflowConditions();
		$conditions['PhotoAlbum.block_id'] = Current::read('Block.id');
		$this->Paginator->settings = array(
			'PhotoAlbum' => array(
				'sort' => $frameSetting['PhotoAlbumFrameSetting']['albums_sort'],
				'direction' => $frameSetting['PhotoAlbumFrameSetting']['albums_direction'],
				'limit' => $frameSetting['PhotoAlbumFrameSetting']['albums_per_page'],
				'conditions' => $conditions
			)
		);
		$this->set('albums', $this->Paginator->paginate('PhotoAlbum'));

		$query = array(
			'fields' => array(
				'PhotoAlbumDisplayAlbum.album_key'
			),
			'conditions' => array(
				'PhotoAlbumDisplayAlbum.frame_key' => Current::read('Frame.key')
			),
			'recursive' => -1
		);
		$this->set('displayAlbumKeys', $this->PhotoAlbumDisplayAlbum->find('list', $query));
	}
}
