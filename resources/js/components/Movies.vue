// resources/components/HelloVue.vue

<template >
    <h1>Списък с филми</h1>
    <div class="search-wrapper">
        <label>Търси филм:</label>
        <input type="text" v-model="keyword" placeholder="Търси филм.." />
    </div>
    <div class="container">
        <table style="display: block; height: 1020px; overflow: auto;" class="table " id="adminTable">
            <thead class="thead-dark">
                <tr>
                    <th class="text-left" @click="orderedCinema('movieId')">
                        ID
                    <div v-html="message" ref="myId" id="myDiv"></div>
                    </th>
                    <th class="text-left" @click="orderedCinema('movieTitle')">
                        Заглавие
                    </th>
                    <th class="text-left" @click="orderedCinema('movieTrailer')">
                        Трейлър
                    </th>
                    <th class="text-left" @click="orderedCinema('movieGenre')">
                        Жанр
                    </th>
                    <th class="text-left" @click="orderedCinema('movieDuration')">
                        Времетраене
                    </th>
                    <th class="text-left" @click="orderedCinema('movieRelDate')">
                        Дата на излизане
                    </th>
                    <th class="text-left" @click="orderedCinema('movieDirector')">
                        Продуцент
                    </th>
                    <th class="text-left" @click="orderedCinema('movieActors')">
                        Актъори
                    </th>
                    <th class="text-left" @click="orderedCinema('Description')">
                        Описание
                    </th>
                    <th class="text-left" @click="orderedCinema('movieCat')">
                        Категория
                    </th>
                    <th class="text-left" @click="orderedCinema('movieLan')">
                        Език
                    </th>
                    <th class="text-left">
                        Активен
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in paginated" :key="item.movieId">
                    <td>{{ item.movieId }}</td>
                    <td>{{ item.movieTitle }}</td>
                    <td>{{ item.movieTrailer }}</td>
                    <td>{{ item.movieGenre }}</td>
                    <td>{{ item.movieDuration }}</td>
                    <td>{{ item.movieRelDate }}</td>
                    <td>{{ item.movieDirector }}</td>
                    <td>
                        <div style="height:125px; overflow:hidden">{{ item.movieActors }}</div>
                    </td>
                    <td>
                        <div style="height:125px; overflow:hidden">{{ item.Description }}</div>
                    </td>
                    <td>{{ item.movieCat }}</td>
                    <td>{{ item.movieLan }}</td>
                    <td>{{ item.active }}</td>
                    <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.movieId, true)">Delete</button>
                    </td>
                    <td><button id="show-modal" class="btn btn-primary"
                            @click="select(item.movieId, item.movieTitle, item.movieImg, item.movieTrailer, item.movieGenre, item.movieDuration,
                                item.movieRelDate, item.movieDirector, item.movieActors, item.Description, item.movieCat, item.movieLan, item.active, true)">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- PAGINATION START -->
    <div class="clearfix btn-group col-md-2 offset-md-5">
        <button type="button" class="btn btn-sm btn-outline-secondary" @click="prev"> &lt&lt </button>
        <button type="button" class="btn btn-sm btn-outline-secondary" v-for="pageNumber  in pages"
            @click="current = pageNumber"> {{ pageNumber }}
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary" @click="next"> >> </button>
    </div><!--end col-->
    <!-- PAGINATION END -->
    <modal v-if="showModal" @close="showModal = false">
        <div class="modal-mask">
            <div class="edit">
                <h3>Редактиране</h3>
                <table class="tab">
                    <tr>
                        <td><label for="movieTitle">Заглавие </label></td>
                        <td><input type='text' id="movieTitle" style="width: 100%;" v-model="movieTitle"
                                placeholder="Заглавие" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieImg">Постер </label></td>
                        <td><input type='text' id="movieImg" style="width: 100%;" v-model="movieImg" placeholder="Постер" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="movieTrailer">Трейлър </label></td>
                        <td><input type='text' id="movieTrailer" style="width: 100%;" v-model="movieTrailer"
                                placeholder="Трейлър" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieGenre">Жанр </label></td>
                        <td><input type='text' id="movieGenre" style="width: 100%;" v-model="movieGenre"
                                placeholder="Жанр" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieDuration">Времетраене </label></td>
                        <td><input type='text' id="movieDuration" style="width: 100%;" v-model="movieDuration"
                                placeholder="Времетраене" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="movieRelDate">Дата на излизане </label></td>
                        <td><input type='text' id="movieRelDate" style="width: 100%;" v-model="movieRelDate"
                                placeholder="Дата на излизане" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieDirector">Режисьор </label></td>
                        <td><input type='text' id="movieDirector" style="width: 100%;" v-model="movieDirector"
                                placeholder="Режисьор" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="movieActors">Актъори </label></td>
                        <td><input type='text' id="movieActors" style="width: 100%;" v-model="movieActors"
                                placeholder="Актъори" /></td>
                    </tr>
                    <tr>
                        <td><label for="Description">Описание </label></td>
                        <td><textarea rows="5" cols="60" id="Description" v-model="Description"
                                placeholder="Описание"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="movieCat">Категория </label></td>
                        <td><input type='text' id="movieCat" style="width: 100%;" v-model="movieCat"
                                placeholder="Категория" /></td>
                    </tr>
                    <tr>
                        <td><label for="movieLan">Език </label></td>
                        <td><input type='text' id="movieLan" style="width: 100%;" v-model="movieLan" placeholder="Език" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="active">Активен </label></td>
                        <td><input type='number' id="active" style="width: 100%;" v-model="active" placeholder="Активен" />
                        </td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-primary"
                                v-on:click="updateRow(movieId, movieTitle, movieImg, movieTrailer, movieGenre, movieDuration,
                                    movieRelDate, movieDirector, movieActors, Description, movieCat, movieLan, active)">Update</button>
                        </td>
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
                <p>Сигурни ли сте, че искате да изтриете този елемент?</p>
                <button type="button" class="btn btn-danger" v-on:click="removeRow(movieId, false)">Confirm</button>
                <button type="button" class="btn btn-primary" v-on:click="showDelete = false">Cancel</button>
            </div>
        </div>

    </modal>
</template>

<script>
import _ from 'lodash';

export default {

    data() {
        return {
            current: 1,
            pageSize: 5,
            keyword: null,
            search: '',
            cinema: [],
            pages: [],
            suc: "",
            errO: " ",
            showModal: false,
            showDelete: false,
            sorted: false,
            movieId: Number,
            movieTitle: String,
            movieImg: String,
            movieTrailer: String,
            movieGenre: String,
            movieDuration: Number,
            movieRelDate: Date,
            movieDirector: String,
            movieActors: String,
            Description: String,
            movieCat: String,
            movieLan: String,
            active: Number,
        }
    },
    computed: {
        indexStart() {
            return (this.current * this.pageSize) - this.pageSize;
        },
        indexEnd() {
            return this.current * this.pageSize;
        },
        paginated() {
            return this.cinema.slice(this.indexStart, this.indexEnd);
        },
    },
    watch: {
        cinema() {
            this.setPages();
        },
        keyword(after, before) {
            this.getResults();
        }
    },
    methods: {
        prev() {
            if ((this.current != 1))
                this.current--;
        },
        next() {
            if ((this.current < Math.ceil(this.cinema.length / this.pageSize)))
                this.current++;
        },
        setPages() {
            this.pages.length = 0;
            let numberOfPages = Math.ceil(this.cinema.length / this.pageSize);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        orderedCinema(aa) {
            if (this.sorted == false) {
                this.cinema = _.orderBy(this.cinema, aa, 'asc');
                this.sorted = true;
                this.message = "<i class='fas fa-angle-up'></i>";
            }
            else {
                this.cinema = _.orderBy(this.cinema, aa, 'desc');
                this.sorted = false;
                this.message = "<i class='fas fa-angle-down'></i>";
            }
        },
        getResults() {
            axios.get('movies', { params: { keyword: this.keyword } })
                .then(res => this.cinema = res.data)
        },
        select: function (movieId, movieTitle, movieImg, movieTrailer, movieGenre, movieDuration, movieRelDate, movieDirector, movieActors, Description, movieCat, movieLan, active, showModal) {
            this.movieId = movieId;
            this.movieTitle = movieTitle;
            this.movieImg = movieImg;
            this.movieTrailer = movieTrailer;
            this.movieGenre = movieGenre;
            this.movieDuration = movieDuration;
            this.movieRelDate = movieRelDate;
            this.movieDirector = movieDirector;
            this.movieActors = movieActors;
            this.Description = Description;
            this.movieCat = movieCat;
            this.movieLan = movieLan;
            this.active = active;
            this.showModal = showModal;
        },
        updateRow: function (movieId, movieTitle, movieImg, movieTrailer, movieGenre, movieDuration, movieRelDate, movieDirector, movieActors, Description, movieCat, movieLan, active) {
            axios.post(`update/${movieId}`, { movieId, movieTitle, movieImg, movieTrailer, movieGenre, movieDuration, movieRelDate, movieDirector, movieActors, Description, movieCat, movieLan, active }).then(response => {
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
            axios.get('movies').then(function (res) {
                this.cinema = res.data;
            }.bind(this));
        },
        Delete: function (movieId, showDelete) {
            this.movieId = movieId;
            this.showDelete = showDelete;
        },
        removeRow: function (movieId, showDelete) {
            console.log("Row Deleted")
            axios.delete(`delete/${movieId}`).then(response => {
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
    },
}
</script>

