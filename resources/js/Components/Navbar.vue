<template>
    <nav class="bg-gray-800 p-2 mt-0 w-full">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex items-center px-2 lg:px-0 xl:w-1/4">
                    <div class="flex-shrink-0">
                        <Link class="text-white no-underline hover:text-white hover:no-underline" :href="route('main')">
                            Navbar
                        </Link>
                    </div>
                </div>
                <div class="flex justify-end lg:w-0 lg:block xl:w-1/4">
                    <div class="lg:block">
                        <div class="flex items-center">
                            <div class="flex space-x-4">
                                <Link class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" :href="route('students.create')">Enroll Student</Link>
                                <Link class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" :href="route('teachers.create')">Add Teacher</Link>
                                <Link class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" :href="route('careers.create')">Add Career</Link>
                                <Link class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" :href="route('subjects.create')">Add Subject</Link>
                                <div class="relative inline-block text-left">
                                    <button @click="toggleMenu" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                                        <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                        </svg>
                                    </button>
                                    <div v-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white" :href="route('students.index')">Students</Link>
                                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white" :href="route('teachers.index')">Teachers</Link>
                                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white" :href="route('careers.index')">Careers</Link>
                                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white" :href="route('subjects.index')">Subjects</Link>
                                            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white" :href="route('logout')" method="post">Logout</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    components: {
        Link
    },
    data() {
        return {
            open: false,
        }
    },
    methods: {
        toggleMenu() {
            this.open = !this.open;
        },
    }
}
</script>

<style scoped>

</style>
