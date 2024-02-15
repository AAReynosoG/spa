<template>
    <app-layout>
        <template #main>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-4">{{ student.name }} {{ student.last_name }}</h1>
                        <p v-if="career"><strong>Career:</strong> {{ career.name }}</p>
                        <p><strong>Email:</strong> {{ student.email }}</p>
                        <p><strong>Phone:</strong> {{ student.phone }}</p>
                        <p><strong>Address:</strong> {{ student.address }}</p>
                        <h5 class="mt-3" @click="hideTeachers" v-if="boolTeachers">Ocultar profesores.</h5>
                        <h5 class="mt-3" @click="fetchTeachers" v-if="!boolTeachers">Profesores que le imparten al alumno.</h5>
                        <h5 class="mt-3" v-if="boolTeachers">Profesores: </h5>
                        <ul v-if="teachers">
                            <li v-for="(teacherData, teacherId) in teachers" :key="teacherId">
                                <h3>{{ teacherData.teacher.name }} {{ teacherData.teacher.last_name }}</h3>
                                <p><strong>Email:</strong> {{ teacherData.teacher.email }}</p>
                                <p><strong>Materias:</strong> {{ teacherData.subjects.join(', ') }}</p>
                            </li>
                        </ul>
                        <h5 class="mt-3" v-if="boolTeachers" @click="fetchSubjects" >Materias que cursa el alumno.</h5>
                        <h5 class="mt-3" v-if="boolSubjects" @click="hideSubjects">Ocultar materias.</h5>
                        <h5 class="mt-3" v-if="boolSubjects">Materias: </h5>
                        <ul v-if="subjects">
                            <li v-for="(subjectData, index) in subjects" :key="index">
                                <p><strong>Materia:</strong> {{ subjectData.name }}</p>
                            </li>
                        </ul>
                    </div>
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
