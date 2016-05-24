/**
 * PhotoAlbumFrameSettings Javascript
 *
 * @author kteraguchi@commonsnet.org (Kohei Teraguchi)
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */


/**
 * PhotoAlbumFrameSettings Controller
 *
 * @param {string} Controller name
 */
NetCommonsApp.controller('PhotoAlbumsFrameSettingController', ['photoAlbumsValues',
  function(photoAlbumsValues) {
    this.displayType = photoAlbumsValues.displayType;
    this.checkModel = photoAlbumsValues.checkModel;

    this.changeDisplayType = function() {
      console.log(this.displayType);
    };
  }
]);
