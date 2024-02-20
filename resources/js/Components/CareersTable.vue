<template>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Career</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="obj in arr" :key="obj.id">
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link :href="route('careers.show', {id: obj.id})" class="text-indigo-600 hover:text-indigo-900">
                        {{ obj.name }}
                    </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{obj.description}}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link class="text-indigo-600 hover:text-indigo-900 mr-4" :href="route('careers.edit', {id: obj.id})">Edit</Link>
                    <Link class="text-red-600 hover:text-red-900" :href="route('careers.confirmDelete', {id: obj.id})">Delete</Link>
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

</style>
