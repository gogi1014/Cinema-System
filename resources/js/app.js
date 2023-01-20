/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


// Require Vue
import { createApp } from 'vue';
import example from './components/Movies.vue';
import Bookings from './components/Bookings.vue';
import MovieDate from './components/MovieDate.vue';
import aa from './components/MovieDate.vue';






let app=createApp({})
app.component('example-component' , example);
app.component('bookings' , Bookings);
app.component('aa' , aa);



app.mount("#app")

