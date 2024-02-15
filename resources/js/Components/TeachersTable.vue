<template>
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody v-if="arr.length > 0">
            <tr v-for="(obj, key) in arr" :key="key" scope="row">
                <td class="h-100">
                    <Link :href='route("teachers.show", {id: obj.id})' class="text-decoration-none">
                    {{ obj.name }} {{ obj.last_name }}
                    </Link>
                </td>
                <td>
                    {{ obj.email }}
                </td>
                <td>
                    {{ obj.phone }}
                </td>
                <td>
                    {{ obj.address }}
                </td>
                <td>
                    <Link class="btn btn-primary" :href="route('teachers.edit', {id: obj.id})">
                        Update
                    </Link>
                </td>
                <td>
                    <Link class="btn btn-danger" :href="route('teachers.confirmDelete', {id: obj.id})">
                        Delete
                    </Link>
                </td>
            </tr>
            </tbody>
            <tbody v-else>
            <tr class="w-100">
                <td v-if="loading">Loading...</td>
                <td v-else>There is nothing!</td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name:"arr",

    data(){
        return {
            loading: false,
        }
    },
    props: {
        arr: Array,
    },
    components: {
        Link,
    },

}
</script>
