<template>
  <v-card>
    <v-card-title>
      Nutrition
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      loading
      loading-text="Loading... Please wait"
      :search="search"
      v-model="selected"
      :headers="headers"
      :items="coins"
      :items-per-page="10"
      item-key="name"
      :single-select="singleSelect"
      show-select
      :footer-props="{
        showFirstLastPage: true,
        firstIcon: 'mdi-arrow-collapse-left',
        lastIcon: 'mdi-arrow-collapse-right',
        prevIcon: 'mdi-minus',
        nextIcon: 'mdi-plus',
      }"
      class="elevation-1"
    >
      <template v-slot:bottom>
        <v-switch
          v-model="singleSelect"
          label="Single select"
          class="pa-3"
        ></v-switch>
      </template>
    </v-data-table>
  </v-card>
</template>


<script>
export default {
  name: "allCoins",
  data() {
    return {
      search: "",
      singleSelect: false,
      headers: [
        { text: "Id", value: "id" },
        {
          text: "Name",
          align: "start",
          sortable: true,
          value: "name",
        },
        { text: "Image", value: "image" },
      ],
      selected: [],
      coins: [],
      baseApiUrl: "http://localhost:8000/api/v1/easydefi/coins",
      nNewPage: null,

      prevPageUrl: null,
      nextPageUrl: null,

      firstPageUrl: null,
      lastPageUrl: null,

      nCurrentPage: null,
      nLastPage: null,
    };
  },
  created() {
    this.getData(this.baseApiUrl);
  },
  methods: {
    handlePageChange(value) {
      this.nCurrentPage = value;
    },
    getData(url) {
      if (url) {
        Axios.get(url).then((res) => {
          this.coins = res.data.coins.data;
          this.prevPageUrl = res.data.coins.prev_page_url;
          this.nextPageUrl = res.data.coins.next_page_url;

          this.firstPageUrl = res.data.coins.first_page_url;
          this.lastPageUrl = res.data.coins.last_page_url;

          this.nCurrentPage = res.data.coins.current_page;
          this.nLastPage = res.data.coins.last_page;

          this.nNewPage = null;
        });
      }
      console.log(this.coins);
    },
  },
};
</script>
