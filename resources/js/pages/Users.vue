<template>
	<div>
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
				prop="created_at"
				label="Date"
			>
			</el-table-column>

			<el-table-column
				fixed="right"
				label="Operations"
			>
				<template slot-scope="scope">
					<el-button @click="follow(scope.$index, tableData)" type="text" size="small" v-if="!tableData[scope.$index].user_id">Follow</el-button>
					<el-button @click="unfollow(scope.$index, tableData)" type="text" size="small" v-if="!!tableData[scope.$index].user_id">Unfollow</el-button>
				</template>
			</el-table-column>
		</el-table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				tableData: []
			}
		},

		created() {
			this.getList();
		},

		methods: {
			async getList() {
				let res = await this.$api.users.getList();

				this.tableData = res.data;
			},

			async follow(index, rows) {
				let data = {
					partner_id: rows[index].id
				}

				let res = await this.$api.follower.follow(data);

				if (res.success) {
					this.getList();
				}
			},

			async unfollow(index, rows) {
				let data = {
					partner_id: rows[index].id
				}

				let res = await this.$api.follower.unfollow(data);

				if (res.success) {
					this.getList();
				}
			}
		}
	}
</script>