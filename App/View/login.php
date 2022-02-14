<?php
$helper = App\Lib\Helper::getInstance();
echo $passwordHash = $helper->getPasswordHash('admin','1','admin@test.ru');
?>
<div class="detailed-page"></div>
<form action="/auth" method="post">
	Логин<input type="text" name="login" required="required" placeholder="     Логин..." value="admin"><br>
	Пароль<input type="text" name="password" required="required" placeholder="     Пароль..." value="1"><br>
	<input class="form-application-input-submit" type="submit" value="Отправить"><br>
</form>
</div>
