<template>
    <AppLayout>
        <template #main>
            <formCard header="Update Teacher">
                <template #form>
                    <form @submit.prevent="submitForm">
                        <div class="form-group">
                            <input-form id="name" placeholder="Write teacher's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form id="name" placeholder="Write teacher's last name" name="name" type="text" lbl-text="Name" v-model="form.last_name" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.last_name">
                                {{ form.errors.last_name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form id="email" placeholder="Write student's email" name="email" type="email" lbl-text="Email" v-model="form.email" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form id="phone" placeholder="Write teacher's phone" name="phone" type="text" lbl-text="Phone" v-model="form.phone" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.phone">
                                {{ form.errors.phone }}
                            </div>
                        </div>
                        <div class="form-group">
                            <input-form id="email" placeholder="Write teacher's address" name="address" type="text" lbl-text="Address" v-model="form.address" :class="{ 'is-invalid': form.errors.name }"></input-form>
                            <div class="invalid-feedback" v-if="form.errors.address">
                                {{ form.errors.address }}
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Enviar</button>
                        <Link class="btn btn-danger" :href="route('teachers.index')">Cancel</Link>
                    </form>
                </template>
            </formCard>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import formCard from "@/Components/FormCard.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputForm from "@/Components/InputForm.vue";
import empty from "@/Pages/Errors/Empty.vue";

const props = defineProps({
    teacher: Object,
});

const form = useForm({
    name: props.teacher.name,
    last_name: props.teacher.last_name,
    email: props.teacher.email,
    phone: props.teacher.phone,
    address: props.teacher.address,
});

const submitForm = () => {
    form.put(route('teachers.update', {id: props.teacher.id}),
    {
            preserveState: true,
            onSuccess: () => this.$inertia.replace(route('teachers.index')),
          }
    );
}

</script>
<style scoped>
.container {
    margin-top: 50px;
}
</style>
