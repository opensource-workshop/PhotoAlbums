<?php
/**
 * PhotoAlbums photo slide template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php
echo $this->NetCommonsHtml->css(
	array(
		'/components/angular-carousel/dist/angular-carousel.min.css',
		'/photo_albums/css/style.css'
	)
);
echo $this->NetCommonsHtml->script(
	array(
		'/components/angular-carousel/dist/angular-carousel.min.js',
		'/components/angular-touch/angular-touch.min.js',
		'/photo_albums/js/photo_albums.js'
	)
);
?>


<div ng-controller="PhotoAlbums.slide">
	<div class="carousel-demo">
		<ul rn-carousel rn-carousel-controls rn-carousel-index="carouselIndex" rn-carousel-buffered class="carousel1">
			<li ng-repeat="slide in slides track by slide.id" ng-class="'id-' + slide.id">
				<div ng-style="{'background-image': 'url(' + slide.img + ')'}"  class="bgimage">
					#{{ slide.id }}
				</div>
			</li>
		</ul>
	</div>
<!--
	<div class="carousel-demo-fullscreen">
		<ul rn-carousel rn-carousel-controls rn-carousel-transition="hexagon" rn-carousel-index="carouselIndex" rn-carousel-buffered class="carousel1">
			<li ng-repeat="slide in slides track by slide.id" ng-class="'id-' + slide.id">
				<div ng-style="{'background-image': 'url(' + slide.img + ')'}"  class="bgimage">
					#{{ slide.id }}
				</div>
			</li>
		</ul>
	</div>
 -->
</div>

スライド