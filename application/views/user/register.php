
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8 page-heading">
            <h1>Регистрация пользователя</h1>
            <?php
                if (is_array($errors))
                    foreach ($errors as $error) {
            ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
            <?php
                    }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form role="form" method="POST" action="/register" class="form-horizontal">
                <div class="form-group">
                    <label for="email-input" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email-input" name="login" placeholder="Логин" value="<?=$login?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email-input" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email-input" name="email" placeholder="Email" value="<?=$email?>">
                    </div>
                </div>

                <div class="form-group password-group">
                    <label for="password-input" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password-input" name="password" placeholder="Пароль">
                    </div>
                </div>

                <div class="form-group password-group">
                    <label for="password-input" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password-input-check" name="password_check" placeholder="Повторите ввод пароля">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="allow_notifying" checked> Разрешить отправлять мне уведомления о новостях и продуктах
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Зарегистрироваться</button><br>
                        Уже есть аккаунт? <a href="/login">Войти.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery("#password-input-check").focusout( function () {
        if (jQuery(this).val() != jQuery("#password-input").val()) {
            jQuery(".password-group").addClass("has-error");
        } else {
            jQuery(".password-group").removeClass("has-error");
        }
    });
</script>