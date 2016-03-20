
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8 page-heading">
            <h1>Войти на сайт</h1>
            <?php if ($error) echo "<div class=\"alert alert-danger\" role=\"alert\">Логин или пароль неверны!</div>"; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form role="form" method="POST" action="/login" class="form-horizontal">
                <div class="form-group">
                    <label for="email-input" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email-input" name="login" placeholder="Логин">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-input" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password-input" name="password" placeholder="Пароль">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Запомнить меня
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Войти</button><br>
                        Еще нет аккаунта? <a href="/register">Зарегистрироваться.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>