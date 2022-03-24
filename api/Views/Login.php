<?php if(isset($error)):?>
<?=$error?> <br><br>
<?php endif;?>
<form method="post">
    <label>
        <input name="login" type="text"> - Логин
    </label><br><br>
    <label>
        <input name="password" type="password"> - Пароль
    </label><br><br>
    <button type="submit">Войти</button>
</form>