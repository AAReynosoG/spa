<template>
        <AppLayout>
            <template #main>
                <formCard header="Add career">
                    <template #form>
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <inputForm  id="name" placeholder="Write career's name" name="name" type="text" lbl-text="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.name }"></inputForm>
                                <div class="invalid-feedback" v-if="form.errors.name">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="form-group">
                                <input-form id="description" placeholder="Write career's description" name="description" type="text" lbl-text="Description" v-model="form.description" :class="{ 'is-invalid': form.errors.description }"></input-form>
                                <div class="invalid-feedback" v-if="form.errors.description">
                                    {{ form.errors.description }}
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" :disabled="form.processing">Enviar</button>
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
