import AuthService from '../services/AuthService';
import PostService from '../services/PostService';
import UserService from '../services/UserService';
import FollowerService from '../services/FollowerService';

export default {
    install(Vue, options) {
        Vue.prototype.$api = {
            auth: new AuthService,
            posts: new PostService,
            users: new UserService,
            follower: new FollowerService,
        };
    }
}