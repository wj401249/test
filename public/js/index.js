const counter = {
    data() {
        return {
            message: 'test',
            activeIndex: "1",
            dialogFormVisible: false,
            formLabelWidth: '120px',
            form: {
                phone: '',
                email: '',
                nickname: '',
                password: '',
                confirm_pwd: '',
            }
        }
    },
    compilerOptions: {
        delimiters: ["{!", "!}"]
    },
    methods: {
        doRegister() {
            $.ajax({
                url: "User/store",
                type: "post",
                data: {"phone": this.form.phone, "email": this.form.email, "nickname": this.form.nickname, "password": this.form.password, "confirm_password": this.form.confirm_pwd},
                success: function (data) {
                    console.log('success');
                    console.log(data.code);
                    console.log(data.message);
                },
                error: function (e) {
                    console.log('fail');
                    console.log(e);
                    console.log(e.code);
                    console.log(e.message);
                }
            })
            this.dialogFormVisible = false;
        },
        doLogin() {
            $.ajax({
                url: "User/login",
                type: "post",
                data: {"phone": this.form.phone, "password": this.form.password},
                success: function (data) {
                    console.log('success');
                    console.log(data.code);
                    console.log(data.message);
                },
                error: function (e) {
                    console.log('fail');
                    console.log(e);
                    console.log(e.code);
                    console.log(e.message);
                }
            })
        }
    }
}

Vue.createApp(counter).use(ElementPlus).mount('#app');