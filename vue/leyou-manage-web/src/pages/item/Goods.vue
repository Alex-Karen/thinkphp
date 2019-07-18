<template>
  <div>
    <v-card>
      <!-- 卡片的头部 -->
      <v-card-title>
        <v-btn color="primary" @click="addGoods">新增商品</v-btn>
        <v-spacer></v-spacer>
        <v-flex xs3>
          状态：
          <v-btn-toggle v-model="filter.saleable">
            <v-btn flat >全部</v-btn>
            <v-btn flat :value="true">上架</v-btn>
            <v-btn flat :value="false">下架</v-btn>
          </v-btn-toggle>
        </v-flex>
        
        <v-text-field 
          label="请输入关键字搜索" 
          v-model="filter.search" 
          append-icon="search"
          hide-details
          @keyup.enter="find">
        </v-text-field>
      </v-card-title>
      <!-- 分割线 -->
      <v-divider/>
      <v-data-table
        :headers="headers"
        :items="goodsList"
        :pagination.sync="pagination"
        :total-items="totalGoods"
        :loading="loading"
        class="elevation-1"
      >
        <template slot="items" slot-scope="props">
          <td>{{ props.item.id }}</td>
          <td class="text-xs-center">{{ props.item.title }}</td>
          <td class="text-xs-center">
            {{props.item.cname}}
          </td>
          <td class="text-xs-center">{{ props.item.bname }}</td>
          <td class="layout justify-center">
            <v-btn flat icon color="info" @click="editGoods(props.item)"><v-icon>edit</v-icon></v-btn>
            <v-btn flat icon color="warning"><v-icon>delete</v-icon></v-btn>
            <v-btn icon>下架</v-btn>
          </td>
        </template>
      </v-data-table>
    </v-card>
    <v-dialog max-width="800" v-model="show" persistent scrollable>
      <v-card>
        <v-toolbar dense dark color="primary">
          <v-toolbar-title>{{isEdit ? '修改': '新增'}}商品</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon @click="show=false"><v-icon>close</v-icon></v-btn>
        </v-toolbar>
        <v-card-text class="px-5" style="height: 600px">
          <GoodsForm :step="step"></GoodsForm>
        </v-card-text>
        <v-card-actions class="elevation-10">
          <v-spacer></v-spacer>
          <v-btn @click="prev" color="primary" :disabled="step === 1">上一步</v-btn>
          <v-btn @click="next" color="primary" :disabled="step === 4">下一步</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
  
</template>


<script>
  // 导入品牌表单组件
  import GoodsForm from './GoodsForm.vue'

  export default {
    data() {
      return {
        headers: [
          // text: 文本信息 value: 字段名 sortable: 是否允许排序, 
          {text: 'id', value: 'id', align: 'center'},
          {text: '标题', value: 'title', align: 'center'},
          {text: '商品分类', value: 'cname', align: 'center'},
          {text: '品牌', value: 'bname', align: 'center'},
          {text: '操作', sortable: false, align: 'center'}
        ],
        goodsList: [], // 数据
        filter: {
          search: '', //搜索的关键字
          saleable: true
        }, 
        pagination: {}, // 分页排序信息
        totalGoods: 0, // 总记录数
        loading: true, // 显示进度条
        show: false, // 是否显示对话框
        oldGoods: {}, // 保存旧的品牌数据
        isEdit: false, // 是否是修改状态
        step: 1, // 步骤
      }
    },
    methods: {
      getDataFromServer() {
        //1. axios.get('url').then(回调函数)
        //2. axios.get('url', {请求参数}).then(回调函数)
        this.$http.get('/item/spu/page', {
            params:{
              key: this.filter.search, // 搜索条件
              saleable: this.filter.saleable, // 上下架
              page: this.pagination.page,// 当前页
              rows: this.pagination.rowsPerPage,// 每页大小
          }
        }).then(resp => {
          console.log(resp)
          //const {status, data} = resp
          this.goodsList = resp.data.items
          this.totalGoods = resp.data.total
          this.loading = false
        })
      },
      find() {
        this.getDataFromServer()
      },
      closeWindow() {
        // 1. 关闭窗口
        this.show = false
        // 2. 重新获取数据
        this.getDataFromServer()
      },
      editGoods(old) {
        this.isEdit = true
        this.$http.get('/item/brand/cates/'+old.id).then(resp => {
          // 1. 显示窗口
         this.show = true
         this.oldGoods = old
         this.oldGoods.categories = resp.data
        })
      },
      addGoods() {
        this.isEdit = false
        this.show = true
        this.oldGoods = null
      },
      prev() {
        if (this.step > 1) this.step--
      },
      next() {
        if (this.step < 4) this.step++
      }
    },
    mounted() {
      // 查询数据
      this.getDataFromServer()
    },
    watch: {
      pagination: {
        deep: true,
        handler() {
          this.getDataFromServer()
        }
      },
      filter: {
        deep: true,
        handler() {
          this.getDataFromServer()
        }
      }
    },
    components: {
      //组件名: 组件对象
      GoodsForm
    }
  }
</script>


<style scoped>

</style>