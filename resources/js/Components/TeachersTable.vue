<template>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edit</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" v-if="arr.length > 0">
            <tr v-for="(obj, key) in arr" :key="key" scope="row">
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link :href='route("teachers.show", {id: obj.id})' class="text-indigo-600 hover:text-indigo-900">
                        {{ obj.name }} {{ obj.last_name }}
                    </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ obj.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ obj.phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ obj.address }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link class="text-indigo-600 hover:text-indigo-900" :href="route('teachers.edit', {id: obj.id})">
                        Update
                    </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link class="text-red-600 hover:text-red-900" :href="route('teachers.confirmDelete', {id: obj.id})">
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
