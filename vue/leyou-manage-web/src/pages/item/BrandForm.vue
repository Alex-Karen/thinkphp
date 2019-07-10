<template>
  <div>
    <v-form v-model="valid" ref="myBrandForm">
      <v-text-field v-model="brand.name" label="请输入品牌名称" required :rules="nameRules"></v-text-field>
      <v-text-field v-model="brand.letter" label="请输入品牌首字母" required :rules="letterRules"></v-text-field>
      <v-cascader
        url="/item/category/list"
        multiple
        required
        v-model="brand.categories"
        label="请选择商品分类"
      />
      <v-layout row>
        <v-flex xs3>
          <span class="subheading">品牌LOGO:</span>
        </v-flex>
        <v-flex>
          <v-upload
            v-model="brand.image"
            url="/upload"
            :multiple="false"
            :pic-width="250"
            :pic-height="90"
          />
        </v-flex>
      </v-layout>
      <v-layout class="my-4" row>
        <v-spacer />
        <v-btn @click="submit" color="primary">提交</v-btn>
        <v-btn @click="clear">重置</v-btn>
      </v-layout>
    </v-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      valid: false,
      brand: {
        name: "",
        letter: "",
        image: "",
        categories: []
      },
      nameRules: [
        v => !!v || "品牌名称不能为空",
        v => v.length > 1 || "品牌名称至少2位"
      ],
      letterRules: [
        v => !!v || "首字母不能为空",
        v => /^[A-Z]$/.test(v) || "品牌字母只能是一个A~Z的大写字母"
      ]
    };
  },
  props: {
    oldBrand: {
      type: Object
    },
    isEdit: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    submit() {
      // 1.表单验证
      if (this.$refs.myBrandForm.validate()) {
        // 2.解构brand数组, 提取出categories, 剩下的放到params对象中
        const { categories, ...params } = this.brand;
        // 3.只保留id, 并使用,连接
        params.cids = categories.map(c => c.id).join(",");

        // 发送数据给后台
        this.$http.post("/item/brand", params).then(resp => {
          const { status, data } = resp;

          if (status == 201) {
            this.$emit("close");
            this.$message.success("添加成功");
          } else {
            this.$message.error("添加失败");
          }
        });
      }
    },
    clear() {
      this.$refs.myBrandForm.reset();
      this.brand.categories = [];
    }
  },
  watch: {
      oldBrand: {
        deep: true,
        handler(val) {
          if (val) {
            // 修改操作
            this.brand = Object.deepCopy(val)
          }else {
            // 新增操作
            this.brand = {
              name: '',
              image: '',
              letter: '',
              categories: []
            }
          }
        }
      }
    }
};
</script>

<style scoped>
</style>