<?php 
class PhotoAlbumsSchema extends CakeSchema {

	public $connection = 'master';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $photo_album_display_albums = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'album_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $photo_album_frame_settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'display_type' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'unsigned' => false, 'comment' => '1:List of album, 2:List of photo, 3: Slide show'),
		'albums_per_page' => array('type' => 'integer', 'null' => true, 'default' => '20', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'albums_order' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbum.modified desc', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'albums_sort' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbum.modified', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'albums_direction' => array('type' => 'string', 'null' => true, 'default' => 'desc', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
		'photos_per_page' => array('type' => 'integer', 'null' => true, 'default' => '50', 'unsigned' => false, 'comment' => 'Number of displays of albums per one page'),
		'photos_order' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumPhoto.modified desc', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'photos_sort' => array('type' => 'string', 'null' => true, 'default' => 'PhotoAlbumPhoto.modified', 'length' => 128, 'collate' => 'utf8_general_ci', 'comment' => 'Sort field name', 'charset' => 'utf8'),
		'photos_direction' => array('type' => 'string', 'null' => true, 'default' => 'desc', 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'ASC or DESC', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $photo_album_photos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'album_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'Sequence number of each block'),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Serial key of content history', 'charset' => 'utf8'),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => '1:Published, 2:Pending, 3:In draft, 4:Disapproved'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Deactive, 1:Acive'),
		'is_latest' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Not latest, 1:Latest'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $photo_album_settings = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'block_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'use_workflow' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => '0:Unused, 1:Use'),
		'use_like' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
		'use_unlike' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
		'use_comment' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
		'use_comment_approval' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Unused, 1:Use'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $photo_albums = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Serial key of content history', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'Sequence number of each block'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => '1:Published, 2:Pending, 3:In draft, 4:Disapproved'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Deactive, 1:Acive'),
		'is_latest' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0:Not latest, 1:Latest'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
