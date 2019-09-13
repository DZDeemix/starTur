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

                <input-component  v-for="(item, index) in parsed_data" :key="index"
                    v-model="item.value"
                    :is_validated="item.error"
                    :is_validated_form="error_form"
                    :error_data="item.error"
                    :label="item.label"
                    :title="item.title">
                </input-component>

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
                console.log(this.parsed_data);
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

                                var errors = error.response.data.errors;

                                var arr = this.parsed_data;
                                arr.forEach(function(item, i, arr) {

                                    if (item.label in errors) {
                                        item.error = errors[item.label];
                                    } else {
                                        item.error = [];
                                    }
                                });

                                this.error_form = true;
                                this.parsed_data = arr;
                                console.log(this.parsed_data);
                                console.log(errors);
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
