<template>
    <app-layout>
        <template #main>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-4">{{ career.name }}</h1>
                        <p><strong>Description:</strong> {{ career.description }}</p>
                        <h5><strong>Materias:</strong> {{ subjects.map(subject => subject.name).join(', ') }}</h5>
                    </div>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import appLayout from "@/Layouts/AppLayout.vue";

export default {
    data(){
        return {
            subjects: [],
        }
    },
    components: {
        appLayout,
    },
    props:{
        career: Object,
        subjects: Array
    }
}
</script>

<style scoped>
</style>
