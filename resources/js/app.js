/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


// Require Vue
import { createApp } from 'vue';
import example from './components/Movies.vue';
import Bookings from './components/Bookings.vue';
import aa from './components/MovieDate.vue';
import book from './components/aa.vue';
import fp from './components/fpMovies.vue';



import JwPagination from 'jw-vue-pagination';

let app = createApp({})
app.component('example-component', example);
app.component('bookings', Bookings);
app.component('aa', aa);
app.component('jw-pagination', JwPagination);
app.component('book', book);
app.component('fp', fp);




app.mount("#app")

