<template>
  <div>
    <v-card-title>
      <v-btn color="primary">新增</v-btn>
      <v-spacer />
      <v-text-field label="请输入关键字搜索" v-model="search" append-icon="search" hide-details></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="brands"
      :search="search"
      :pagination.sync="pagination"
      :total-items="totalBrands"
      :loading="loading"
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td class="text-xs-center">{{ props.item.id }}</td>
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="text-xs-center">
          <img v-if="props.item.image" :src="props.item.image" width="100">
          <span v-else>没有图片</span>
        </td>
        <td class="text-xs-center">{{ props.item.letter }}</td>
        <td class="justify-center layout">
          <v-btn color="info">编辑</v-btn>
          <v-btn color="warning">删除</v-btn>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        { text: "id", align: "center", value: "id" },
        { text: "名称", align: "center", sortable: false, value: "name" },
        { text: "LOGO", align: "center", sortable: false, value: "image" },
        { text: "首字母", align: "center", sortable: true, value: "letter" },
        { text: "操作", align: "center", sortable: false }
      ], // 头信息
      brands: [], // 当前页品牌数据
      search: "", // 搜索过滤字段
      pagination: {}, // 分页信息
      totalBrands: 0, // 总条数
      loading: true // 是否在加载中
    };
  },
  methods: {
    // 从服务器加载数据
    getDataFromServer() {
      this.$http
        .get("/item/brand/page", {
          params: {
            key: this.search, // 搜索条件
            page: this.pagination.page, // 当前页
            rows: this.pagination.rowsPerPage, // 每页大小
            sortBy: this.pagination.sortBy, // 排序字段
            desc: this.pagination.descending // 是否降序
          }
        })
        .then(resp => {
          console.log(resp);
          // 将得到的数据赋值给本地属性
          this.brands = resp.data.items;
          this.totalBrands = resp.data.total;
          // 完成赋值后，把加载状态赋值为false
          this.loading = false;
        });
      // // 模拟一些数据
      // const brands = [
      //   {
      //     id: 2032,
      //     name: "OPPO",
      //     image:
      //       "http://img10.360buyimg.com/popshop/jfs/t2119/133/2264148064/4303/b8ab3755/56b2f385N8e4eb051.jpg",
      //     letter: "O"
      //   },
      //   {
      //     id: 2033,
      //     name: "飞利浦（PHILIPS）",
      //     image:
      //       "http://img12.360buyimg.com/popshop/jfs/t18361/122/1318410299/1870/36fe70c9/5ac43a4dNa44a0ce0.jpg",
      //     letter: "F"
      //   },
      //   {
      //     id: 2034,
      //     name: "华为（HUAWEI）",
      //     image:
      //       "http://img10.360buyimg.com/popshop/jfs/t5662/36/8888655583/7806/1c629c01/598033b4Nd6055897.jpg",
      //     letter: "H"
      //   },
      //   {
      //     id: 2036,
      //     name: "酷派（Coolpad）",
      //     image:
      //       "http://img10.360buyimg.com/popshop/jfs/t2521/347/883897149/3732/91c917ec/5670cf96Ncffa2ae6.jpg",
      //     letter: "K"
      //   },
      //   {
      //     id: 2037,
      //     name: "魅族（MEIZU）",
      //     image:
      //       "http://img13.360buyimg.com/popshop/jfs/t3511/131/31887105/4943/48f83fa9/57fdf4b8N6e95624d.jpg",
      //     letter: "M"
      //   }
      // ];
      // // 模拟延迟一段时间，随后进行赋值
      // setTimeout(() => {
      //   this.brands = brands;
      //   this.totalBrands = brands.length;
      //   this.loading = false;
      // }, 400);
    }
  },
  mounted() {
    this.getDataFromServer();
  },
  watch: {
    pagination: { // 监视pagination属性的变化
      deep: true, // deep为true，会监视pagination的属性及属性中的对象属性变化
      handler() {
        // 变化后的回调函数，这里我们再次调用getDataFromServer即可
        this.getDataFromServer();
      }
    },
    search: {
      handler() {
        this.getDataFromServer();
      }
    }
  }
};
</script>

<style scoped>
</style>