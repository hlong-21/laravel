import BaseService from './BaseService';

export default class PostService extends BaseService {
	contructor() {

	}

	async save(data) {
		return await this.post('/api/posts', data);
	}

	async getPost() {
		return await this.get('/api/posts');
	}

	async deletePost(id) {
		return await this.delete('/api/posts/' + id);
	}
}