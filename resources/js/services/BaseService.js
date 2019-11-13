export default class BaseService {
	async get(url, data) {
		let header = {};

		if (localStorage.token) {
			header.Authorization = 'Bearer ' + localStorage.token;
		}

		var pageLoad = {
			headers: header
		};

		if (data) {
            pageLoad.params = data;
		}

		let response = await axios.get(url, pageLoad);

		if (response.data.success) {
			return response.data;
		} else {
			if (response.data.error_code == 403) {
				localStorage.clear();
				router.replace('/login');
			}
		}

	};

	async post(url, data) {
		let header = {};

		if (localStorage.token) {
			header.Authorization = 'Bearer ' + localStorage.token;
		}
		let response = await axios.post(url, data, {headers: header});
		console.log(response);
		
		if (response.data.success) {
			return response.data;
		} else {
			if (response.data.error_code == 403) {
				localStorage.clear();
				router.replace('/login');
			}
		}
	};

	async delete(url) {
		let header = {};

		if (localStorage.token) {
			header.Authorization = 'Bearer ' + localStorage.token;
		}
		let response = await axios.delete(url, {headers: header});
		console.log(response);
		
		if (response.data.success) {
			return response.data;
		} else {
			if (response.data.error_code == 403) {
				localStorage.clear();
				router.replace('/login');
			}
		}
	};
}