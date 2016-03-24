<?php
/**
 * PhotoAlbumPhoto Model
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('PhotoAlbumsAppModel', 'PhotoAlbums.Model');

/**
 * Summary for PhotoAlbumPhoto Model
 */
class PhotoAlbumPhoto extends PhotoAlbumsAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'master';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		//'NetCommons.OriginalKey',
		'Workflow.Workflow',
		'Workflow.WorkflowComment',
	);
}
