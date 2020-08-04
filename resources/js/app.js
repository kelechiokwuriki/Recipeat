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

//home
Vue.component('home-component', require('./components/Home/HomeComponent.vue').default);

//latest recipes
Vue.component('latest-recipes', require('./components/Home/LatestRecipesComponent.vue').default);

//most popular recipe
Vue.component('most-popular-recipes', require('./components/Home/PopularRecipesComponent.vue').default);

//create recipe
Vue.component('create-recipe', require('./components/Modules/CreateRecipeComponent.vue').default);

//recipe component
Vue.component('recipe-component', require('./components/Modules/RecipeComponent.vue').default);

//show single recipe data
Vue.component('single-recipe-component', require('./components/Modules/ShowSingleRecipeInfoComponent.vue').default);

//my recipe
Vue.component('my-recipes-component', require('./components/Recipe/MyRecipesComponent.vue').default);

//search component
Vue.component('search-component', require('./components/Modules/SearchComponent.vue').default);

//saved recipes
Vue.component('saved-recipes-component', require('./components/Recipe/SavedRecipesComponent.vue').default);

//what can i cook
Vue.component('what-can-i-cook-component', require('./components/Modules/WhatCanICookComponent.vue').default);


Vue.component('v-select', vSelect);
Vue.component('number-input', VueNumberInput);



Vue.use(TextareaAutosize);

window.eventBus = new Vue({});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#wrapper'
});
