<template >
    <div id="headerSearchVue">
        <br>
        <div class="form-group" id="searchVue">
            <input type="text" class="searchTerm" v-model="keyword" placeholder="Търси филм.." />
            <button type="button" @click="searchEngine()" class="searchButton"><i class="fa fa-search"></i></button>
        </div>
        <div class="form-group">
            <div class="selectCat">
                <select class="form-control" name="ChooseCategory" @change="changeCategory($event)"
                    v-model="categorySelect">
                    <option value="default">Изберете Категория</option>
                    <option v-for="item in sortCat" :key="item.movieCat">
                        {{ item.movieCat }}</option>
                </select>
            </div>
        </div>
        Търси по жанр:
        <div class="form-inline" id="checkBoxVue">
            <span v-for="item in showGenres" :key="item">
                <input type="checkbox" v-model="item" v-bind:id=item @change="checkBox(item)">
                <span class="checkbox-label">
                    {{ item }} </span> <br>
            </span>
        </div>
        <div id="loginDelete">
            <label for="ElementsNumber">Брой филми на страница:</label>
            <select name="ElementsNumber" @change="onChange($event)" v-model="selPageNum">
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
    </div>
    <div class="container">
        <table id="tableContent">
            <tbody>
                <tr class='trMovie' v-for="item in paginated" :key="item.movieId">
                    <td><img class="imgContent" :src="item.movieImg"
                            @click="selectTrailer(item.movieId, item.movieTitle, item.movieTrailer, true)"></td>
                    <td class='trMovie'>
                        <table>
                            <tr>
                                <td>
                                    <h4><a style="text-decoration:none" :href="this.contentRoute + item.movieId">
                                            {{ item.movieTitle }}</a></h4>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ item.movieGenre }} | {{ item.movieDuration }} мин. | Категория: {{ item.movieCat }} |
                                    {{ item.movieLan }}</td>
                            </tr>
                        </table>
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
    <!-- MODAL FOR TRAILER -->
    <modal v-if="showModal" @close="showModal = false">
        <div class="modal-mask">
            <div class="modalTrailer">
                <div class="modalTrailerHeadX">
                    <h3 v-on:click="showModal = false">X</h3>
                </div>
                <div class="modalTrailerHead">
                    <div class="modalTrailerHeadChild">
                        <h3>{{ movieTitle }}</h3>
                    </div>
                </div>
                <div class="modalTrailerContent">
                    <iframe class="iframe" :src=movieTrailer frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </modal>
    <!-- END MODAL FOR TRAILER -->
</template>

<script>
import _ from 'lodash';

export default {

    data() {
        return {
            current: 1,
            pageSize: 3,
            keyword: null,
            search: '',
            cinema: [],
            genres: [],
            pages: [],
            checked: [],
            sortCat: [],
            showGenres: [],
            selPageNum: 3,
            categorySelect: "default",
            genreSelect: "default",
            searchModel: "movieTitle",
            suc: "",
            errO: " ",
            selected: 5,
            showModal: false,
            showDelete: false,
            showDeleteRows: false,
            sorted: false,
            contentRoute: "content/",
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
        genreSelect(after, before) {
            this.getResults();
            console.log(this.genreSelect);
        },
        categorySelect(after, before) {
            this.getResults();
            console.log(this.genreSelect);
        },
    },
    methods: {
        searchEngine() {
            this.getResults();
        },
        onChange(event) {
            this.pageSize = event.target.value;
            this.setPages();
        },
        onChangeSearch(event) {
            this.searchModel = event.target.value;
            console.log(this.searchModel);
        },
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
        checkBox(event) {
            var checkBox = document.getElementById(event);
            if (checkBox.checked == true) {
                this.genres.push(checkBox.id);
                console.log(this.genres);
                this.getResults();
            }
            else {
                var index = this.genres.indexOf(checkBox.id);
                this.genres.splice(index, 1);
                this.getResults();
            }
        },
        changeGenre(event) {
            this.genreSelect = event.target.value;
        },
        changeCategory(event) {
            this.categorySelect = event.target.value;
            console.log(this.categorySelect);
        },
        orderedCinema(aa) {
            if (this.sorted == false) {
                this.cinema = _.orderBy(this.cinema, aa, 'asc');
                this.sorted = true;
                document.getElementById(aa).innerHTML = "<i class='fas fa-angle-up'></i>";
            }
            else {
                this.cinema = _.orderBy(this.cinema, aa, 'desc');
                this.sorted = false;
                document.getElementById(aa).innerHTML = "<i class='fas fa-angle-down'></i>";
            }
        },
        getResults() {
            axios.get('movies', {
                params: {
                    keyword: this.keyword, searchModel: this.searchModel, genreSelect: this.genreSelect, categorySelect: this.categorySelect,
                    genres: this.genres
                }
            })
                .then(res => { this.cinema = res.data.cinema; })
        },
        selectTrailer(movieId, movieTitle, movieTrailer, showModal) {
            this.movieId = movieId;
            this.movieTitle = movieTitle;
            this.movieTrailer = movieTrailer;
            this.showModal = showModal;
        },
        show: function () {
            axios.get('movies').then(function (res) {
                this.cinema = res.data.cinema;
                this.sortCat = res.data.sortCat;
                this.showGenres = res.data.fpMovies;
            }.bind(this));
        },
    },
    created: function () {
        this.show();
    },
}
</script>

