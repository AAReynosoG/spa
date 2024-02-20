<template>
    <app-layout>
        <template #main>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col items-start">
                    <h1 class="text-3xl font-bold mt-4">{{ career.name }}</h1>
                    <p class="mt-2"><span class="font-bold">Description:</span> {{ career.description }}</p>
                    <h5 class="mt-2"><span class="font-bold">Materias:</span> {{ subjects.map(subject => subject.name).join(', ') }}</h5>
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
#
