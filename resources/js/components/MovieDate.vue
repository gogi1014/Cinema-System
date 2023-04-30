<template >
    <h1>Списък с дати и часове</h1>
    <div class="form-inline">
        <label>Търси:</label>
        <input type="text" v-model="keyword" placeholder="Търси..." />
        <label id="sortElements" for="searchSelect">Търси по:</label>
        <select class="form-control" name="searchSelect" @change="onChangeSearch($event)" v-model="searchModel">
            <option value="id">ID на дата и час</option>
            <option value="MovieId">ID на филм</option>
            <option value="MovieName">Име на филм</option>
        </select>
        <select id="sortElements" class="form-control" name="searchSelect" @change="onChangeDate($event)"
            v-model="searchDateModel">
            <option value="default">Изберете дата:</option>
            <option v-for="item in cinema" :key="item">
                {{ item.date }}</option>
        </select>
        <select id="sortElements" class="form-control" name="searchSelect" @change="onChangeTime($event)"
            v-model="searchTimeModel">
            <option value="default">Изберете час:</option>
            <option v-for="item in cinema" :key="item">
                {{ item.time }}</option>
        </select>
    </div>
    <div id="loginDelete">
        <label for="ElementsNumber">Брой елементи на страница:</label>
        <select name="ElementsNumber" @change="onChange($event)" v-model="selPageNum">
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
        <button id="sortElements" type="button" class="btn btn-danger" @click="DeleteRows(checked, true)">Изтриване на
            избраните</button>
    </div>
    <table class="table" id="adminTable">
        <thead class="thead-dark">
            <tr>
                <th class="text-left">
                </th>
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
            <tr v-for="item in paginated" :key="item.id">
                <td><input type="checkbox" v-bind:id=item.id @click="checkBox(item.id)"></td>
                <td>{{ item.id }}</td>
                <td>{{ item.MovieId }}</td>
                <td>{{ item.MovieName }}</td>
                <td>{{ item.date }}</td>
                <td>{{ item.type }}</td>
                <td>{{ item.time }}</td>
                <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.id, true)">Delete</button></td>
                <td><button id="show-modal" class="btn btn-primary"
                        @click="select(item.id, item.MovieId, item.MovieName, item.date, item.time, item.type, true)">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>
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
                                v-on:click="updateRow(id, MovieId, MovieName, date, time, type)">Update</button></td>
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
                <button type="button" class="btn btn-danger" v-on:click="removeRow(id, false)">Confirm</button>
                <button type="button" class="btn btn-primary" v-on:click="showDelete = false">Cancel</button>
            </div>
        </div>
    </modal>
    <modal v-if="showDeleteRows" @close="showDeleteRows = false">
        <div class="modal-mask">
            <div class="delete">
                <p>Сигурни ли сте, че искате да изтриете {{ checked }} елементи?</p>
                <button type="button" class="btn btn-danger" v-on:click="removeRows(false)">Потвърди</button>
                <button type="button" class="btn btn-primary" v-on:click="showDeleteRows = false">Отказ</button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            current: 1,
            pageSize: 5,
            keyword: null,
            search: '',
            cinema: [],
            pages: [],
            checked: [],
            suc: "",
            errO: " ",
            selPageNum: 5,
            searchModel: "MovieName",
            searchDateModel: "default",
            searchTimeModel: "default",
            showModal: false,
            showDelete: false,
            showDeleteRows: false,
            id: Number,
            date: Date,
            time: String,
            type: String,
            MovieId: String,
            MovieName: String,
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
        },
        searchDateModel(after, before) {
            this.getResults();
            console.log(this.searchDateModel);
        },
        searchTimeModel(after, before) {
            this.getResults();
            console.log(this.searchTimeModel);
        },
    },
    methods: {
        onChange(event) {
            this.pageSize = event.target.value;
            this.setPages();
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
        getResults() {
            axios.get('moviesDate', {
                params: {
                    keyword: this.keyword, searchModel: this.searchModel, searchDateModel: this.searchDateModel,
                    searchTimeModel: this.searchTimeModel
                }
            })
                .then(res => this.cinema = res.data)
        },
        onChangeSearch(event) {
            this.searchModel = event.target.value;
            console.log(this.searchModel);
        },
        checkBox(event) {
            var checkBox = document.getElementById(event);
            if (checkBox.checked == true) {
                this.checked.push(checkBox.id);
            }
            else {
                var index = this.checked.indexOf(checkBox.id);
                this.checked.splice(index, 1);
                console.log(this.checked);
            }
        },
        onChangeDate(event) {
            this.searchDateModel = event.target.value;
            console.log(this.searchDateModel);
        },
        onChangeTime(event) {
            this.searchTimeModel = event.target.value;
            console.log(this.searchTimeModel);
        },
        select: function (id, MovieId, MovieName, date, time, type, showModal) {
            this.id = id;
            this.MovieId = MovieId;
            this.MovieName = MovieName;
            this.date = date;
            this.time = time;
            this.type = type;
            this.showModal = showModal;
        },
        updateRow: function (id, MovieId, MovieName, date, time, type) {
            axios.post(`updateMoviesDate/${id}`, { id, MovieId, MovieName, date, time, type }).then(response => {
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
        DeleteRows: function (checked, showDeleteRows) {
            this.checked = checked;
            this.showDeleteRows = showDeleteRows;
            console.log(this.checked.values);
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
        removeRows: function (showDeleteRows) {
            console.log("Row Deleted")
            axios.delete(`deleteMultiMoviesDate`, { params: { checked: this.checked } }).then(response => {
                console.log(response.data);
                if (response.data.status == true) {
                    this.show();
                    this.showDeleteRows = showDeleteRows;
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