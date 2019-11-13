<template>
    <el-menu :default-active="activeMenu" class="el-menu-demo" mode="horizontal" @select="handleSelect" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
        <template v-for="item in menu">
            <el-menu-item :index="item.path" v-if="item.submenu.length == 0">{{ item.title }}</el-menu-item>
            <el-submenu :index="item.path" v-if="item.submenu.length != 0">
                <template slot="title">{{ item.title }}</template>
                <template v-for="sub in item.submenu">
                    <el-menu-item :index="sub.path">{{ sub.title }}</el-menu-item>
                </template>
            </el-submenu>
        </template>

        <el-submenu index="" class="menu-bar-right">
            <template slot="title">{{ username }}</template>
            <el-menu-item index="">My profile</el-menu-item>
            <el-menu-item index="" @click="logout()">Logout</el-menu-item>
        </el-submenu>
    </el-menu>
</template>

<script>
    export default {
        data() {
            return {
                activeMenu: 'dashboard',
                menu: [
                    {
                        path: '/posts',
                        title: 'Posts',
                        submenu: []
                    },
                    {
                        path: '/users',
                        title: 'Users',
                        submenu: []
                    },
                ],
                username: ''
            };
        },

        created() {
            this.username = localStorage.name;
        },

        methods: {
            handleSelect(key, keyPath) {
                this.$router.replace(key);
            },

            logout: async function () {
                localStorage.clear();
                this.$notify.success({
                    title: 'Success',
                    message: 'Logout Successfully',
                    duration: 2000,
                });
                this.$router.replace('/login');
                // let response = await this.$api.auth.logout();
                // if (response.status) {
                //     localStorage.clear();
                //     this.$notify.success({
                //         title: 'Success',
                //         message: 'Logout Successfully',
                //         duration: 2000,
                //     });
                //     this.$router.replace('/login');
                // }
            }

        }
    }
</script>