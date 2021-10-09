<?php $message = getMessageAuth()?>
<div class="auth">
    <?php if ($auth): ?>
        Добро пожаловать, <?=$name?>! <a href="/logout">[Выход]</a>
    <?php else:?>
        <?=$message?>
        <form method="post" action="/login">
            <p><input type="text" name="login"></p>
            <p><input type="password" name="pass"></p>
            Save? <input type="checkbox" name="save">
            <p><input type="submit" name="ok"></p>
        </form>
    <?php endif;?>
    <br>
</div>