<template>
    <FormCard header="Enroll Student">
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
                    <select class="form-control" id="dropdownCareer" v-model="selectedItemCareer" @change="fetchSubjects">
                        <option v-if="careers.length === 0">Nothing</option>
                        <option v-else v-for="item in careers" :key="item.id" :value="item.id">
                            {{ item.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group"  style="max-height: 90px; overflow-y: auto;">
                    <label>Career's subjects</label>
                    <div v-for="item in subjects" :key="item.id">
                        <input type="checkbox" :value="item.id" v-model="selectedItemsSubjects" @change="fetchTeachers"
                               :disabled="selectedItemsSubjects.length >= maxSelections && !selectedItemsSubjects.includes(item.id)" :class="{ 'is-invalid': form.errors.subjects }">
                        <label>{{ item.name }}</label>
                    </div>
                    <div class="invalid-feedback" v-if="form.errors.subjects">
                        {{ form.errors.subjects }}
                    </div>
                </div>
                <div style="max-height: 130px; overflow-y: auto;">
                    <div class="form-group" v-for="(selectedItem, index) in selectedItemsSubjects" :key="selectedItem">
                        <label for="dropdownTeachers">Teacher for {{ subjects.find(subject => subject.id === selectedItem).name }}</label>
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
                <button type="submit" class="btn btn-primary" :disabled="form.processing">Enviar</button>
            </form>
        </template>
    </FormCard>
</template>

<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import axios from "axios";
import FormCard from "@/Components/FormCard.vue";
import InputForm from "@/Components/InputForm.vue";

const selectedItemTeachers = ref([]);
const teachers = ref([]);
const selectedItemsSubjects = ref([]);
const subjects = ref([]);
const careers = ref([]);
const selectedItemCareer = ref(null);

const maxSelections = 8;

const fetchCareers = async () =>{
    try {
        const response = await axios.get(route('fetch.careers'));
        console.log('careers');
        careers.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

const fetchSubjects = async () => {
    if (selectedItemCareer.value) {
        try {
            const response = await axios.get(route('fetch.subjects', {careerId: selectedItemCareer.value}));
            console.log('subjects');
            subjects.value = response.data;
            selectedItemsSubjects.value = [];
            selectedItemTeachers.value = [];
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
            selectedItemTeachers.value = [];
        } catch (error) {
            console.error(error);
        }
    } else {
        console.error("No subjects selected");
    }
}


const form = useForm({
    name: null,
    last_name: null,
    email: null,
    phone: null,
    address: null,
    teachers: null,
    subjects: null
});

const submitForm = () => {
    if (selectedItemsSubjects.value.length === 0 || selectedItemCareer.value === null) {
        alert("You must select at least one subject and a career");
    }

    form.teachers = selectedItemTeachers.value;
    form.subjects = selectedItemsSubjects.value;
    console.log(form);
    form.post(route('students.store'));
}
onMounted(fetchCareers);
</script>

<style scoped>
.container {
    margin-top: 50px;
}
</style>
