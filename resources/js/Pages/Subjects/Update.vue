<template>
    <AppLayout>
        <template #main>
            <form-card header="Update subject">
                <template #form>
                    <form @submit.prevent="submitForm">
                        <div class="form-group">
                            <input-form  id="name" placeholder="Write subject's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dropdownCareer">Subject's Career</label>
                            <select :class="{ 'is-invalid': form.errors.career_id }" class="form-control" id="dropdownCareer" v-model="form.career_id">
                                <option v-if="careers.length === 0">Nothing</option>
                                <option v-else v-for="item in careers" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <div class="invalid-feedback" v-if="form.errors.career_id">
                                {{ form.errors.career_id }}
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" :disabled="form.processing">Enviar</button>
                        <Link class="btn btn-danger" :href="route('subjects.index')">Cancel</Link>
                    </form>
                </template>
            </form-card>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormCard from "@/Components/FormCard.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputForm from "@/Components/InputForm.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

const careers = ref([]);


const props = defineProps({
    subject: Object,
});

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
    name: props.subject.name,
    career_id: props.subject.career_id
})

const submitForm = () => {
    form.put(route('subjects.update', {id: props.subject.id}),
        {
            preserveState: true,
            onSuccess: () => this.$inertia.replace(route('subjects.index')),
        }
    );
}
onMounted(fetchCareers);
</script>

<style scoped>
.container {
    margin-top: 50px;
}
</style>
