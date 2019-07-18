<template>
  <div>
    <v-stepper v-model="step">
      <v-stepper-header>
        <v-stepper-step :complete="step > 1" step="1">基本信息</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="step > 2" step="2">商品描述</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="step > 3" step="3">规格参数</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step  step="4">sku属性</v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content step="1">
           <v-cascader 
            url="/item/category/list" 
            required
            showAllLevels    
            v-model="goods.categories" 
            label="请选择商品分类"
          />
          <v-select
                :items="brandOptions"
                item-text="name"
                item-value="id"
                label="所属品牌"
                v-model="goods.brand_id"
                required
                autocomplete
                clearable
                dense chips
          />
          <v-text-field label="商品标题" v-model="goods.title" :counter="200" required></v-text-field>
          <v-text-field label="商品卖点" v-model="goods.sub_title" :counter="200"></v-text-field>
          <v-text-field label="包装清单" v-model="spu_detail.packing_list" :counter="1000" multi-line :rows="3"/>
          <v-text-field label="售后服务" v-model="spu_detail.after_service" :counter="1000" multi-line :rows="3"/>
        </v-stepper-content>
        <v-stepper-content step="2">
          <v-editor v-model="spu_detail.description" upload-url="/upload/image" fileName="file"/>
        </v-stepper-content>
        <v-stepper-content step="3">
          <v-flex class="xs10 mx-auto px-3">
            <v-card v-for="spec in specifications" :key="spec.group" class="my-2">
              <v-card-title class="subheading">{{spec.group}}</v-card-title>
              <v-card-text v-for="param in spec.params" :key="param.k">
                <v-text-field 
                  v-if="param.options.length <= 0" 
                  :label="param.k" 
                  :suffix="param.unit || ''"
                  v-model="param.v"></v-text-field>
                <v-select 
                  v-else 
                  :label="param.k" 
                  :items="param.options"
                  v-model="param.v"></v-select>
              </v-card-text>
            </v-card>
          </v-flex>
          
        </v-stepper-content>
        <v-stepper-content step="4">sku属性</v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        goods: {
          categories: [], // 分类信息
          brand_id: 0, // 品牌id
          title: '', // 标题
          sub_title: '', //卖点
        },
        spu_detail: {
          description: '',
          packing_list: '',
          after_service: ''
        },
        brandOptions: [], // 可选的品牌的选项
        specifications: [], // 规格参数模板
        sku: {
          image: '',
          price: '',
          stock: '',
          own_spec: {}
        }
      }
    },
    props: {
      step: {
        type: Number,
        default: 1
      }
    },
    watch: {
      'goods.categories': {
        deep: true,
        handler() {
          // 根据最后一级分类的cid, 得到该分类下的品牌信息
          this.$http.get('/item/cate_brand/'+this.goods.categories[2].id).then(resp => {
            // 解构resp
            const {status, data} = resp
            
            if (status == 200) {
              // 给brandOptions赋值
              this.brandOptions = data
            }
          })

          // 根据最后一级分类的cid, 得到对应的模板信息
          this.$http.get('/item/spec/' + this.goods.categories[2].id).then(resp => {
            const {status, data} = resp

            if (status == 200) {
              this.specifications = data
            }
          })
        }
      }
    }
  }
</script>

<style scoped>

</style>