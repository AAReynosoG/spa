<template>
    <AppLayout>
        <template #main>
            <formCard header="Add Teacher">
                <template #form>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div>
                            <input-form id="name" placeholder="Write teacher's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'border-red-500': form.errors.name }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.name">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <input-form id="lastName" placeholder="Write teacher's last name" name="lastName" type="text" lbl-text="Last Name" v-model="form.last_name" :class="{ 'border-red-500': form.errors.lastName }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.last_name">{{ form.errors.last_name }}</p>
                        </div>
                        <div>
                            <input-form id="email" placeholder="Write teacher's email" name="email" type="email" lbl-text="Email" v-model="form.email" :class="{ 'border-red-500': form.errors.email }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.email">{{ form.errors.email }}</p>
                        </div>
                        <div>
                            <input-form id="phone" placeholder="Write teacher's phone" name="phone" type="text" lbl-text="Phone" v-model="form.phone" :class="{ 'border-red-500': form.errors.phone }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.phone">{{ form.errors.phone }}</p>
                        </div>
                        <div>
                            <input-form id="address" placeholder="Write teacher's address" name="address" type="text" lbl-text="Address" v-model="form.address" :class="{ 'border-red-500': form.errors.address }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.address">{{ form.errors.address }}</p>
                        </div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Enviar</button>
                    </form>
                </template>
            </formCard>
        </template>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import formCard from "@/Components/FormCard.vue";
import {useForm} from "@inertiajs/vue3";
import InputForm from "@/Components/InputForm.vue";

const form = useForm({
    name: null,
    last_name: null,
    email: null,
    phone: null,
    address: null,
});

const submitForm = () => {
    form.post(route('teachers.store'));
}

</script>
<style scoped>
.container {
    margin-top: 50px;
}
</style>
