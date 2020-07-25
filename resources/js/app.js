/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import TextareaAutosize from 'vue-textarea-autosize';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import VueNumberInput from '@chenfengyuan/vue-number-input';

Vue.component('latest-recipes', require('./components/LatestRecipesComponent.vue').default);
Vue.component('most-popular-recipes', require('./components/PopularRecipesComponent.vue').default);
Vue.component('create-recipe', require('./components/CreateRecipeComponent.vue').default);
Vue.component('recipe-component', require('./components/RecipeComponent.vue').default);
Vue.component('single-recipe-component', require('./components/ShowSingleRecipeInfoComponent.vue').default);




Vue.component('v-select', vSelect);
Vue.component('number-input', VueNumberInput);



Vue.use(TextareaAutosize);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#wrapper'
});
