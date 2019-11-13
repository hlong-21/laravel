<template>
    <div id="login-page">
        <div class="login-form">
            <h2>Sign up</h2>

            <el-form :model="account" ref="form">
                <el-form-item label="Fullname :" prop="fullname"
                    :rules="[
                              { required: true, message: 'Please Enter fullname', trigger: 'blur' },
                            ]"
                >

                    <el-input type="fullname" v-model="account.fullname" @keyup.enter="validate"></el-input>
                </el-form-item>
                <el-form-item label="Email :" prop="email"
                    :rules="[
                              { required: true, message: 'Please Enter Email Address', trigger: 'blur' },
                              { type: 'email', message: 'Please Enter Correct Email Address', trigger: ['blur', 'change'] }
                            ]"
                >

                    <el-input type="email" v-model="account.email" @keyup.enter="validate"></el-input>
                </el-form-item>

                <el-form-item label="Password :" prop="password"
                    :rules="[
                              { required: true, message: 'Please Enter Password', trigger: 'blur' }
                            ]"
                >
                    <el-input type="password" v-model="account.password" @keyup.enter="validate('form')"></el-input>
                </el-form-item>

                <el-form-item label="Confirm" prop="checkPass"
                    :rules="[
                    ]"
                >
                    <el-input type="password" v-model="account.checkPass" autocomplete="off"></el-input>
                </el-form-item>

                <el-row>
                    <el-button type="danger" native-type="button" plain @click="validate('form')">Sign up</el-button>
                </el-row>
                <el-row>
                    <el-button type="danger" native-type="button" plain @click="goToLogin()">Login</el-button>
                </el-row>
            </el-form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                account: {
                    fullname: '',
                    email: '',
                    password: '',
                    checkPass: ''
                },
            }
        },
        methods: {
            validate(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.signUp();
                    }
                });
            },

            checkPassword(rule, value, callback) {
                console.log(rule, value)
                if (value === '') {
                    callback(new Error('Please input the password again'));
                } else if (value !== this.account.password) {
                    callback(new Error('Two inputs don\'t match!'));
                } else {
                    callback();
                }
            },

            signUp: async function () {
                let data = {
                    name: this.account.fullname,
                    email: this.account.email,
                    password: this.account.password,
                    c_password: this.account.checkPass,
                };

                let response = await this.$api.auth.signUp(data);

                if (response.success) {
                    localStorage.token = response.data.token;
                    localStorage.name =  response.data.name;
                    this.$notify.success({
                        title: 'Success',
                        message: 'Login Successfully',
                        duration: 2000,
                    });
                    this.$router.replace('/post');
                } else {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Email or Password incorrect',
                        duration: 2000,
                    });
                }
            },

            goToLogin() {
                this.$router.replace('/login');
            }
        },
        mounted() {
            var self = this;
            window.addEventListener('keyup', function(event) {
                if (event.keyCode === 13) {
                    self.validate('form');
                }
            });
        }
    }
</script>