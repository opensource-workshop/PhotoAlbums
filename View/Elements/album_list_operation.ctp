<?php
/**
 * PhotoAlbum album list operation template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="text-right" style="margin: 10px 0px;">
	<span class="btn-group text-left">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<?php
				// 現在選択されている表示順処理
				echo __d('net_commons', 'Title');
			?>
			<span class="caret">
			</span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<li>
				<a href="">
					<?php echo __d('net_commons', 'Newest'); ?>
				</a>
			</li>
			<li>
				<a href="">
					<?php echo __d('net_commons', 'Oldest'); ?>
				</a>
			</li>
			<li>
				<a href="">
					<?php echo __d('net_commons', 'Title'); ?>
				</a>
			</li>
		</ul>
	</span>
	<?php echo $this->DisplayNumber->dropDownToggle(); ?>
</div>

