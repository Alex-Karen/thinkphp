<template>
  <div>
    <v-layout justify-center>
      <v-flex xs6>
        <v-card>
          <v-card-title class="elevation-1 title">修改用户</v-card-title>
          <v-card-text>
            <v-form>
              <v-text-field label="姓名" v-model="user.name"></v-text-field>
              <v-text-field label="年龄" v-model="user.age"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions></v-card-actions>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="edit">修改</v-btn>
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
      user: "",
      age: ""
    };
  },
  methods: {
    edit() {
      axios.put("http://localhost:3000/users/" + this.id, this.user).then(resp => {
          const { status, data } = resp;
          if (status == 200) {
            // alert("修改成功");
            this.$router.push("/users");
          }
        });
    }
  },
  created() {
    this.id = this.$route.params.id;
    axios.get("http://localhost:3000/users/" + this.id).then(resp => {
      const { status, data } = resp;
      if (status == 200) {
        this.user = data;
      }
    });
  }
};
</script>

<style scoped>
</style>