<?php
/**
 * BlockRolePermission edit template
 *
 * @copyright Copyright 2014, NetCommons Project
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_PERMISSION); ?>

	<div class="tab-content">
<form class="ng-pristine ng-valid" action="/faqs/faq_block_role_permissions/edit/4?frame_id=8" ng-submit="sending=true;" novalidate="novalidate" id="FaqBlockRolePermissionEditForm" method="post" accept-charset="utf-8">
	<div style="display:none;">
		<input name="_method" value="POST" type="hidden">
		<input name="data[_Token][key]" value="917bb2b758ee93c0256f418851e42abffac4bdbfa9e629ca6add5cb74ce36938f7a1a87261d03fab00061db6d7f15d572a3c8a71d064123cb44ee728bae29c32" id="Token597751579" type="hidden">
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<input name="data[FaqSetting][id]" value="1" id="FaqSettingId" type="hidden">
			<input name="data[FaqSetting][faq_key]" value="98c21223aa90c2f18c01a7c794173cb5" id="FaqSettingFaqKey" type="hidden">
			<input name="data[Block][id]" value="4" id="BlockId" type="hidden">
			<input name="data[Block][key]" value="173638b3f7a8e93467bc9ae778065e98" id="BlockKey" type="hidden">
			<div class="ng-scope" ng-controller="BlockRolePermissions" ng-init="initializeRoles({&quot;roles&quot;:{&quot;roomAdministrator&quot;:{&quot;id&quot;:&quot;11&quot;,&quot;roleKey&quot;:&quot;room_administrator&quot;,&quot;level&quot;:&quot;2147483647&quot;,&quot;weight&quot;:&quot;1&quot;,&quot;createdUser&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modifiedUser&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;languageId&quot;:&quot;2&quot;,&quot;key&quot;:&quot;room_administrator&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u30eb\u30fc\u30e0\u7ba1\u7406\u8005&quot;,&quot;isSystem&quot;:true},&quot;chiefEditor&quot;:{&quot;id&quot;:&quot;12&quot;,&quot;roleKey&quot;:&quot;chief_editor&quot;,&quot;level&quot;:&quot;8000&quot;,&quot;weight&quot;:&quot;2&quot;,&quot;createdUser&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modifiedUser&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;languageId&quot;:&quot;2&quot;,&quot;key&quot;:&quot;chief_editor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u7de8\u96c6\u9577&quot;,&quot;isSystem&quot;:true},&quot;editor&quot;:{&quot;id&quot;:&quot;13&quot;,&quot;roleKey&quot;:&quot;editor&quot;,&quot;level&quot;:&quot;7000&quot;,&quot;weight&quot;:&quot;3&quot;,&quot;createdUser&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modifiedUser&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;languageId&quot;:&quot;2&quot;,&quot;key&quot;:&quot;editor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u7de8\u96c6\u8005&quot;,&quot;isSystem&quot;:true},&quot;generalUser&quot;:{&quot;id&quot;:&quot;14&quot;,&quot;roleKey&quot;:&quot;general_user&quot;,&quot;level&quot;:&quot;6000&quot;,&quot;weight&quot;:&quot;4&quot;,&quot;createdUser&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modifiedUser&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;languageId&quot;:&quot;2&quot;,&quot;key&quot;:&quot;general_user&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u4e00\u822c&quot;,&quot;isSystem&quot;:true},&quot;visitor&quot;:{&quot;id&quot;:&quot;15&quot;,&quot;roleKey&quot;:&quot;visitor&quot;,&quot;level&quot;:&quot;1000&quot;,&quot;weight&quot;:&quot;5&quot;,&quot;createdUser&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modifiedUser&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;languageId&quot;:&quot;2&quot;,&quot;key&quot;:&quot;visitor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u53c2\u89b3\u8005&quot;,&quot;isSystem&quot;:true}}})">
				<div class="panel panel-default">
					<div class="panel-heading">作成権限</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="BlockRolePermissionContentCreatable">アルバムを作成できる権限</label>
							<div class="form-inline">
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][room_administrator][value]" id="BlockRolePermissionContentCreatableRoomAdministratorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][room_administrator][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableRoomAdministratorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableRoomAdministratorValue">ルーム管理者</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][chief_editor][value]" id="BlockRolePermissionContentCreatableChiefEditorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][chief_editor][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableChiefEditorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableChiefEditorValue">編集長</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][editor][value]" id="BlockRolePermissionContentCreatableEditorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][editor][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableEditorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableEditorValue">編集者</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][general_user][id]" id="BlockRolePermissionContentCreatableGeneralUserId" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][roles_room_id]" value="4" id="BlockRolePermissionContentCreatableGeneralUserRolesRoomId" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][block_key]" value="173638b3f7a8e93467bc9ae778065e98" id="BlockRolePermissionContentCreatableGeneralUserBlockKey" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][permission]" value="content_creatable" id="BlockRolePermissionContentCreatableGeneralUserPermission" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][value]" id="BlockRolePermissionContentCreatableGeneralUserValue_" value="0" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][value]" ng-click="clickRole($event, 'content_creatable', 'generalUser')" value="1" id="BlockRolePermissionContentCreatableGeneralUserValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableGeneralUserValue">一般</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="BlockRolePermissionContentCreatable">写真を追加できる権限</label>
							<div class="form-inline">
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][room_administrator][value]" id="BlockRolePermissionContentCreatableRoomAdministratorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][room_administrator][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableRoomAdministratorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableRoomAdministratorValue">ルーム管理者</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][chief_editor][value]" id="BlockRolePermissionContentCreatableChiefEditorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][chief_editor][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableChiefEditorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableChiefEditorValue">編集長</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][editor][value]" id="BlockRolePermissionContentCreatableEditorValue_" value="0" disabled="disabled" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][editor][value]" disabled="disabled" value="1" id="BlockRolePermissionContentCreatableEditorValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableEditorValue">編集者</label>
								</div>
								<span class="checkbox-separator">
								</span>
								<div class="form-group">
									<input name="data[BlockRolePermission][content_creatable][general_user][id]" id="BlockRolePermissionContentCreatableGeneralUserId" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][roles_room_id]" value="4" id="BlockRolePermissionContentCreatableGeneralUserRolesRoomId" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][block_key]" value="173638b3f7a8e93467bc9ae778065e98" id="BlockRolePermissionContentCreatableGeneralUserBlockKey" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][permission]" value="content_creatable" id="BlockRolePermissionContentCreatableGeneralUserPermission" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][value]" id="BlockRolePermissionContentCreatableGeneralUserValue_" value="0" type="hidden">
									<input name="data[BlockRolePermission][content_creatable][general_user][value]" ng-click="clickRole($event, 'content_creatable', 'generalUser')" value="1" id="BlockRolePermissionContentCreatableGeneralUserValue" checked="checked" type="checkbox">
									<label for="BlockRolePermissionContentCreatableGeneralUserValue">一般</label>
								</div>
							</div>
						</div>
						</div>
				</div>
			</div>
			<div class="ng-scope" ng-controller="BlockRolePermissions" ng-init="initializeApproval({&quot;roles&quot;:{&quot;room_administrator&quot;:{&quot;id&quot;:&quot;11&quot;,&quot;role_key&quot;:&quot;room_administrator&quot;,&quot;level&quot;:&quot;2147483647&quot;,&quot;weight&quot;:&quot;1&quot;,&quot;created_user&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modified_user&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;language_id&quot;:&quot;2&quot;,&quot;key&quot;:&quot;room_administrator&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u30eb\u30fc\u30e0\u7ba1\u7406\u8005&quot;,&quot;is_system&quot;:true},&quot;chief_editor&quot;:{&quot;id&quot;:&quot;12&quot;,&quot;role_key&quot;:&quot;chief_editor&quot;,&quot;level&quot;:&quot;8000&quot;,&quot;weight&quot;:&quot;2&quot;,&quot;created_user&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modified_user&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;language_id&quot;:&quot;2&quot;,&quot;key&quot;:&quot;chief_editor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u7de8\u96c6\u9577&quot;,&quot;is_system&quot;:true},&quot;editor&quot;:{&quot;id&quot;:&quot;13&quot;,&quot;role_key&quot;:&quot;editor&quot;,&quot;level&quot;:&quot;7000&quot;,&quot;weight&quot;:&quot;3&quot;,&quot;created_user&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modified_user&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;language_id&quot;:&quot;2&quot;,&quot;key&quot;:&quot;editor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u7de8\u96c6\u8005&quot;,&quot;is_system&quot;:true},&quot;general_user&quot;:{&quot;id&quot;:&quot;14&quot;,&quot;role_key&quot;:&quot;general_user&quot;,&quot;level&quot;:&quot;6000&quot;,&quot;weight&quot;:&quot;4&quot;,&quot;created_user&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modified_user&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;language_id&quot;:&quot;2&quot;,&quot;key&quot;:&quot;general_user&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u4e00\u822c&quot;,&quot;is_system&quot;:true},&quot;visitor&quot;:{&quot;id&quot;:&quot;15&quot;,&quot;role_key&quot;:&quot;visitor&quot;,&quot;level&quot;:&quot;1000&quot;,&quot;weight&quot;:&quot;5&quot;,&quot;created_user&quot;:null,&quot;created&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;modified_user&quot;:null,&quot;modified&quot;:&quot;2015-08-20 01:30:01&quot;,&quot;language_id&quot;:&quot;2&quot;,&quot;key&quot;:&quot;visitor&quot;,&quot;type&quot;:&quot;2&quot;,&quot;name&quot;:&quot;\u53c2\u89b3\u8005&quot;,&quot;is_system&quot;:true}},&quot;useWorkflow&quot;:1})">
				<div class="panel panel-default">
					<div class="panel-heading">承認機能</div>
					<div class="panel-body">
						<div class="form-group">
							<input name="data[FaqSetting][use_workflow]" ng-value="useWorkflow" value="1" id="FaqSettingUseWorkflow" type="hidden">
							<input name="data[FaqSetting][approval_type]" id="FaqSettingApprovalType1" value="1" checked="checked" ng-click="clickApprovalType($event)" type="radio">
							<label for="FaqSettingApprovalType1">承認が必要</label>
							<br>
							<input name="data[FaqSetting][approval_type]" id="FaqSettingApprovalType0" value="0" ng-click="clickApprovalType($event)" type="radio">
							<label for="FaqSettingApprovalType0">不要</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer text-center">
			<button type="button" class="btn btn-default btn-workflow " ng-disabled="sending" ng-click="sending=true" onclick="location.href ='/photo_albums/photo_albums/index?frame_id=37'" name="cancel">
				<span class="glyphicon glyphicon-remove">
				</span>
				キャンセル
			</button>
			<button name="save" class="btn btn-primary btn-workflow" ng-disabled="sending" type="submit">決定</button>
		</div>
	</div>
	<input name="data[_NetCommonsTime][user_timezone]" value="Asia/Tokyo" id="_NetCommonsTimeUserTimezone" type="hidden">
	<input name="data[_NetCommonsTime][convert_fields]" value="" id="_NetCommonsTimeConvertFields" type="hidden">
	<div style="display:none;">
		<input name="data[_Token][fields]" value="f24ee82b320fb580f062968118180aa76a04e3af%3ABlock.id%7CBlock.key%7CBlockRolePermission.content_creatable.general_user.block_key%7CBlockRolePermission.content_creatable.general_user.id%7CBlockRolePermission.content_creatable.general_user.permission%7CBlockRolePermission.content_creatable.general_user.roles_room_id%7CFaqSetting.faq_key%7CFaqSetting.id%7C_NetCommonsTime.convert_fields%7C_NetCommonsTime.user_timezone" id="TokenFields972119950" type="hidden">
		<input name="data[_Token][unlocked]" value="FaqSetting.use_workflow%7Ccancel%7Csave" id="TokenUnlocked1145811061" type="hidden">
	</div>
</form>

	</div>
</div>
