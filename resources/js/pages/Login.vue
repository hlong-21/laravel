<template>
    <div id="login-page">
        <div class="login-form">
            <h2>Login</h2>

            <el-form :model="account" ref="form">
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
                <el-row>
                    <el-button type="danger" native-type="button" plain @click="validate('form')">Login</el-button>
                </el-row>
                <el-row>
                    <el-button type="danger" native-type="button" plain @click="goToSignUp">Sign up</el-button>
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
                    email: '',
                    password: '',
                },
            }
        },
        methods: {
            validate(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.login();
                    }
                });
            },

            login: async function () {
                let data = {
                    email: this.account.email,
                    password: this.account.password,
                };

                let response = await this.$api.auth.login(data);

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

            goToSignUp: async function () {
                this.$router.replace('/sign-up');
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