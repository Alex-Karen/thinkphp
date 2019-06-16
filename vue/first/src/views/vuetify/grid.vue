<template>
  <v-container grid-list-xl text-xs-center>
    <v-layout>
      <v-flex xs3 sm6 md9>
        <v-card color="red">第一行</v-card>
      </v-flex>
      <v-flex xs9 sm6 md3>
        <v-card color="blue">第一行第二列</v-card>
      </v-flex>
    </v-layout>
    <v-layout wrap justify-center>
      <v-flex xs3>
        <v-card>第二行</v-card>
      </v-flex>
      <v-flex xs10>
        <v-card>第二行第二列</v-card>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs2 offset-xs10>
        <v-card color="orange">成功</v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {};
</script>

<style scoped>
</style>