<?php
/**
 * PhotoAlbumPhotos Component
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Component', 'Controller');

/**
 * PhotoAlbumPhotos Component
 *
 */
class PhotoAlbumPhotosComponent extends Component {

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::startup
 */
	public function startup(Controller $controller) {
		$Album = ClassRegistry::init('PhotoAlbums.PhotoAlbum');
		$query = array(
			'conditions' => $Album->getWorkflowConditions() + array(
				'PhotoAlbum.block_id' => Current::read('Block.id'),
				'PhotoAlbum.key' =>$controller->request->params['pass'][1]
			),
			'recursive' => -1,
		);
		if (!$Album->find('count', $query)) {
			throw new NotFoundException(__('Invalid photo album photo'));
		}
	}

}
