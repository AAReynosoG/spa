<template>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Career</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in arr" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.career.name }}</td>
                    <td>
                        <Link class="btn btn-primary btn-space" :href="route('subjects.edit', {id: item.id})">Edit</Link>
                        <Link class="btn btn-danger btn-space" :href="route('subjects.confirmDelete', {id: item.id})">Delete</Link>
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
