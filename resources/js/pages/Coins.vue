<template>
  <v-data-table
    loading
    loading-text="Loading... Please wait"
    v-model="selected"
    :headers="headers"
    :items="coins"
    :single-select="singleSelect"
    item-key="name"
    show-select
    class="elevation-1"
  >
    <template v-slot:top>
      <v-switch
        v-model="singleSelect"
        label="Single select"
        class="pa-3"
      ></v-switch>
    </template>
  </v-data-table>
</template>


<script>
export default {
  name: "allCoins",
  data() {
    return {
      singleSelect: false,
      headers: [
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Id", value: "id" },
        { text: "Image", value: "image" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" },
      ],
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: "1%",
        },
      ],
      selected: [],
      coins: [],
      baseApiUrl: "http://localhost:8000/api/v1/balance",
    };
  },
  created() {
    this.getData(this.baseApiUrl);
  },
  methods: {
    getData(url) {
      if (url) {
        Axios.get(url).then((res) => {
          this.coins = res.data.coins;
        });
      }
      console.log(this.coins);
    },
  },
};
