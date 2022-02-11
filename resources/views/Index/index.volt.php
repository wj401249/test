<!DOCTYPE html>
<html>
<head>
    <title><?= $phone ?></title>
    <?= $this->assets->outputCss('headerJs') ?>

</head>
<body>
    <div id="app">
        <el-container>
            <el-container>
                <el-header>
                    <el-row>
                        <el-col :span=20>
                            <el-menu mode="horizontal" :default-active="activeIndex" @select="handleSelect">
                                <el-menu-item index="1">首页</el-menu-item>
                                <el-sub-menu index="2">
                                    <template #title>导航1</template>
                                    <el-menu-item index="2-1">下拉1</el-menu-item>
                                    <el-menu-item index="2-2">下拉1</el-menu-item>
                                </el-sub-menu>
                            </el-menu>
                        </el-col>
                        <el-col :span=4>
                            <?php if (isset($user)) { ?>
                            <el-button :icon="Search" @click="dialogFormVisible = true"><?= $user->phone ?></el-button>
                            <?php } else { ?>
                            <el-button :icon="Search" @click="dialogFormVisible = true">注册</el-button>
                            <?php } ?>
                        </el-col>
                    </el-row>
                </el-header>
            </el-container>
        <el-main>Main</el-main>
        <el-footer>footer</el-footer>
        </el-container>

        <el-dialog v-model="dialogFormVisible">
            <el-tabs>
                <el-tab-pane label="登录">
                    <el-form :model="form">
                        <el-form-item label="手机号">
                            <el-input v-model="form.phone"></el-input>
                        </el-form-item>
                        <el-form-item label="密码">
                            <el-input v-model="form.password" type="password"></el-input>
                        </el-form-item>
                    </el-form>
                    <span class="dialog-footer">
                        <el-button @click="dialogFormVisible = false">取消</el-button>
                        <el-button type="primary" @click="doLogin">登录</el-button>
                    </span>
                </el-tab-pane>
                <el-tab-pane label="注册">
                    <el-form :model="form">
                      <el-form-item label="密码">
                        <el-input v-model="form.password" type="password"></el-input>
                      </el-form-item>
                      <el-form-item label="确认密码">
                        <el-input v-model="form.confirm_pwd" type="password"></el-input>
                      </el-form-item>
                      <el-form-item label="手机号">
                        <el-input v-model="form.phone" autocomplete="off"></el-input>
                      </el-form-item>
                      <el-form-item label="邮箱">
                        <el-input v-model="form.email"></el-input>
                      </el-form-item>
                      <el-form-item label="昵称">
                        <el-input v-model="form.nickname" autocomplete="off"></el-input>
                      </el-form-item>
                    </el-form>
                    <span class="dialog-footer">
                        <el-button @click="dialogFormVisible = false">取消</el-button>
                        <el-button type="primary" @click="doRegister">注册</el-button>
                    </span>
                </el-tab-pane>
            </el-tabs>
        </el-dialog>
    </div>
</body>
</html>
<?= $this->assets->outputJs() ?>
<?= $this->assets->outputJs('headerJs') ?>
