<?php
/**
 * Questionnaire edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<?php echo $this->NetCommonsForm->hidden('Block.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Block.key'); ?>
<?php echo $this->NetCommonsForm->hidden('QuestionnaireSetting.block_key'); ?>
<?php echo $this->NetCommonsForm->hidden('QuestionnaireSetting.id'); ?>

<?php echo $this->element('Blocks.block_creatable_setting', array(
		'settingPermissions' => array(
			'content_creatable' => __d('blocks', 'Content creatable roles'),
		),
	)); ?>

<?php echo $this->element('Blocks.block_approval_setting', array(
		'model' => 'QuestionnaireSetting',
		'useWorkflow' => 'use_workflow',
		'options' => array(
			Block::NEED_APPROVAL => __d('blocks', 'Need approval'),
			Block::NOT_NEED_APPROVAL => __d('blocks', 'Not need approval'),
		),
	));
