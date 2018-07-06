<tagLib name="html" />
<include file="Public:header" />

<form method='post' id="form" name="form" action="{:U(MODULE_NAME.'/changePwd')}">
<table cellpadding="4" cellspacing="0" border="0" class="table-form">
	<tr>
		<th width="200">修改密码</th>
		<td><p>{$Think.session.account}</p></td>
	</tr>
	<tr>
		<th>现在密码</th>
		<td><input type="password" class="textinput requireinput" name="old_pwd" id="old_pwd" /></td>
	</tr>
	<tr>
		<th>新密码</th>
		<td><input type="password" class="textinput requireinput" name="new_pwd" id="new_pwd" /></td>
	</tr>
	<tr>
		<th>新密码确认</th>
		<td><input type="password" class="textinput requireinput" name="confirm_pwd" id="confirm_pwd" /></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td>
			<input type="submit" class="submit_btn" value="修改" />
			<input type="reset" class="reset_btn" value="重写" />
		</td>
	</tr>
</table>
</form>
<include file="Public:footer" />