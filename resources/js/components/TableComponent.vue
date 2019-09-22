<template>
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
            <td> scope="row">{{resort.id}}</td>
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
</template>

<script>
    export default {
        name: "TableComponent"
    }
</script>

<style scoped>

</style>
