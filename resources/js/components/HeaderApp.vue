<template>
  <v-app-bar color="deep-purple accent-4" dense dark>
    <v-app-bar-nav-icon></v-app-bar-nav-icon>

    <v-toolbar-title>Page title</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon>
      <v-icon>mdi-heart</v-icon>
    </v-btn>

    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

    <v-menu left bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon v-bind="attrs" v-on="on">
          <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item v-for="n in 5" :key="n" @click="() => {}">
          <v-list-item-title>Option {{ n }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>


<script>
export default {
  name: "HeaderApp",
  data() {
    return {
      drawer: false,
      group: null,
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
