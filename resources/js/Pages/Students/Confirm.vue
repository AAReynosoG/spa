<template>
    <AppLayout>
        <template #main>
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-5">
                        <div class="font-bold text-xl mb-2 text-white bg-red-500 p-3 rounded">Confirmación</div>
                        <p>¿Estás seguro de eliminar al estudiante: {{ student.name }} {{ student.last_name }} con el email: {{ student.email }} ?</p>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 mr-2" @click="deleteStudentRoute">Sí</button>
                        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4" @click="cancelRoute">No</button>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    components: {
        AppLayout
    },
    props: {
        deleteStudent: {
            type: String,
            required: true
        },
        cancel: {
            type: String,
            required: true
        },
        student: {
            type: Object,
            required: true
        }
    },
    methods: {
        async deleteStudentRoute() {
            await this.$inertia.delete(this.deleteStudent);
            this.$inertia.replace('/students/index');
        },
        cancelRoute() {
            this.$inertia.replace('/students/index');
        }
    }
}
</script>

<style scoped>
.btn-space{
    margin-right: 10px;
}
</style>
