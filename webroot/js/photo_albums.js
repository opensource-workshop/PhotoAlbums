/**
 * PhotoAlbums Javascript
 *
 * @author kteraguchi@commonsnet.org (Kohei Teraguchi)
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

// Add dependency module
NetCommonsApp.requires.push('ui.bootstrap.modal');

/**
 * PhotoAlbums Controller
 *
 * @param {string} Controller name
 * @param {function($scope, $sce)} Controller constructor function.
 */
NetCommonsApp.controller('PhotoAlbumsPhotoController',
['$modal', '$http', 'photoAlbumsValues', function($modal, $http, photoAlbumsValues) {

  this.add = function(albumKey) {
    $http.defaults.headers.common["Accept"] = "text/html";
    $modal.open({
      templateUrl: photoAlbumsValues.addUrl + albumKey
    });
  }

  this.slide = function(albumKey) {
    $http.defaults.headers.common["Accept"] = "text/html";
    $modal.open({
      templateUrl: photoAlbumsValues.slideUrl + albumKey,
      size: 'lg'
    });
  }

}]);
