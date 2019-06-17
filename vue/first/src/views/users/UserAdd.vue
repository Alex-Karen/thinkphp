<template>
  <div>
    <v-layout justify-center>
      <v-flex xs6>
        <v-card>
          <v-card-title class="elevation-1 title">添加用户</v-card-title>
          <v-card-text>
            <v-form>
              <v-text-field label="姓名" v-model="user.name"></v-text-field>
              <v-text-field label="年龄" v-model="user.age"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions></v-card-actions>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="add">添加</v-btn>
            <v-btn flat color="primary" to="/users">返回</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      user: {
        name: "",
        age: ""
      }
    };
  },
  methods: {
    add() {
      axios.post("http://localhost:3000/users", this.user).then(resp => {
        const { status, data } = resp;
        console.log(status);
        console.log(data);
        if (status == 201) {
          // alert("success");
          this.$router.push("/users");
        }
      });
    }
  }
};
</script>

<style scoped>
</style>