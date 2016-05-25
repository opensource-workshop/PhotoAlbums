<?php
/**
 * PhotoAlbumTestCurrentUtil Class
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for PhotoAlbumTestCurrentUtil
 */
class PhotoAlbumTestCurrentUtil {

/**
 * Current reflection object
 *
 * @var array
 */
	private static $__currentProperty = null;

/**
 * Current origin value
 *
 * @var array
 */
	private static $__originValue = array();

/**
 * setValue method
 *
 * @param array $value Current::$current value
 * @return void
 */
	public static function setValue($value) {
		if (!isset(self::$__currentProperty)) {
			self::$__currentProperty = new ReflectionProperty('Current', 'current');
			self::$__currentProperty->setAccessible(true);
			self::$__originValue = self::$__currentProperty->getValue();
		}

		self::$__currentProperty->setValue(array_merge(self::$__originValue, $value));
	}

/**
 * setOriginValue method
 *
 * @return void
 */
	public static function setOriginValue() {
		if (!isset(self::$__currentProperty)) {
			return;
		}

		self::$__currentProperty->setValue(self::$__originValue);
	}
}
