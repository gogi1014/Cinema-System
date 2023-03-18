<template>
  <div class="container">
  <div class="post">
  <div class="postinfotop">
  <h2>Create New Account</h2>
  <p id="text" style="color:green; margin-left:100px;"></p>
  </div>
  <form action="#" class="form newtopic" @submit.prevent="register">
  <div class="accsection">
  <div class="topwrap">
  <div class="userinfo pull-left">
  </div>
  <div class="posttext pull-left">
  <div>
  <input v-model="firstname" type="text" placeholder="FirstName" class="form-control"  name="firstname">
  </div>
  <div>
  <input v-model="lastname" type="text" placeholder="LastName" class="form-control"  name="lastname">
  </div>
  <div>
  <input v-model="email" type="text" placeholder="Email" class="form-control"  name="email">
  </div>
  </div>
  <div class="clearfix"></div>
  </div>  
  </div>
  <button type="submit" class="btn btn-primary" v-on:click="updateRow(id, firstname, lastname, email)">Sign Up</button>
  </form>
  </div>
  </div>
  </template>
  <script>
  export default {
  data () {
  return {
  id: "",
  firstname: '',
  email: '',
  lastname: '',
  }
  },
  methods: {
    updateRow: function (id, firstname, lastname, email) {
            axios.post(`/register`, { id, firstname, lastname, email}).then(response => {
                console.log(response);
                this.show();
                this.suc = "Record updated successfully";
                this.showModal = false;
            })
                .catch((error) => {
                    this.errO = error.response.data.message;
                });
        },
  }       
  }
  </script> 