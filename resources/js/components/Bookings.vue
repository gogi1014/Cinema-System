<template >
    <h1>Списък с резервации</h1>
    <div class="form-inline">
        <label>Търси резервация:</label>
        <input type="text" v-model="keyword" placeholder="Търси .." />
        <label  id="sortElements" for="searchSelect">Търси по:</label>
        <select class="form-control" name="searchSelect" @change="onChangeSearch($event)" v-model="searchModel">
            <option value="id">ID на филм</option>
            <option value="MovieId">Имена на потребител</option>
            <option value="MovieName">Име на филм</option>
        </select>
        <select id="sortElements" class="form-control" name="searchSelect" @change="onChangeDate($event)" v-model="searchDateModel">
            <option value="default">Изберете дата:</option>
            <option v-for="item in cinema" :key="item">
                {{ item.date }}</option>
        </select>
        <select id="sortElements" class="form-control" name="searchSelect" @change="onChangeTime($event)" v-model="searchTimeModel">
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
    <button id="sortElements" type="button" class="btn btn-danger" @click="DeleteRows(checked, true)">Изтриване на избраните</button>
    </div>
    <table class="table" id="adminTable">
        <thead class="thead-dark">
            <tr>
                <th class="text-left">
                </th>
                <th class="text-left" @click="orderedCinema('movieId')">
                    ID
                    <div ref="myId" id="id"></div>
                </th>
                <th class="text-left" @click="orderedCinema('firstname')">
                    Име
                    <div ref="myId" id="firstname"></div>
                </th>
                <th class="text-left" @click="orderedCinema('lastname')">
                    Фамилия
                    <div ref="myId" id="lastname"></div>
                </th>
                <th class="text-left" @click="orderedCinema('email')">
                    Имейл
                    <div ref="myId" id="email"></div>
                </th>
                <th class="text-left" @click="orderedCinema('date')">
                    Дата
                    <div ref="myId" id="date"></div>
                </th>
                <th class="text-left" @click="orderedCinema('ticknum')">
                    Брой билети
                    <div ref="myId" id="ticknum"></div>
                </th>
                <th class="text-left" @click="orderedCinema('time')">
                    Час
                    <div ref="myId" id="time"></div>
                </th>
                <th class="text-left" @click="orderedCinema('MovieId')">
                    Име на филм
                    <div ref="myId" id="movieId"></div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in paginated" :key=item.id>
                <td><input type="checkbox" v-bind:id=item.id @click="checkBox(item.id)"></td>
                <td>{{ item.id }}</td>
                <td>{{ item.firstname }}</td>
                <td>{{ item.lastname }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.date }}</td>
                <td>{{ item.ticknum }}</td>
                <td>{{ item.time }}</td>
                <td>{{ item.MovieId }}</td>
                <td><button type="button" class="btn btn-danger" v-on:click="Delete(item.id, true)">Изтриване</button></td>
                <td><button id="show-modal" class="btn btn-primary" @click="select(item.id, item.firstname, item.lastname, item.email, item.date,
                    item.ticknum, item.time, item.MovieId, true)">Редактиране</button>
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
                <h3>Редактиране</h3>
                <table class="tab">
                    <tr>
                        <td><label for="firstname">Име </label></td>
                        <td><input type='text' id="firstname" v-model="firstname" placeholder="Име" /></td>
                    </tr>
                    <tr>
                        <td><label for="lastname">Фамилия </label></td>
                        <td><input type='text' id="lastname" v-model="lastname" placeholder="Фамилия" /></td>
                    </tr>
                    <tr>
                        <td><label for="email">Имейл </label></td>
                        <td><input type='text' id="email" v-model="email" placeholder="Имейл" /></td>
                    </tr>
                    <tr>
                        <td><label for="date">Дата </label></td>
                        <td><input type='text' id="date" v-model="date" placeholder="Дата" /></td>
                    </tr>
                    <tr>
                        <td><label for="ticknum">Брой билети </label></td>
                        <td><input type='text' id="ticknum" v-model="ticknum" placeholder="Брой билети" /></td>
                    </tr>
                    <tr>
                        <td><label for="time">Час </label></td>
                        <td><input type='text' id="time" v-model="time" placeholder="Час" /></td>
                    </tr>
                    <tr>
                        <td><label for="MovieId">Име на филм </label></td>
                        <td><input type='text' id="MovieId" v-model="MovieId" placeholder="Име на филм" /></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="btn btn-primary" v-on:click="updateRow(id, firstname, lastname, email, date,
                            ticknum, time, MovieId)">Актуализиране</button></td>
                        <td><button type="button" class="btn btn-danger" @click="showModal = false">Отказ</button></td>
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
                <button type="button" class="btn btn-danger" v-on:click="removeRow(id, false)">Потвърди</button>
                <button type="button" class="btn btn-primary" v-on:click="showDelete = false">Отказ</button>
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
import Paginate from 'vuejs-paginate-next';
export default {
    components: {
        paginate: Paginate,
    },
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
            searchModel: "id",
            searchDateModel: "default",
            searchTimeModel: "default",
            showModal: false,
            showDelete: false,
            showDeleteRows: false,
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
        checked(after, before){
            this.getResults();
            console.log(this.checked);
        }
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
            axios.get('bookings', { params: { keyword: this.keyword, searchModel: this.searchModel, searchDateModel: this.searchDateModel, 
                searchTimeModel: this.searchTimeModel} })
                .then(res => {this.cinema = res.data;console.log(this.checked);} )
        },
        onChangeSearch(event) {
            this.searchModel = event.target.value;
            console.log(this.searchModel);
        },
        onChangeDate(event) {
            this.searchDateModel = event.target.value;
            console.log(this.searchDateModel);
        },
        onChangeTime(event) {
            this.searchTimeModel = event.target.value;
            console.log(this.searchTimeModel);
        },
        checkBox(event) {
            var checkBox = document.getElementById(event);
            if (checkBox.checked == true) {
                this.checked.push(checkBox.id);
            } 
            else{
                var index = this.checked.indexOf(checkBox.id);
                this.checked.splice(index, 1);
                console.log(this.checked);
            }
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
            axios.post(`updateBookings/${id}`, { id, firstname, lastname, email, date, ticknum, time, MovieId }).then(response => {
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
            axios.get('bookings').then(function (res) {
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
            axios.delete(`deleteBookings/${id}`).then(response => {
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
            axios.delete(`deleteMultiBookings`, { params: {checked: this.checked }}).then(response => {
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