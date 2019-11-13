require('./bootstrap.js')
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueRouter from 'vue-router';
import ServicePlugin from './plugins/ServicePlugin.js';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(ServicePlugin);
Vue.use(ElementUI);

// import view
import LoginPage from './pages/Login.vue';
import SignUpPage from './pages/SignUp.vue';
import HomePage from './pages/Home.vue';
import PostPage from './pages/Posts.vue';
import UserPage from './pages/Users.vue';
// import HomePage from './components/Home.vue';
// import ScreenDashboard from './components/screens/Dashboard.vue';
// import ScreenCompany from './components/screens/Company.vue';
// import ScreenBussinessBase from './components/screens/BussinessBase.vue';
// import ScreenLicesence from './components/screens/Licesence.vue';

import Header from './components/Header.vue';
// import Country from './components/country/Country.vue';
// import AddCompany from './components/company/AddCompany.vue';
// import Organization from './components/organizations/Organization.vue';
// import BussinessBase from './components/bussinessbase/BussinessBase.vue';
// import AutocompleteInput from './components/organizations/AutocompleteInput.vue';
// import PermissionDeny from './components/abort/error.vue';

const routes = [
	{
        path: '/login',
        component: LoginPage,
    },
	{
        path: '/sign-up',
        component: SignUpPage,
    },

	{
        path: '/',
        component: HomePage,
        children: [
            {
                path: 'post',
                component: PostPage,
            },
            {
                path: 'users',
                component: UserPage,
            },
        ],
    },

    { path: '*', redirect: '/login' },

    // {
    //     path: '/permission-deny',
    //     component: PermissionDeny,
    // },
];

//import component
Vue.component('navbarHeader', Header);
// Vue.component('country', Country);
// Vue.component('addCompany', AddCompany);
// Vue.component('organization', Organization);
// Vue.component('bussinessbase', BussinessBase);
// Vue.component('autocompleteInput', AutocompleteInput);

window.router = new VueRouter({ routes })

router.beforeEach((to, from, next) => {
	const publicPages = ['/login', '/sign-up'];

	const authRequired = !publicPages.includes(to.path);

	const loggedIn = localStorage.token;

	if (authRequired && !loggedIn) {
		return next('/login');
	}

	if (publicPages.includes(to.path) && loggedIn) {
        return next('/post');
	}

	next();

})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router
}).$mount('#app');
