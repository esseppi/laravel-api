<template>
  <!-- App.vue -->

  <v-app>
    <Drawer />
    <HeaderApp />

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <!-- If using vue-router -->
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import HeaderApp from "../components/HeaderApp.vue";
import Drawer from "../components/Drawer.vue";

export default {
  name: "App",
  components: {
    HeaderApp,
    Drawer,
  },
};
</script>

<style>
</style>