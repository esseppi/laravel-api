<template>
  <!-- App.vue -->

  <v-app>
    <v-navigation-drawer app>
      <Drawer />
    </v-navigation-drawer>
    <v-app-bar color="deep-purple accent-4" dense dark app>
      <HeaderApp />
    </v-app-bar>

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