<div class="row">
    <div class="col-xs-2">
        <form action="/web/login" method="post">
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" name="login" class="form-control" id="login">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="text" name="password" class="form-control" id="password ">
            </div>
            <input type="hidden" name="get" value="authorization" class="form-control" id="authorization">
            <div class="form-group">
                <button class="form-control btn btn-default">Войти</button>
            </div>
        </form>
    </div>
    <div class="col-xs-10"></div>
</div>
