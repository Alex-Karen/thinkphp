<template>
  <div>
    <v-card-title>
      <v-btn color="primary" @click="addBrand">新增</v-btn>
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
          <img v-if="props.item.image" :src="props.item.image" width="100" />
          <span v-else>没有图片</span>
        </td>
        <td class="text-xs-center">{{ props.item.letter }}</td>
        <td class="justify-center layout">
          <v-btn color="info" @click="editBrand(props.item)">编辑</v-btn>
          <v-btn color="warning">删除</v-btn>
        </td>
      </template>
    </v-data-table>
    <v-dialog max-width="500" v-model="show" persistent>
      <v-card>
        <!--对话框的标题-->
        <v-toolbar dense dark color="primary">
          <v-toolbar-title>新增品牌</v-toolbar-title>
          <v-spacer />
          <!--关闭窗口的按钮-->
          <v-btn icon @click="show=false">
            <v-icon>close</v-icon>
          </v-btn>
        </v-toolbar>
        <!--对话框的内容，表单-->
        <v-card-text class="px-5">
          <BrandForm @close="closeWindow" :oldBrand="oldBrand"></BrandForm>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import BrandForm from "./BrandForm.vue";
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
      loading: true, // 是否在加载中
      show: false,
      oldBrand: {},
      isEdit: false // 是否是修改状态
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
    },
    closeWindow() {
      // 关闭窗口
      this.show = false;
      // 重新加载数据
      this.getDataFromServer();
    },
    editBrand(old) {
      this.isEdit = true;
      this.$http.get("/item/brand/cates/" + old.id).then(resp => {
        // 1. 显示窗口
        this.show = true;
        this.oldBrand = old;
        this.oldBrand.categories = resp.data;
      });
    },
    addBrand() {
      this.isEdit = false;
      this.show = true;
      this.oldBrand = null;
    }
  },
  mounted() {
    this.getDataFromServer();
  },
  watch: {
    pagination: {
      // 监视pagination属性的变化
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
  },
  components: {
    BrandForm
  }
};
</script>

<style scoped>
</style>