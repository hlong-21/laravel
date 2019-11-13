import BaseService from './BaseService';

export default class FollowerService extends BaseService {
	contructor() {

	}

	async follow(data) {
		return await this.post('/api/follow', data);
	}

	async unfollow(data) {
		return await this.post('/api/unfollow', data);
	}
}