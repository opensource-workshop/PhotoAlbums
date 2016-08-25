<?php
/**
 * AddSlideHeight Class
 *
 */

/**
 * AddSlideHeight Class
 *
 */
class AddSlideHeight extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_slide_height';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'photo_album_frame_settings' => array(
					'slide_height' => array('type' => 'integer', 'null' => true, 'default' => '400', 'unsigned' => false, 'comment' => 'Slide show height', 'after' => 'photos_direction'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'photo_album_frame_settings' => array('slide_height'),
			),
		),
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
		return true;
	}
}
