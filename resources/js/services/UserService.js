import BaseService from './BaseService';

export default class UserService extends BaseService {
	contructor() {

	}

	async getList() {
		return await this.get('/api/users');
	}

	async signUp(data) {
		return await this.post('/api/register', data);
	}

    async logout() {
        return await this.post('/api/logout');
    }
}