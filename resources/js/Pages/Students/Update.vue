<template>
    <app-layout>
        <template #main>
            <FormCard header="Update Student">
                <template #form>
                    <form @submit.prevent="submitForm()">
                        <div class="form-group">
                            <input-form id="name" placeholder="Write student's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form id="last_name" placeholder="Write stuendt's last name" name="last_name" type="text" lbl-text="Last name" v-model="form.last_name" :class="{ 'is-invalid': form.errors.last_name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.last_name">
                                {{ form.errors.last_name}}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form :class="{ 'is-invalid': form.errors.email }" id="email" placeholder="Write stuendt's email" name="email" type="email" lbl-text="Email" v-model="form.email"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form :class="{ 'is-invalid': form.errors.phone }" id="Phone" placeholder="Write stuendt's phone" name="phone" type="number" lbl-text="Phone" v-model="form.phone"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.phone">
                                {{ form.errors.phone }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form :class="{ 'is-invalid': form.errors.address }" id="address" placeholder="Write stuendt's address" name="address" type="text" lbl-text="Address" v-model="form.address"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.address">
                                {{ form.errors.address }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dropdownCareer">Student's Career</label>
                            <select class="form-control" id="dropdownCareer" v-model="selectedItemCareer" @change="updateCareer">
                                <option v-if="careers.length === 0">Nothing</option>
                                <option v-else v-for="item in careers" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group"  style="max-height: 90px; overflow-y: auto;">
                            <label>Career's subjects</label>
                            <div v-for="item in subjects" :key="item.id">
                                <input type="checkbox" :value="item.id" v-model="selectedItemsSubjects" @change="updateSubjects"
                                       :disabled="selectedItemsSubjects.length >= maxSelections && !selectedItemsSubjects.includes(item.id)" :class="{ 'is-invalid': form.errors.subjects }">
                                <label>{{ item.name }}</label>
                            </div>
                            <div class="invalid-feedback" v-if="form.errors.subjects">
                                {{ form.errors.subjects }}
                            </div>
                        </div>
                        <div style="max-height: 130px; overflow-y: auto;">
                            <div class="form-group" v-for="(item, index) in selectedItemsSubjects" :key="item">
                                <label for="dropdownTeachers">Teacher for {{ subjects.find(subject => subject.id === item).name }} </label>
                                <select :class="{ 'is-invalid': form.errors.teachers }" class="form-control" id="dropdownTeachers" v-model="selectedItemTeachers[index]">
                                    <option v-if="teachers.length === 0">Nothing</option>
                                    <option v-else v-for="item in teachers" :key="item.id" :value="item.id">
                                        Name: {{ item.name }} | Email: {{item.email}}
                                    </option>
                                </select>
                                <div class="invalid-feedback" v-if="form.errors.teachers">
                                    {{ form.errors.teachers }}
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Update</button>
                        <Link class="btn btn-danger btn-space" :href="route('students.index')">Cancel</Link>
                    </form>
                </template>
            </FormCard>
        </template>
    </app-layout>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import axios from "axios";
import FormCard from "@/Components/FormCard.vue";
import InputForm from "@/Components/InputForm.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';

const selectedItemTeachers = ref([]);
const teachers = ref([]);
const selectedItemsSubjects = ref([]);
const subjects = ref([]);
const careers = ref([]);
const selectedItemCareer = ref(null);
const selectedSubjects = ref([]);
const selectedTeachers = ref([]);
const click = ref(0)

const maxSelections = 8;


const count = () => {
    if (selectedItemsSubjects.value === []){
        click.value++;
        console.log("Debug 1", click.value);
    }
    console.log("Debug 2", click.value);
}

const props = defineProps({
    student: Object
});

const studentCareer = async () => {
    try {
        const response = await axios.get(route('fetch.student_career', {id: props.student.id}))
            fetchCareers();
            selectedItemCareer.value = response.data.id;
            console.log(selectedItemCareer.value)
            await studentTeachers();
            await studentSubjects();
            await fetchSubjects()
            await fetchTeachers();
    } catch (error) {
        console.error(error);
    }
}

const studentSubjects = async () => {
    try {
        const response = await axios.get(route('fetch.student_selected_subjects', {id: props.student.id}))
            selectedSubjects.value = response.data.map(subject => subject.id);
    } catch (error) {
        console.error(error);
    }
}

const studentTeachers = async () => {
    try {
        const response = await axios.get(route('fetch.student_selected_teachers', {id: props.student.id}));
        selectedTeachers.value = response.data.map(teacher => teacher.id);
        console.log(selectedTeachers.value);
    } catch (error) {
        console.error(error);
    }
}

const fetchCareers = async () =>{
    try {
        const response = await axios.get(route('fetch.careers'));
        console.log('careers');
        careers.value = response.data;
        console.log(careers.value);
    } catch (error) {
        console.error(error);
    }
}

const fetchSubjects = async () => {
    if (selectedItemCareer.value) {
        try {
            await studentSubjects();
            const response = await axios.get(route('fetch.subjects', {careerId: selectedItemCareer.value}));
            subjects.value = response.data;
            selectedItemsSubjects.value = selectedSubjects.value;
        } catch (error) {
            console.error(error);
        }
    } else {
        console.error("No career selected");
    }
}

const fetchTeachers = async () => {
    if (selectedItemsSubjects.value && selectedItemsSubjects.value.length > 0) {
        try {
            const response = await axios.get(route('fetch.teachers'));
            console.log('teachers');
            teachers.value = response.data;
            selectedItemTeachers.value = selectedTeachers.value;
        } catch (error) {
            console.error(error);
        }
    } else {
        console.error("No subjects selected");
    }
}

const updateSubjects = () => {
    count();
    if (click.value === 1) {
        selectedItemTeachers.value = [];
    }
}
const updateCareer = async () => {
    click.value = 0;
    await fetchSubjects();
    await fetchTeachers();
    selectedItemsSubjects.value = [];
    selectedItemTeachers.value = [];
}

const form = useForm({
    name: props.student.name,
    last_name: props.student.last_name,
    email: props.student.email,
    phone: props.student.phone,
    address: props.student.address,
    teachers: null,
    subjects: null
});

const submitForm = () => {

    form.teachers = selectedItemTeachers.value;
    form.subjects = selectedItemsSubjects.value;
    form.put(route('students.update', {id: props.student.id}),
        {
            preserveState: true,
            onSuccess: () => this.$inertia.replace(route('students.index')),
        }
    );
}
onMounted(studentCareer);
</script>

<style scoped>
.container {
    margin-top: 50px;
}
.btn-space{
    margin-right: 15px;
}
</style>
