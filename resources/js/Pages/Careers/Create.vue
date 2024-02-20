<template>
    <AppLayout>
        <template #main>
            <formCard header="Add career">
                <template #form>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div>
                            <inputForm id="name" placeholder="Write career's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'border-red-500': form.errors.name }"></inputForm>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.name">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <input-form id="description" placeholder="Write career's description" name="description" type="text" lbl-text="Description" v-model="form.description" :class="{ 'border-red-500': form.errors.description }"></input-form>
                            <p class="text-red-500 text-xs italic" v-if="form.errors.description">{{ form.errors.description }}</p>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :disabled="form.processing">Enviar</button>
                    </form>
                </template>
            </formCard>
        </template>
    </AppLayout>
</template>


<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormCard from "@/Components/FormCard.vue";
import InputForm from "@/Components/InputForm.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    name: null,
    description: null
})

const submitForm = () => {
    form.post('/careers/store');
}

</script>

<style scoped>
.container {
    margin-top: 50px;
}
</style>
#
