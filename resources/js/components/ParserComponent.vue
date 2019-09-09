<template>
    <div>
        <div class="border">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="id">id</label>
                    <input type="text" class="form-control" id="id" v-model ="id">
                    <div class="valid-feedback" >
                        Looks good!
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" @click="parse" type="submit">Парсинг</button>
        </div>
        <div class="border">
        <form class="needs-validation" novalidate>
            <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="title">Название курорта</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.title,
                       'is-valid': !error_data.title && error_form}"
                       class="form-control" id="title" v-model ="parsed_data.title"/>
                <div v-for="error in error_data.title"
                     :class="{
                        'invalid-feedback': !!error_data.title,
                        'valid-feedback': !error_data.title
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="lift_count_bugel">Количество бугельных подъемников</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.lift_count_bugel,
                       'is-valid': !error_data.lift_count_bugel && error_form}"
                       class="form-control" id="lift_count_bugel" v-model ="parsed_data.lift_count_bugel"/>
                <div v-for="error in error_data.lift_count_bugel"
                     :class="{
                        'invalid-feedback': !!error_data.lift_count_bugel,
                        'valid-feedback': !error_data.lift_count_bugel
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="lift_count_sit">Количество сидельных подъемников</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.lift_count_sit,
                       'is-valid': !error_data.lift_count_sit && error_form}"
                       class="form-control" id="lift_count_sit" v-model ="parsed_data.lift_count_sit"/>
                <div v-for="error in error_data.lift_count_sit"
                     :class="{
                        'invalid-feedback': !!error_data.lift_count_sit,
                        'valid-feedback': !error_data.lift_count_sit
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="lift_count_ropeway">Количество вагонных подъемников</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.lift_count_ropeway,
                       'is-valid': !error_data.lift_count_ropeway && error_form}"
                       class="form-control" id="lift_count_ropeway" v-model ="parsed_data.lift_count_ropeway"/>
                <div v-for="error in error_data.lift_count_ropeway"
                     :class="{
                        'invalid-feedback': !!error_data.lift_count_ropeway,
                        'valid-feedback': !error_data.lift_count_ropeway
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="height_diff">Перепад высот (диапазон)</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.height_diff,
                       'is-valid': !error_data.height_diff && error_form}"
                       class="form-control" id="height_diff" v-model ="parsed_data.height_diff"/>
                <div v-for="error in error_data.height_diff"
                     :class="{
                        'invalid-feedback': !!error_data.height_diff,
                        'valid-feedback': !error_data.height_diff
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="track_length">Длина трассы (км)</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.track_length,
                       'is-valid': !error_data.track_length && error_form}"
                       class="form-control" id="track_length" v-model ="parsed_data.track_length"/>
                <div v-for="error in error_data.track_length"
                     :class="{
                        'invalid-feedback': !!error_data.track_length,
                        'valid-feedback': !error_data.track_length
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="start_season_date">Дата начала сезона</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.start_season_date,
                       'is-valid': !error_data.start_season_date && error_form}"
                       class="form-control" id="start_season_date" v-model ="parsed_data.start_season_date"/>
                <div v-for="error in error_data.start_season_date"
                     :class="{
                        'invalid-feedback': !!error_data.start_season_date,
                        'valid-feedback': !error_data.start_season_date
                        }">
                    {{error}}
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="end_season_date">Дата конца сезона</label>
                <input type="text"
                       :class="{'is-invalid': !!error_data.end_season_date,
                       'is-valid': !error_data.end_season_date && error_form}"
                       class="form-control" id="end_season_date" v-model ="parsed_data.end_season_date"/>
                <div v-for="error in error_data.end_season_date"
                     :class="{
                        'invalid-feedback': !!error_data.end_season_date,
                        'valid-feedback': !error_data.end_season_date
                        }">
                    {{error}}
                </div>
            </div>

        </div>
        </form>
        <button class="btn btn-primary" @click="saveparsed">Cохранить</button>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">lift_count_bugel</th>
                <th scope="col">lift_count_sit</th>
                <th scope="col">lift_count_ropeway</th>
                <th scope="col">height_diff</th>
                <th scope="col">track_length</th>
                <th scope="col">start_season_date</th>
                <th scope="col">end_season_date</th>
                <th scope="col">slug</th>
            </tr>
            </thead>
            <tbody class="table-striped">
            <tr v-for="resort in resorts" :key="resort.id" >
                <th scope="row">{{resort.id}}</th>
                <td>{{resort.title}}</td>
                <td>{{resort.lift_count_bugel}}</td>
                <td>{{resort.lift_count_sit}}</td>
                <td>{{resort.lift_count_ropeway}}</td>
                <td>{{resort.height_diff}}</td>
                <td>{{resort.track_length}}</td>
                <td>{{resort.start_season_date}}</td>
                <td>{{resort.end_season_date}}</td>
                <td>{{resort.slug}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['resortAll'],
        data () {
            return {
                parsed_data: [],
                id: 0,
                error_data: [],
                error_form: false,
                resort_item: [],
                resorts: this.resortAll
            }
        },

        computed: {
            values () {
                return this.resortAll
            }
        },

        methods: {
            parse (e) {
                e.preventDefault();
                axios.get(`getResortParseData/${this.id}`).then((response) => {
                    this.parsed_data = response.data;
                    this.error_form = false;
                })
            },
            saveparsed (e) {
                e.preventDefault();
                
                if (this.resort_item.length === 0) {
                    axios.post(`saveResortParseData/`,
                        this.parsed_data
                    )
                        .then(
                            (response) => {
                                this.resort_item = response.data;
                                this.error_form = false;
                                this.error_data = [];
                            }
                        )
                        .catch((error) => {
                            if (error.response) {
                                this.error_form = true;
                                this.error_data = error.response.data.errors;
                                console.log(error.response.data.errors);
                            }
                        })
                } else {

                    let id = this.resort_item.id;
                    let arr = this.resorts;
                    let result;
                    arr.forEach(function(item, i, arr) {
                        if (item.id == id) {
                           result = i;
                        }
                    });

                    if (result) {
                        //обновляем данные
                        Vue.set(this.resorts, result, this.resort_item)
                        this.resort_item = [];
                    } else {
                        //добавляем данные
                        this.resorts.unshift(this.resort_item);
                        this.resort_item = [];
                    }
                }
            },
        }
    }
</script>

<style scoped>
    .border {
        margin: 40px;
    }
</style>
