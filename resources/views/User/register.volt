<!DOCTYPE html>
<html>
<head>
    <title>注册</title>
    {{ assets.outputCss('headers') }}
    {{ assets.outputJs('headers') }}
</head>
<body>
    <div class='container'>
        <form action="/User/register" method="post">
            <div class="row mt-5 justify-content-center">
                <label for="phone" class="col-1 col-form-label">手机号：</label>
                <div class="col-4"><input type="text" class="form-control" id="phone" name="phone" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="nickname" class="col-1 col-form-label">昵称：</label>
                <div class="col-4"><input type="text" class="form-control" id="nickname" name="nickname" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="email" class="col-1 col-form-label">邮箱：</label>
                <div class="col-4"><input type="text" class="form-control" id="email" name="email" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="password" class="col-1 col-form-label">密码：</label>
                <div class="col-4"><input type="text" class="form-control" id="password" name="password" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="password" class="col-1 col-form-label">确认密码：</label>
                <div class="col-4"><input type="text" class="form-control" id="confirm_password" name="confirm_password" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <div class="col-5 text-center"><button type="submit" name="sub" class="btn btn-primary mb-3">注册</button></div>
            </div>
            <div>{{ flashSession.output() }}</div>
        </form>
    </div>
</body>
</html>