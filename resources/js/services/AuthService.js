import BaseService from './BaseService';

export default class AuthService extends BaseService {
	contructor() {

	}

	async login(data) {
		return await this.post('/api/login', data);
	}

	async signUp(data) {
		return await this.post('/api/register', data);
	}

    async logout() {
        return await this.post('/api/logout');
    }
}