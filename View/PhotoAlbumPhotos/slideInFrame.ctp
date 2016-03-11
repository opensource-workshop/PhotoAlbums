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

<h2>アルバムのタイトル</h2>
<div style="margin:0 20px 30px;">
アルバムの説明<br>
・・・・・・・・<br>
・・・・・・・・・・
</div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators  -->
	<ol class="carousel-indicators">
		<?php for ($index = 0; $index < count($photos); $index++) : ?>
		<li data-target="#carousel-example-generic" data-slide-to="<?php echo $index; ?>"<?php if (empty($index)) { echo ' class="active"';} ?>></li>
		<?php endfor; ?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php foreach ($photos as $index => $photo) : ?>
			<div class="item<?php if (empty($index)) { echo ' active';} ?>">
				<img src="<?php echo $photo['PhotoAlbumPhoto']['src'] ?>" style="margin:auto;">
				<div class="carousel-caption">
					<?php echo $photo['PhotoAlbumPhoto']['title'] ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

スライド