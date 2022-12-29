/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
// import { createApp, VueElement } from 'vue';
// import { createApp } from 'vue';
// import Test from './components/TestComponent.vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp();
// console.log(app.version);
// app.mount("#app");


// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);
// app.mount("#app");

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
 import { createApp } from 'vue';

//  const Counter = {
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
//  };
//  createApp(Counter).mount("#counter");

// 画像選択時にプレビュー表示
import Preview from './components/Preview.vue';
createApp(Preview).mount('#preview');

// 開始日時入れると終了日時が連動する(同じ日時が入る)
import Datetime from './components/Datetime.vue';
createApp(Datetime).mount('#datetime');
