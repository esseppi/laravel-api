window.Vue = require("vue");
window.Axios = require("axios");

require("./bootstrap");

import App from "./views/App.vue";
import VueRouter from "vue-router";
import Vuetify from "../plugins/vuetify";
import "material-design-icons-iconfont/dist/material-design-icons.css";

import HomePage from "./pages/HomePage.vue";
import Coins from "./pages/Coins.vue";
import Trades from "./pages/Trades.vue";
import MyWallet from "./pages/MyWallet.vue";
Vue.use(VueRouter, {
    iconfont: "mdi", // 'md' || 'mdi' || 'fa' || 'fa4'
});

const router = new VueRouter({
    mode: "history",
    routes: [
        // {
        //     path: "/",
        //     name: "home",
        //     component: HomePage,
        // },
        // {
        //     path: "/coins",
        //     name: "allCoins",
        //     component: Coins,
        // },
        // {
        //     path: "/myTrades/:id",
        //     name: "trades",
        //     component: Trades,
        // },
        // {
        //     path: "/wallet/:id",
        //     name: "postShow",
        //     component: MyWallet,
        //     props: true,
        // },
        {
            path: "/coins",
            name: "allCoins",
            component: Coins,
        },
    ],
});

const app = new Vue({
    router,
    vuetify: Vuetify,
    el: "#app",
    render: (h) => h(App),
});

// // FORM DI ELIMINAZIONE
// const button = document.querySelectorAll(".deleteButton");
// const form = document.querySelector("#deleteForm");

// button.forEach((button) => {
//     button.addEventListener("click", function () {
//         form.action = this.dataset.base + "/" + this.dataset.id;
//     });
//     console.log(form.action);
// });

// // GENERATORE SLUGGER COIN
// const btnSlugger = document.querySelector("#btn-slugger");
// if (btnSlugger) {
//     btnSlugger.addEventListener("click", function () {
//         const eleSlug = document.querySelector("#slug");
//         const eleImage = document.querySelector("#image");
//         const eleDescription = document.querySelector("#description");
//         const name = document.querySelector("#name").value.toLowerCase();
//         console.log("https://api.coingecko.com/api/v3/coins/${name}");

//         Axios.post("/admin/slugger", {
//             generatorString: name,
//         }).then(function (response) {
//             eleSlug.value = response.data.slug;
//         });
//         Axios.get(`https://api.coingecko.com/api/v3/coins/${name}`).then(
//             function (response) {
//                 eleImage.value = response.data["image"]["large"];
//                 eleDescription.value = response.data["description"]["en"];
//             }
//         );
//     });
// }
// function updateRate() {
//     foreignAmount.value =
//         parseFloat(document.getElementById("baseAmount").value) *
//         parseFloat(exRate.value);
// }
// data del trade
// const date = document.getElementById("date");
// const foreignAmount = document.getElementById("foreignAmount");
// // info di rates
// const baseUsd = document.querySelector("#basePrice"); //cambio coin 1 vs usd
// const foreignUsd = document.querySelector("#foreignPrice"); //cambio coin 2 vs usd
// const exRate = document.querySelector("#tradePrice"); //coin1 / coin2
// const baseAmount = document.getElementById("baseAmount");
// baseAmount.addEventListener("change", updateRate);

// // GENERATORE INFORMAZIONI PAGINA TRADE
// const btnGenerator = document.querySelector("#btnGenerator");
// if (btnGenerator) {
//     btnGenerator.addEventListener("click", function () {
//         // nomi coin to exchange
//         var data1 = document.querySelector("#coin1");
//         var option1 = data1.options[data1.selectedIndex];
//         var coinBase = option1.getAttribute("data-name").toLowerCase();
//         var data2 = document.querySelector("#coin2");
//         var option2 = data2.options[data2.selectedIndex];
//         var coinForeign = option2.getAttribute("data-name").toLowerCase();

//         // GENERAZIONE SLUG
//         const eleSlugTrade = document.querySelector("#slugRes");
//         const tradeDir = document.querySelector("#tradeDir").value;
//         const name = coinBase + tradeDir + coinForeign;

//         // INSERIMENTO PREZZI IN BASE ALLA DATA
//         var input = date.value;
//         input = date.value.split("-");
//         const day = input[2];
//         const month = input[1];
//         const year = input[0];

//         // axios calls
//         const reqOne = Axios.get(
//             `https://api.coingecko.com/api/v3/coins/${coinBase}/history?date=${day}-${month}-${year}`
//         );
//         const reqTwo = Axios.get(
//             `https://api.coingecko.com/api/v3/coins/${coinForeign}/history?date=${day}-${month}-${year}`
//         );
//         const reqThree = Axios.post("/admin/tradeslug", {
//             generatorString: name,
//         });
//         // AXIOS RATE CALLS
//         Axios.all([reqOne, reqTwo, reqThree])
//             .then(
//                 Axios.spread((...responses) => {
//                     // PREZZO DI CAMBIO TRA DUE ASSET
//                     exRate.value =
//                         responses[0].data.market_data.current_price.usd /
//                         responses[1].data.market_data.current_price.usd;
//                     // BASE ASSET VALUE
//                     baseUsd.value =
//                         responses[0].data.market_data.current_price.usd;
//                     // FOREIGN ASSET VALUE
//                     foreignUsd.value =
//                         responses[1].data.market_data.current_price.usd;
//                     // GENERATORE SLUG
//                     eleSlugTrade.value = responses[2].data.slug;
//                     updateRate();
//                 })
//             )
//             .catch((errors) => {
//                 // react on errors.
//             });
//     });
// }
