// resources/components/HelloVue.vue

<template >
  <h1>Hello Vue!</h1>
  <div class="search-wrapper">
    <input type="text" v-model="keyword" placeholder="Search title.."/>
        <label>Search title:</label>
  </div>
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
            <tr v-for="item in cinema.data" :key="item.movieId ">
                <td>{{ item.movieId  }}</td>
                <td>{{ item.movieTitle }}</td>
                <td>{{ item.movieImg }}</td>
                <td>{{ item.movieGenre }}</td>
                <td>{{ item.movieDuration }}</td>
                <td>{{ item.movieRelDate }}</td>
                <td>{{ item.movieDirector }}</td>
                <td>{{ item.movieActors }}</td>
                <td>{{ item.Description }}</td>
                <td>{{ item.movieCat }}</td>
                <td>{{ item.movieLan }}</td>
                <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.movieId,true)">Delete</button></td>
                <td><button id="show-modal" class="btn btn-primary"
                        @click="select(item.movieId, item.movieTitle, item.movieImg, item.movieGenre, item.movieDuration, 
                        item.movieRelDate,item.movieDirector,item.movieActors,item.Description,item.movieCat,item.movieLan, true)">Edit</button>
                </td>
              </tr>
              </tbody>
    </table>
    <pagination :data="cinema" @pagination-change-page="getResults"></pagination>
    
    <modal v-if="showModal" @close="showModal = false">
        <div class="modal-mask">
            <div class="edit">
                <h3>Edit</h3>
                <table class="tab">
                    <tr>
                        <td><label for="movieTitle">Name </label></td>
                        <td><input type='text' id="movieTitle" v-model="movieTitle" placeholder="Name" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieImg">Age </label></td>
                        <td><input type='text' id="movieImg" v-model="movieImg" placeholder="age" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieGenre">Address </label></td>
                        <td><input type='text' id="movieGenre" v-model="movieGenre" placeholder="address" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieDuration">Section </label></td>
                        <td><input type='text' id="movieDuration" v-model="movieDuration" placeholder="section" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieRelDate">Salary </label></td>
                        <td><input type='text' id="movieRelDate" v-model="movieRelDate" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieDirector">Salary </label></td>
                        <td><input type='text' id="movieDirector" v-model="movieDirector" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieActors">Salary </label></td>
                        <td><input type='text' id="movieActors" v-model="movieActors" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><label for="Description">Salary </label></td>
                        <td><input type='text' id="Description" v-model="Description" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieCat">Salary </label></td>
                        <td><input type='text' id="movieCat" v-model="movieCat" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieLan">Salary </label></td>
                        <td><input type='text' id="movieLan" v-model="movieLan" placeholder="salary" /></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-primary"
                                v-on:click="updateRow(movieId,movieTitle, movieImg, movieGenre, movieDuration, 
                        movieRelDate,movieDirector,movieActors,Description,movieCat,movieLan)">Update</button></td>
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
                <button type="button" class="btn btn-danger" v-on:click="removeRow(movieId,false)">Confirm</button>
                <button type="button" class="btn btn-primary" v-on:click="showDelete = false">Cancel</button>
            </div>
        </div>

    </modal>
</template>

<script>
export default {
  data() {
        return {
            keyword: null,
            search: '',
            cinema: [],
            suc: "",
            errO: " ",
            showModal: false,
            showDelete: false,
            movieId: Number,
            movieTitle: String,
            movieImg: String,
            movieGenre: String,
            movieDuration: Number,
            movieRelDate: Date,
            movieDirector: String,
            movieActors: String,
            Description: String,
            movieCat: String,
            movieLan: String,
        }
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    name: 'HelloVue',
    methods: {
        getResults(page=1) {
            axios.get('/movies?page=' + page, { params: { keyword: this.keyword } })
                .then(res => this.cinema = res.data)
        },
        select: function (movieId, movieTitle, movieImg, movieGenre, movieDuration, movieRelDate,movieDirector,movieActors ,Description,movieCat,movieLan,showModal) {
            this.movieId = movieId;
            this.movieTitle = movieTitle;
            this.movieImg = movieImg;
            this.movieGenre = movieGenre;
            this.movieDuration = movieDuration;
            this.movieRelDate = movieRelDate;
            this.movieDirector = movieDirector;
            this.movieActors = movieActors;
            this.Description = Description;
            this.movieCat = movieCat;
            this.movieLan = movieLan;
            this.showModal = showModal;
        },
        updateRow: function (movieId, movieTitle, movieImg, movieGenre, movieDuration, movieRelDate,movieDirector,movieActors ,Description,movieCat,movieLan) {
            axios.post(`update/${movieId}`, { movieId, movieTitle, movieImg, movieGenre, movieDuration, movieRelDate,movieDirector,movieActors ,Description,movieCat,movieLan }).then(response => {
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
                axios.get('/movies').then(function (res) {
                    this.cinema = res.data;
                }.bind(this));
            },
        Delete: function(movieId,showDelete){
            this.movieId = movieId;
            this.showDelete = showDelete;
        },
        removeRow: function (movieId,showDelete) {
            console.log("Row Deleted")
            axios.delete(`/delete/${movieId}`).then(response => {
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