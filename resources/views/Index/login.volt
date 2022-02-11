<!DOCTYPE html>
<html>
<head>
    <title>登录</title>
    {{ assets.outputCss('headers') }}
    {{ assets.outputJs('headers') }}
</head>
<body>
    <div class='container'>
        <form action="/User/login" method="post">
            <div class="row mt-5 justify-content-center">
                <label for="phone" class="col-1 col-form-label">手机号：</label>
                <div class="col-4"><input type="text" class="form-control" id="phone" name="phone" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="password" class="col-1 col-form-label">密码：</label>
                <div class="col-4"><input type="password" class="form-control" id="password" name="password" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <div class="col-5 text-center"><button type="submit" name="sub" class="btn btn-primary mb-3">登录</button></div>
            </div>
            <div class="row justify-content-center mt-2">
                {{ flashSession.output() }}
            </div>
        </form>
    </div>
</body>
</html>