<!--<template>
  <div>我是UserList</div>
  <v-app>
	<v-btn color="success">Success</v-btn>
  </v-app>
</template> -->
<template>
  <v-app>
    <!-- 渲染一个表格 -->
    <!-- v-data-table
      headers属性 : 表头信息, 是一个数组
      items属性: 表格数据, 是一个数组
      hide-actions属性: 不显示分页信息
      class属性: 样式elevation-1(悬浮效果)
    -->
    <v-layout justify-center>
      <v-flex xs10>
        <v-toolbar dark color="primary">
          <v-toolbar-title>用户列表</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn flat to="/users/add" >添加用户</v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-data-table :headers="headers" :items="users" hide-actions class="elevation-1">
          <template slot="items" slot-scope="props">
            <td>{{props.item.id}}</td>
            <td>{{props.item.name}}</td>
            <td>{{props.item.age}}</td>
            <td>
              <v-icon small @click="edit(props.item.id)">edit</v-icon>
              <v-icon small @click="del(props.item.id)">delete</v-icon>
            </td>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </v-app>
</template>
    </v-data-table>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      headers: [
        {
          text: "id",
          sortable: true,
          value: "id"
        },
        {
          text: "姓名",
          value: "name"
        },
        {
          text: "年龄",
          value: "age"
        },
        {
          text: "操作",
          sortable: false
        }
      ], // 表头信息
      users: [
        {
          id: 1,
          name: "鸣人",
          age: "12"
        },
        {
          id: 2,
          name: "佐助",
          age: "100"
        },
        {
          id: "3",
          name: "test",
          age: "21"
        }
      ] // 表格数据
    };
  },
  methods: {
    getData() {
      axios.get("http://localhost:3000/users").then(resp => {
        console.log(resp);
        const { status, data } = resp;
        if (status == 200) {
          this.users = data;
        }
      });
    },
    edit(id) {
      this.$router.push('/users/edit/'+id)
    },
    del(id) {
      if (confirm('确认删除?')) {
        axios.delete('http://localhost:3000/users/'+id).then(resp => {
            const {status, data} = resp
            if (status == 200) {
                alert('删除成功')
                this.$router.push('/users')
            }
        })
    }
    }
  },
  created() {
    this.getData();
  }

  // data() {
  //   return {
  //     dialog: false,
  //     items: [
  //       {
  //         icon: "folder",
  //         iconClass: "grey lighten-1 white--text",
  //         title: "Photos",
  //         subtitle: "Jan 9, 2014"
  //       },
  //       {
  //         icon: "folder",
  //         iconClass: "grey lighten-1 white--text",
  //         title: "Recipes",
  //         subtitle: "Jan 17, 2014"
  //       },
  //       {
  //         icon: "folder",
  //         iconClass: "grey lighten-1 white--text",
  //         title: "Work",
  //         subtitle: "Jan 28, 2014"
  //       }
  //     ],
  //     items2: [
  //       {
  //         icon: "assignment",
  //         iconClass: "blue white--text",
  //         title: "Vacation itinerary",
  //         subtitle: "Jan 20, 2014"
  //       },
  //       {
  //         icon: "call_to_action",
  //         iconClass: "amber white--text",
  //         title: "Kitchen remodel",
  //         subtitle: "Jan 10, 2014"
  //       }
  //     ]
  //   };
  // }
};
</script>

<style>
</style>