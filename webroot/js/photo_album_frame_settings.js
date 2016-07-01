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
    this.checkDisplayTypeSlide = photoAlbumsValues.checkDisplayTypeSlide;
    this.albums = photoAlbumsValues.albums;
    this.displayAlbumKeys = photoAlbumsValues.displayAlbumKeys;

    this.checkedAll = false;
    this.reverse = false;

    this.checkAll = function() {
      this.displayAlbumKeys = [];
      if (!this.checkedAll) {
        return;
      }

      angular.forEach(this.albums, function(album) {
        this.displayAlbumKeys.push(album.PhotoAlbum.key);
      }, this);
    };

    this.sortBy = function(propertyName) {
      if (this.propertyName === propertyName) {
        this.reverse = !this.reverse;
      }
      this.propertyName = propertyName;
    };
  }
]);
