<!DOCTYPE html>
<html>
<head>
    <title>用户信息</title>
    <?= $this->assets->outputCss('headers') ?>
    <?= $this->assets->outputJs('headers') ?>
</head>
<body>
    <div class='container'>
        <form action="/User/update" method="post">
            <div class="row mt-5 justify-content-center">
                <label for="phone" class="col-1 col-form-label">手机号：</label>
                <div class="col-4"><input type="text" class="form-control" id="phone" name="phone" value="<?= $user->phone ?>" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="nickname" class="col-1 col-form-label">昵称：</label>
                <div class="col-4"><input type="text" class="form-control" id="nickname" name="nickname" value="<?= $user->nickname ?>" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="email" class="col-1 col-form-label">邮箱：</label>
                <div class="col-4"><input type="text" class="form-control" id="email" name="email" value="<?= $user->email ?>" /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <div class="col-1 text-center"><button type="submit" class="btn btn-primary mb-3">修改</button></div>
                <div class="col-1 text-center"><a href="/User/logout" class="btn btn-outline-primary">登出</a></div>
            </div>
        </form>
    </div>
</body>
</html>