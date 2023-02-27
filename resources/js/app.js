/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
// import { createApp, VueElement } from 'vue';
import { createApp } from 'vue';
import { createVuetify } from 'vuetify';
// import { createVCalendar } from 'v-calendar';
import VCalendar from 'v-calendar';
import 'v-calendar/dist/style.css';
// import Test from './components/TestComponent.vue';
// import jQuery from 'jquery';
// window.$ = jQuery;

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp();
const vuetify = createVuetify();
// const vcalendar = createVCalendar();
app.use(vuetify)
// app.use(vcalendar)
app.use(VCalendar, {})
// console.log(app.version);
// app.mount("#app");


import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);
import DeleteModal from './components/DeleteModal.vue';
app.component('delete-modal', DeleteModal);
import JoinModal from './components/JoinModal.vue';
app.component('join-modal', JoinModal);
import JoinCancelModal from './components/JoinCancelModal.vue';
app.component('join-cancel-modal', JoinCancelModal);
import selectStation from './components/selectStation.vue';
app.component('select-station', selectStation);
import Preview from './components/Preview.vue';
app.component('preview', Preview);
import Datetime from './components/Datetime.vue';
app.component('date-time', Datetime);
// import CalendarApp from './components/CalendarApp.vue';
import CalendarApp from './components/CalendarApp3.vue';
app.component('calendar-app', CalendarApp);
import ShowModal from './components/ShowModal.vue';
app.component('show-modal', ShowModal);
import ShowModal2 from './components/ShowModal2.vue';
app.component('show-modal2', ShowModal2);
// app.config.compilerOptions.isCustomElement = tag => tag === 'v-calendar'
// app.config.compilerOptions.isCustomElement = (tag) => {
//   return tag.startsWith('v-calendar')
// }
app.mount("#app");

// import TestComponent from './components/TestComponent.vue';
// const app = createApp(App);
// app.component('test-component', TestComponent);
// app.mount("#app");


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

//  import { createApp } from 'vue/dist/vue.esm-bundler';
//  import { createApp } from 'vue';

//  const counter = createApp({
//      data() {
//          return {
//              counter: 0,
//          };
//      },
//      mounted() {
//          setInterval(() => {
//              this.counter++;
//          }, 1000);
//      },
//  });
//  counter.mount("#counter");

// 画像選択時にプレビュー表示
// import Preview from './components/Preview.vue';
// createApp(Preview).mount('#preview');

// 開始日時入れると終了日時が連動する(同じ日時が入る)
// import Datetime from './components/Datetime.vue';
// createApp(Datetime).mount('#datetime');

// // 参加モーダル
// // import Modal from './components/Modal.vue';
// const Modal = {
//     data() {
//       return {
//   //デフォルトはモーダルウィンドウを閉じる
//       show: false
//     }
//     },
//     methods:{
//   //モーダルウィンドウを開く要素をクリックしたら
//       open: function(){
//         this.show = true
//       },
//   //モーダルウィンドウを閉じる要素をクリックしたら
//       close: function(){
//         this.show = false
//       },
//     }
// }
// createApp(Modal).mount('#join_modal');

// // 参加キャンセルモーダル
// createApp(Modal).mount('#join_cancel');

// 投稿削除キャンセルモーダル
// createApp(Modal).mount('#cancel');
// import DeleteModal from './components/DeleteModal.vue';
// createApp(DeleteModal).component('delete-modal', DeleteModal);

// タブ切り替え
// const Tab = {
//   data() {
//     return {
//       show: '1',
//     }
//   },
//   methods: {
//     select: function(num) {
//       this.show = num;
//     },
//   }
// }
// createApp(Tab).mount('#tab');
