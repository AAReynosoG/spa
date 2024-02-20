<template>
    <app-layout>
        <template #main>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col items-start">
                    <h1 class="text-3xl font-bold mt-4">{{ teacher.name }} {{ teacher.last_name }}</h1>
                    <p class="mt-2"><span class="font-bold">Email:</span> {{ teacher.email }}</p>
                    <p class="mt-2"><span class="font-bold">Phone:</span> {{ teacher.phone }}</p>
                    <p class="mt-2"><span class="font-bold">Address:</span> {{ teacher.address }}</p>
                    <h5 class="mt-3">Carreras que imparte el profesor(a):</h5>
                    <ul>
                        <li v-for="(careerData, careerId) in careers" :key="careerId">
                            <h3>{{ careerData.name }}</h3>
                        </li>
                    </ul>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="fetchSubjects(teacher.id)" v-if="!boolSubjects">Materias que imparte el profesor(a).</button>
                    <h5 v-if="boolSubjects"><strong>Materias:</strong> {{ subjects.map(subject => subject.name).join(', ') }}</h5>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="hideSubjects" v-if="boolSubjects">Ocultar materias.</button>
                </div>
            </div>
        </template>
    </app-layout>
</template>


<script>
import appLayout from "@/Layouts/AppLayout.vue";

export default {
    data(){
        return {
            boolTeachers: false,
            boolSubjects: false,
            subjects: [],
        }
    },
    components: {
        appLayout,
    },
    props:{
        teacher: Object,
        careers: Array
    },
    methods: {
        fetchSubjects(id) {
            axios.get(route('fetch.teacher_subjects', {id: id})).then(response => {
                this.subjects = response.data;
                this.boolSubjects = true;
            });
        },
        hideSubjects() {
            this.boolSubjects = false;
            this.subjects = [];
        }
    },
    mounted() {
    }
}
</script>

<style scoped>
</style>
