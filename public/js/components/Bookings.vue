// resources/components/HelloVue.vue

<template >
    <h1>Списък с резервации</h1>
    <div class="search-wrapper">
        <label>Търси филм:</label>
        <input type="text" v-model="keyword" placeholder="Търси филм.." />
    </div>
    <table class="table table-striped table-dark" id="my-table">
        <thead>
            <tr>
                <th class="text-left">
                    ID
                </th>
                <th class="text-left">
                    Име
                </th>
                <th class="text-left">
                    Фамилия
                </th>
                <th class="text-left">
                    Имейл
                </th>
                <th class="text-left">
                    Дата
                </th>
                <th class="text-left">
                    Брой билети
                </th>
                <th class="text-left">
                    Час
                </th>
                <th class="text-left">
                    Име на филм
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cinema" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.firstname }}</td>
                <td>{{ item.lastname }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.date }}</td>
                <td>{{ item.ticknum }}</td>
                <td>{{ item.time }}</td>
                <td>{{ item.MovieId }}</td>
                <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.id, true)">Delete</button></td>
                <td><button id="show-modal" class="btn btn-primary" @click="select(item.id, item.firstname, item.lastname, item.email, item.date,
                item.ticknum, item.time, item.MovieId, true)">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>
    <modal v-if="showModal" @close="showModal = false">
        <div class="modal-mask">
            <div class="edit">
                <h3>Edit</h3>
                <table class="tab">
                    <tr>
                        <td><label for="firstname">FS </label></td>
                        <td><input type='text' id="firstname" v-model="firstname" placeholder="Име" /></td>
                    </tr>
                    <tr>
                        <td><label for="lastname">Age </label></td>
                        <td><input type='text' id="lastname" v-model="lastname" placeholder="Фамилия" /></td>
                    </tr>
                    <tr>
                        <td><label for="email">Address </label></td>
                        <td><input type='text' id="email" v-model="email" placeholder="Имейл" /></td>
                    </tr>
                    <tr>
                        <td><label for="date">Section </label></td>
                        <td><input type='text' id="date" v-model="date" placeholder="Дата" /></td>
                    </tr>
                    <tr>
                        <td><label for="ticknum">Salary </label></td>
                        <td><input type='text' id="ticknum" v-model="ticknum" placeholder="Брой билети" /></td>
                    </tr>
                    <tr>
                        <td><label for="time">Salary </label></td>
                        <td><input type='text' id="time" v-model="time" placeholder="Час" /></td>
                    </tr>
                    <tr>
                        <td><label for="MovieId">Salary </label></td>
                        <td><input type='text' id="MovieId" v-model="MovieId" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-primary" v-on:click="updateRow(id, firstname, lastname, email, date,
                        ticknum, time, MovieId)">Update</button></td>
                        <td><button type="button" class="btn btn-danger" @click="showModal = false">Cancel</button></td>
                    </tr>
                </table>
                <div class="Err">
                    {{ errO }}
                </div>
            </div>
        </div>
    </modal>
    <modal v-if="showDelete" @close="showDelete = false">
        <div class="modal-mask">
            <div class="delete">
                <p>Are you sure you want to delete this item?</p>
                <button type="button" class="btn btn-danger" v-on:click="removeRow(id, false)">Confirm</button>
                <button type="button" class="btn btn-primary" v-on:click="showDelete = false">Cancel</button>
            </div>
        </div>

    </modal>
</template>

<script>
import Paginate from 'vuejs-paginate-next';
export default {
    components: {
      paginate: Paginate,
    },
    data() {
        return {
            perPage: 1,
            currentPage: 1,
            search: '',
            cinema: [],
            suc: "",
            errO: " ",
            showModal: false,
            showDelete: false,
            id: Number,
            firstname: String,
            lastname: String,
            email: String,
            date: Date,
            ticknum: String,
            time: String,
            MovieId: String,
        }
    },
    name: 'HelloVue',
    methods: {
        
        select: function (id, firstname, lastname, email, date,
            ticknum, time, MovieId, showModal) {
            this.id = id;
            this.firstname = firstname;
            this.lastname = lastname;
            this.email = email;
            this.date = date;
            this.ticknum = ticknum;
            this.time = time;
            this.MovieId = MovieId;
            this.showModal = showModal;
        },
        updateRow: function (id, firstname, lastname, email, date, ticknum, time, MovieId) {
            axios.post(`/updateBookings/${id}`, { id, firstname, lastname, email, date, ticknum, time, MovieId }).then(response => {
                console.log(response);
                this.show();
                this.suc = "Record updated successfully";
                this.showModal = false;
            })
                .catch((error) => {
                    this.errO = error.response.data.message;
                });
        },
        show: function () {
            axios.get('/bookings').then(function (res) {
                this.cinema = res.data;
            }.bind(this));
        },
        Delete: function (id, showDelete) {
            this.id = id;
            this.showDelete = showDelete;
        },
        removeRow: function (id, showDelete) {
            console.log("Row Deleted")
            axios.delete(`/deleteBookings/${id}`).then(response => {
                console.log(response.data);
                if (response.data.status == true) {
                    this.show();
                    this.showDelete = showDelete;
                    this.suc = "Record deleted successfully";
                }
            });
        },
    },
    computed: {
        filteredList() {
            return this.cinema.filter(item => {
                return item.firstname.toLowerCase().includes(this.search.toLowerCase())
            })
        },
        rows() {
            return this.cinema.length
        }
    },
    created: function () {
        this.show();
    }
}
</script>