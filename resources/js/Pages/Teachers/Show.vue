<template>
    <app-layout>
        <template #main>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-4">{{ teacher.name }} {{ teacher.last_name }}</h1>
                        <p><strong>Email:</strong> {{ teacher.email }}</p>
                        <p><strong>Phone:</strong> {{ teacher.phone }}</p>
                        <p><strong>Address:</strong> {{ teacher.address }}</p>
                        <h5 class="mt-3">Carreras que imparte el profesor(a):</h5>
                        <ul>
                            <li v-for="(careerData, careerId) in careers" :key="careerId">
                                <h3>{{ careerData.name }}</h3>
                            </li>
                        </ul>
                        <h5 class="mt-3" @click="fetchSubjects(teacher.id)" v-if="!boolSubjects">Materias que imparte el profesor(a).</h5>
                        <h5 v-if="boolSubjects"><strong>Materias:</strong> {{ subjects.map(subject => subject.name).join(', ') }}</h5>
                        <h6 class="mt-3" @click="hideSubjects" v-if="boolSubjects">Ocultar materias.</h6>
                    </div>
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
