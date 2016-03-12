
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8 page-heading">
            <h1>Войти в панель управления</h1>
            <div class="alert alert-warning" role="alert">Эта функция предназначена только для администратора сайта!</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form role="form" method="POST" action="/login" class="form-horizontal">
                <div class="form-group">
                    <label for="email-input" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email-input" name="login" placeholder="Логин (email)">
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