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

<header class="clearfix photo-albums-album-list-operation">
	<div class='pull-right'>
		<?php
			echo $this->Workflow->addLinkButton(
				__d('photo_albums', 'Add album'),
				null,
				array(
					'tooltip' => __d('photo_albums', 'Create albums')
				)
			);
		?>
	</div>

	<?php if ($this->request->params['controller'] == 'photo_albums'): ?>
		<div class="pull-left">
			<span class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php
						switch ($this->Paginator->sortKey() . ' ' . $this->Paginator->sortDir()) {
							case 'PhotoAlbum.modified desc':
								echo __d('net_commons', 'Newest');
								break;
							case 'PhotoAlbum.created asc':
								echo __d('net_commons', 'Oldest');
								break;
							default:
								echo __d('net_commons', 'Title');
						}
					?>
					<span class="caret">
					</span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<?php
							echo $this->Paginator->sort(
								'PhotoAlbum.modified',
								__d('net_commons', 'Newest'),
								array(
									'direction' => 'desc',
									'lock' => true
								)
							);
						?>
					</li>
					<li>
						<?php
							echo $this->Paginator->sort(
								'PhotoAlbum.created',
								__d('net_commons', 'Oldest'),
								array(
									'direction' => 'asc',
									'lock' => true
								)
							);
						?>
					</li>
					<li>
						<?php
							echo $this->Paginator->sort(
								'PhotoAlbum.name',
								__d('net_commons', 'Title'),
								array(
									'direction' => 'asc',
									'lock' => true
								)
							);
						?>
					</li>
				</ul>
			</span>
			<?php echo $this->DisplayNumber->dropDownToggle(); ?>
		</div>
	<?php endif; ?>
</header>

