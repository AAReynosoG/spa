<template>
    <AppLayout>
        <template #main>
            <form-card header="Add subject">
                <template #form>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div>
                            <input-form id="name" placeholder="Write subject's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'border-red-500': form.errors.name }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.name">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label for="dropdownCareer" class="block text-sm font-medium text-gray-700">Subject's Career</label>
                            <select :class="{ 'border-red-500': form.errors.career_id }" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="dropdownCareer" v-model="form.career_id">
                                <option v-if="careers.length === 0">Nothing</option>
                                <option v-else v-for="item in careers" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.career_id">{{ form.errors.career_id }}</p>
                        </div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Enviar</button>
                    </form>
                </template>
            </form-card>
        </template>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormCard from "@/Components/FormCard.vue";
import {useForm} from "@inertiajs/vue3";
import InputForm from "@/Components/InputForm.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

const careers = ref([]);

const fetchCareers = async () =>{
    try {
        const response = await axios.get('/api/fetch/careers');
        console.log('careers');
        careers.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

const form = useForm({
    name: null,
    career_id: null
})

const submitForm = () => {
    form.post('/subjects/store');
}
onMounted(fetchCareers);
</script>

<style scoped>
.container {
    margin-top: 50px;
}
</style>
