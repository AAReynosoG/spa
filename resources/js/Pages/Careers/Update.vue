<template>
    <AppLayout>
        <template #main>
            <formCard header="Update career">
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
                        <Link class="btn btn-danger" :href="route('careers.index')" @click="cancel">Cancel</Link>
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
import {Link, useForm} from "@inertiajs/vue3";

const props = defineProps({
    career: Object,
});

const form = useForm({
    name: props.career.name,
    description: props.career.description
})

const submitForm = () => {
    form.put(route('careers.update', {id: props.career.id}), {
        preserveState: true,
        onSuccess: () => {
            this.$inertia.visit(route('careers.index'), { replace: true });
        }
    });
}

const cancel = () => {
    this.$inertia.replace(route('careers.index'));
}

</script>

<style scoped>
.container {
    margin-top: 50px;
}
</style>
