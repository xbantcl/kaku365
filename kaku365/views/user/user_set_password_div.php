<div class="m_password" id="r_content">
	<form action="set_password" method="post">
    <h3>修改密码</h3>
    <ul>
      <li>请输入新密码：<input required id="password" name="new_password" type="password" minlength="6" maxlength="20" ></li>
      <li>请确认新密码： <input required id="s_password" name="c_new_password" type="password" onblur="check_pwd()"></li><span id="error_s_password"></span>
      <li>请输入旧密码：<input required name="old_password" type="password"></li>
      <li><input id="password_sub" type="submit" value="确认"></li>
    </ul>
    </form>
</div>