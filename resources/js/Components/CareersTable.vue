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
            <tr v-for="obj in arr" :key="obj.id">
                <td><Link :href="route('careers.show', {id: obj.id})">
                {{ obj.name }}
                </Link>
                </td>
                <td>{{obj.description}}</td>
                <td>
                    <Link class="btn btn-primary btn-space" :href="route('careers.edit', {id: obj.id})">Edit</Link>
                    <Link class="btn btn-danger btn-space" :href="route('careers.confirmDelete', {id: obj.id})">Delete</Link>
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
