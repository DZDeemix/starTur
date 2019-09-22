<template>
    <div>
        <div aria-live="polite" aria-atomic="true"
             class="d-flex justify-content-center align-items-center customToast">
            <div class="toast fade hide" role="alert" aria-live="assertive"
                 aria-atomic="true" id="socket" data-delay="2000">
                <div class="toast-header">
                    <strong class="mr-auto">Parser</strong>
                    <small class="text-muted">message</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Письмо отправлено
                </div>
            </div>
        </div>

        <div class="border">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="id">id</label>
                    <input type="text" class="form-control" id="id" v-model="id">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email">email</label>
                    <input type="text" class="form-control" id="email" v-model="email">
                </div>
            </div>
            <button class="btn btn-primary" @click="parse" type="submit">Парсинг</button>
        </div>
        <div class="border">
            <form class="needs-validation" novalidate>
                <div class="form-row">

                    <input-component v-for="(item, index) in parsed_data" :key="index"
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
                <th v-for="(item, name, index) in resorts[resorts.length - 1]" :key="index" scope="col">{{name}}</th>
            </tr>
            </thead>
            <tbody class="table-striped">
            <tr v-for="resort in resorts" :key="resort.id">
                <td v-for="(item, index) in resort" :key="index">{{item}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['resortAll'],

        data() {
            return {
                parsed_data: [],
                id: '',
                email: '',
                error_data: [],
                error_form: false,
                resort_item: [],
                resorts: this.resortAll
            }
        },

        mounted() {
            $('#socket').toast('hide');
            Echo.channel('laravel_database_send-email')
                .listen('SkiResortEvent', (e) => {
                    $('#socket').toast('show');
                    console.log(e);
                });
        },
        methods: {
            parse(e) {
                e.preventDefault();
                axios.get(`getResortParseData/${this.id}/${this.email}`).then((response) => {
                    this.parsed_data = response.data;
                    this.error_form = false;
                })
            },
            saveparsed(e) {
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
                                arr.forEach(function (item, i, arr) {

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
                    arr.forEach(function (item, i, arr) {
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

    .customToast {
        position: absolute;
        top: 0;
        right: 0;
        min-height: 200px;
    }
</style>
