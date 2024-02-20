<template>
    <app-layout>
        <template #main>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col items-start">
                    <h1 class="text-3xl font-bold mt-4">{{ student.name }} {{ student.last_name }}</h1>
                    <p v-if="career" class="mt-2"><span class="font-bold">Career:</span> {{ career.name }}</p>
                    <p class="mt-2"><span class="font-bold">Email:</span> {{ student.email }}</p>
                    <p class="mt-2"><span class="font-bold">Phone:</span> {{ student.phone }}</p>
                    <p class="mt-2"><span class="font-bold">Address:</span> {{ student.address }}</p>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="hideTeachers" v-if="boolTeachers">Ocultar profesores.</button>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="fetchTeachers" v-if="!boolTeachers">Profesores que le imparten al alumno.</button>
                    <h5 class="mt-3" v-if="boolTeachers">Profesores: </h5>
                    <ul v-if="teachers">
                        <li v-for="(teacherData, teacherId) in teachers" :key="teacherId">
                            <h3><strong>{{ teacherData.teacher.name }} {{ teacherData.teacher.last_name }}</strong></h3>
                            <p>-><strong>Email:</strong> {{ teacherData.teacher.email }}</p>
                            <p>-><strong>Materias:</strong> {{ teacherData.subjects.join(', ') }}</p>
                        </li>
                    </ul>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-if="boolTeachers && !boolSubjects" @click="fetchSubjects" >Materias que cursa el alumno.</button>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-if="boolSubjects" @click="hideSubjects">Ocultar materias.</button>
                    <h5 class="mt-3" v-if="boolSubjects">Materias: </h5>
                    <ul v-if="subjects">
                        <li v-for="(subjectData, index) in subjects" :key="index">
                            <p><strong>Materia:</strong> {{ subjectData.name }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
    </app-layout>
</template>


<script>
import appLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";

export default {
    data(){
        return {
            career: null,
            teachers: {},
            subjects: {},
            boolTeachers: false,
            boolSubjects: false,
        }
    },
    components: {
        appLayout,
    },
    props: {
        student: Object,
    },
    methods: {
        fetchCareer() {
            try {
                axios.get(route('fetch.student_career', {id: this.student.id})).then(response => {
                    this.career = response.data;
                });
            } catch (error) {
                console.error(error);
            }
        },
        fetchTeachers() {
            try {
                axios.get(route('fetch.student_teachers', {id: this.student.id})).then(response => {
                    this.boolTeachers = true;
                    this.teachers = response.data;
                });
            } catch (error) {
                console.error(error);
            }
        },
        fetchSubjects() {
            try {
                axios.get(route('fetch.student_subjects', {id: this.student.id})).then(response => {
                    this.boolSubjects = true;
                    this.subjects = response.data;
                });
            } catch (error) {
                console.error(error);
            }
        },
        hideTeachers() {
            this.teachers = {};
            this.boolTeachers = false;
            this.subjects = {};
            this.boolSubjects = false;
        },
        hideSubjects() {
            this.subjects = {};
            this.boolSubjects = false;
        }

    },
    mounted() {
        this.fetchCareer();
    }
}
</script>

<style scoped>
</style>
