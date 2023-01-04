
<template >
  <h1>Hello Vue!</h1>
  <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th class="text-left">
                    ID
                </th>
                <th class="text-left">
                    Name
                </th>
                <th class="text-left">
                    Age
                </th>
                <th class="text-left">
                    Address
                </th>
                <th class="text-left">
                    Section
                </th>
                <th class="text-left">
                    Salary
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cinema" :key="item.id ">
                <td>{{ item.firstname }}</td>
                <td>{{ item.lastname }}</td>
               
              </tr>
              </tbody>
    </table>
</template>

<script>
export default {
  data() {
        return {
          cinema: [],
        }
    },
    name: 'HelloVue',
    methods: {
      
      show: function () {
            axios.get('/bookings').then(function (res) {
                this.cinema = res.data;
            }.bind(this));
        }
    },
    created: function () {
        this.show();
    }
}
</script>