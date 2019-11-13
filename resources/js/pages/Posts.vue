<template>
	<div>
		<el-input
			type="textarea"
			:rows="2"
			placeholder="Please input"
			v-model="post_content">
		</el-input>

		<el-button type="danger" native-type="button" plain @click="save()">post</el-button>

		<el-table
			:data="tableData"
			style="width: 100%"
		>
			<el-table-column
				fixed
				prop="name"
				label="Name"
			>
			</el-table-column>

			<el-table-column
				prop="email"
				label="Mail"
			>
			</el-table-column>

			<el-table-column
				prop="content"
				label="Content"
			>
			</el-table-column>

			<el-table-column
				prop="date"
				label="Date"
			>
			</el-table-column>

			<el-table-column
				fixed="right"
				label="Operations"
			>
				<template slot-scope="scope">
					<el-button @click="deletePost(scope.$index, tableData)" type="text" size="small" v-if="tableData[scope.$index].is_delete">Delete</el-button>
				</template>
			</el-table-column>
		</el-table>
	</div>
</template>


<script>
	export default {
		data() {
			return {
				post_content: '',
				tableData: []
			}
		},

		created() {
			this.getList();
		},

		methods: {
			async getList() {
				let res = await this.$api.posts.getPost();

				this.tableData = res.data;
			},

			async save() {
				let data = {
					content: this.post_content
				}

				let response = await this.$api.posts.save(data);

				// post success
				if (response.success) {
					this.post_content = '';
					this.getList();
				}
			},

			async deletePost(index, rows) {
				let response = await this.$api.posts.deletePost(rows[index].id);

				if (response.success) {
					this.post_content = '';
					this.getList();
				}
			}
		}
	}
</script>