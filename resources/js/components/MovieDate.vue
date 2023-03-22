<template >
    <h1>Списък с дати и часове</h1>
    <div class="search-wrapper">
        <input type="text" v-model="search" placeholder="Search title.." />
        <label>Search title:</label>
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th class="text-left">
                    ID
                </th>
                <th class="text-left">
                    ID на филм
                </th>
                <th class="text-left">
                    Име на филм
                </th>
                <th class="text-left">
                    Дата
                </th>
                <th class="text-left">
                    Тип
                </th>
                <th class="text-left">
                    Час
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cinema" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.MovieId }}</td>
                <td>{{ item.MovieName }}</td>
                <td>{{ item.date }}</td>
                <td>{{ item.type }}</td>
                <td>{{ item.time }}</td>
                <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.id, true)">Delete</button></td>
                <td><button id="show-modal" class="btn btn-primary"
                        @click="select(item.id, item.MovieId,item.MovieName, item.date, item.time,item.type, true)">Edit</button>
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
                        <td><label for="MovieId">ID на филм </label></td>
                        <td><input type='text' id="MovieId" v-model="MovieId" placeholder="ID на филм" /></td>
                    </tr>
                    <tr>
                        <td><label for="MovieName">Име на филм </label></td>
                        <td><input type='text' id="MovieName" v-model="MovieName" placeholder="Име на филм" /></td>
                    </tr>
                    <tr>
                        <td><label for="date">Дата </label></td>
                        <td><input type='date' id="date" v-model="date" placeholder="Дата" /></td>
                    </tr>
                    <tr>
                        <td><label for="time">Час </label></td>
                        <td><input type='text' id="time" v-model="time" placeholder="Час" /></td>
                    </tr>
                    <tr>
                        <td><label for="time">Тип </label></td>
                        <td><input type='text' id="time" v-model="type" placeholder="Час" /></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-primary"
                                v-on:click="updateRow(id, MovieId,MovieName, date, time, type)">Update</button></td>
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
export default {
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
            date: Date,
            time: String,
            type: String,
            MovieId: String,
            MovieName: String,
        }
    },
    methods: {
        select: function (id, MovieId, MovieName, date, time, type, showModal) {
            this.id = id;
            this.MovieId = MovieId;
            this.MovieName = MovieName;
            this.date = date;
            this.time = time;
            this.type = type;
            this.showModal = showModal;
        },
        updateRow: function (id, MovieId,MovieName, date, time, type) {
            axios.post(`updateMoviesDate/${id}`, { id, MovieId,MovieName, date, time,type }).then(response => {
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
            axios.get('moviesDate').then(function (res) {
                this.cinema = res.data;
            }.bind(this));
        },
        Delete: function (id, showDelete) {
            this.id = id;
            this.showDelete = showDelete;
        },
        removeRow: function (id, showDelete) {
            console.log("Row Deleted")
            axios.delete(`deleteMoviesDate/${id}`).then(response => {
                console.log(response.data);
                if (response.data.status == true) {
                    this.show();
                    this.showDelete = showDelete;
                    this.suc = "Record deleted successfully";
                }
            });
        },
    },
    created: function () {
        this.show();
    }
}
</script>