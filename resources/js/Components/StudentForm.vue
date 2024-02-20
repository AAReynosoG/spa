<template>
    <FormCard header="Enroll Student">
        <template #form>
            <form @submit.prevent="submitForm()"  class="space-y-4">
                <div>
                    <input-form id="name" placeholder="Write student's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.name }"></input-form>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.name">
                        {{ form.errors.name }}
                    </p>
                </div>
                <div>
                    <input-form id="last_name" placeholder="Write stuendt's last name" name="last_name" type="text" lbl-text="Last name" v-model="form.last_name" :class="{ 'is-invalid': form.errors.last_name }"></input-form>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.last_name">
                        {{ form.errors.last_name}}
                    </p>
                </div>
                <div>
                    <input-form :class="{ 'is-invalid': form.errors.email }" id="email" placeholder="Write stuendt's email" name="email" type="email" lbl-text="Email" v-model="form.email"></input-form>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.email">
                        {{ form.errors.email }}
                    </p>
                </div>
                <div>
                    <input-form :class="{ 'is-invalid': form.errors.phone }" id="Phone" placeholder="Write stuendt's phone" name="phone" type="number" lbl-text="Phone" v-model="form.phone"></input-form>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.phone">
                        {{ form.errors.phone }}
                    </p>
                </div>
                <div>
                    <input-form :class="{ 'is-invalid': form.errors.address }" id="address" placeholder="Write stuendt's address" name="address" type="text" lbl-text="Address" v-model="form.address"></input-form>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.address">
                        {{ form.errors.address }}
                    </p>
                </div>
                <div>
                    <label for="dropdownCareer" class="block text-sm font-medium text-gray-700">Student's Career</label>
                    <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="dropdownCareer" v-model="selectedItemCareer" @change="fetchSubjects">
                        <option v-if="careers.length === 0">Nothing</option>
                        <option v-else v-for="item in careers" :key="item.id" :value="item.id">
                            {{ item.name }}
                        </option>
                    </select>
                </div>
                <div class="overflow-auto h-20">
                    <label class="block text-sm font-medium text-gray-700">Career's subjects</label>
                    <div v-for="item in subjects" :key="item.id" class="flex items-center mt-2">
                        <input type="checkbox" :value="item.id" v-model="selectedItemsSubjects" @change="fetchTeachers"
                               :disabled="selectedItemsSubjects.length >= maxSelections && !selectedItemsSubjects.includes(item.id)" :class="{ 'border-red-500': form.errors.subjects }" class="form-checkbox h-5 w-5 text-indigo-600">
                        <label class="ml-2 text-sm text-gray-900">{{ item.name }}</label>
                    </div>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.subjects">{{ form.errors.subjects }}</p>
                </div>
                <p class="text-red-500 text-xs italic" v-if="showErrorMsg">The number of teachers selected must be equal to the number of subjects selected.</p>
                <div class="overflow-auto h-20">
                    <div class="form-group" v-for="(selectedItem, index) in selectedItemsSubjects" :key="selectedItem">
                        <label for="dropdownTeachers" class="block text-sm font-medium text-gray-700">Teacher for {{ subjects.find(subject => subject.id === selectedItem).name }}</label>
                        <select :class="{ 'border-red-500': form.errors.teachers }" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="dropdownTeachers" v-model="selectedItemTeachers[index]">
                            <option v-if="teachers.length === 0">Nothing</option>
                            <option v-else v-for="item in teachers" :key="item.id" :value="item.id">
                                Name: {{ item.name }} | Email: {{item.email}}
                            </option>
                        </select>
                        <p class="text-red-500 text-xs italic" v-if="form.errors.teachers">{{ form.errors.teachers }}</p>
                    </div>
                </div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Enviar</button>
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

const showErrorMsg = ref(false);

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
#
