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

                <input-component
                    v-model="parsed_data.title"
                    :is_validated="!!error_data.title"
                    :is_validated_form="error_form"
                    :error_data="error_data.title"
                    label="title"
                    title="Название курорта"
                ></input-component>

                <input-component
                    v-model="parsed_data.lift_count_bugel"
                    :is_validated="!!error_data.lift_count_bugel"
                    :is_validated_form="error_form"
                    :error_data="error_data.lift_count_bugel"
                    label="lift_count_bugel"
                    title="Количество бугельных подъемников"
                ></input-component>

                <input-component
                    v-model="parsed_data.lift_count_sit"
                    :is_validated="!!error_data.lift_count_sit"
                    :is_validated_form="error_form"
                    :error_data="error_data.lift_count_sit"
                    label="lift_count_sit"
                    title="Количество сидельных подъемников"
                ></input-component>

                <input-component
                    v-model="parsed_data.lift_count_sit"
                    :is_validated="!!error_data.lift_count_sit"
                    :is_validated_form="error_form"
                    :error_data="error_data.lift_count_sit"
                    label="lift_count_sit"
                    title="Количество вагонных подъемников"
                ></input-component>

                <input-component
                    v-model="parsed_data.lift_count_ropeway"
                    :is_validated="!!error_data.lift_count_ropeway"
                    :is_validated_form="error_form"
                    :error_data="error_data.lift_count_ropeway"
                    label="lift_count_ropeway"
                    title="Количество вагонных подъемников"
                ></input-component>

                <input-component
                    v-model="parsed_data.height_diff"
                    :is_validated="!!error_data.height_diff"
                    :is_validated_form="error_form"
                    :error_data="error_data.height_diff"
                    label="height_diff"
                    title="Перепад высот (диапазон)"
                ></input-component>

                <input-component
                    v-model="parsed_data.track_length"
                    :is_validated="!!error_data.track_length"
                    :is_validated_form="error_form"
                    :error_data="error_data.track_length"
                    label="track_length"
                    title="Длина трассы (км)"
                ></input-component>

                <input-component
                    v-model="parsed_data.start_season_date"
                    :is_validated="!!error_data.start_season_date"
                    :is_validated_form="error_form"
                    :error_data="error_data.start_season_date"
                    label="start_season_date"
                    title="Дата начала сезона"
                ></input-component>

                <input-component
                    v-model="parsed_data.end_season_date"
                    :is_validated="!!error_data.end_season_date"
                    :is_validated_form="error_form"
                    :error_data="error_data.end_season_date"
                    label="start_season_date"
                    title="Дата конца сезона"
                ></input-component>

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
