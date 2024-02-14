<template>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
            <tr>
                <th scope="col">Career</th>
                <th scope="col">Description</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="subject in arr" :key="subject.id">
                <td>{{ subject.name }}</td>
                <td>{{subject.description}}</td>
                <td>
                    <Link class="btn btn-primary btn-space" href="#">Edit</Link>
                    <Link class="btn btn-danger btn-space" :href="route('careers.confirmDelete', {id: subject.id})">Delete</Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    props: {
        arr: Array
    },
    components: {
        Link
    }
}
</script>

<style scoped>
.btn-space{
    margin-right: 10px;
}
</style>
