<template>
  <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent>
    <v-list-item class="px-2">
      <v-list-item-avatar>
        <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
      </v-list-item-avatar>

      <v-list-item-title>John Leider</v-list-item-title>

      <v-btn icon @click.stop="mini = !mini">
        <v-icon>mdi-chevron-left</v-icon>
      </v-btn>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense>
      <v-list-item v-for="item in items" :key="item.title" link>
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "Drawer",
  data() {
    return {
      items: [
        { title: "Home", icon: "mdi-home-city" },
        { title: "My Account", icon: "mdi-account" },
        { title: "Users", icon: "mdi-account-group-outline" },
      ],
    };
  },
  created() {},
  methods: {},
};

// <script>
//   export default {
//     data () {
//       return {
//         singleSelect: false,
//         selected: [],
//         headers: [
//           {
//             text: 'Dessert (100g serving)',
//             align: 'start',
//             sortable: false,
//             value: 'name',
//           },
//           { text: 'Calories', value: 'calories' },
//           { text: 'Fat (g)', value: 'fat' },
//           { text: 'Carbs (g)', value: 'carbs' },
//           { text: 'Protein (g)', value: 'protein' },
//           { text: 'Iron (%)', value: 'iron' },
//         ],
//         desserts: [
//           {
//             name: 'Frozen Yogurt',
//             calories: 159,
//             fat: 6.0,
//             carbs: 24,
//             protein: 4.0,
//             iron: '1%',
//           },

//         ],
//       }
//     },
//   }
//
</script>
