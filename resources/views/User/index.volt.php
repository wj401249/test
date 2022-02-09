<!DOCTYPE html>
<html>
<head>
    <title>用户信息</title>
    <?= $this->assets->outputCss('headers') ?>
    <?= $this->assets->outputJs('headers') ?>
</head>
<body>
    <div class='container'>
            <div class="row mt-5 justify-content-center">
                <label for="phone" class="col-1 col-form-label">手机号：</label>
                <div class="col-4"><input type="text" class="form-control" id="phone" name="phone" readonly /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="nickname" class="col-1 col-form-label">昵称：</label>
                <div class="col-4"><input type="text" class="form-control" id="nickname" name="nickname" readonly /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <label for="email" class="col-1 col-form-label">邮箱：</label>
                <div class="col-4"><input type="text" class="form-control" id="email" name="email" readonly /></div>
            </div>
            <div class="row justify-content-center mt-1">
                <div class="col-5 text-center"><a href="User/edit" class="btn btn-primary mb-3">修改</a></div>
            </div>
    </div>
</body>
</html>