<template>
    <AppLayout>
        <template #main>
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-5">
                        <div class="font-bold text-xl mb-2 text-white bg-red-500 p-3 rounded">Confirmación</div>
                        <p>¿Estás seguro de eliminar al profesor: {{ prof.name }} {{ prof.last_name }} con el email: {{ prof.email }} ?</p>
                        <p>Ten en cuenta que al realizar esta acción, si el profesor cuenta con materias activas, estos registros se borrarán.</p>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 mr-2" @click="deleteTeachertRoute">Sí</button>
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
        deleteTeacher: {
            type: String,
            required: true
        },
        cancel: {
            type: String,
            required: true
        },
        prof: {
            type: Object,
            required: true
        }
    },
    methods: {
        async deleteTeachertRoute() {
            await this.$inertia.delete(this.deleteTeacher);
            this.$inertia.replace('/teachers/index');
        },
        cancelRoute() {
            this.$inertia.replace('/teachers/index');
        }
    }
}
</script>

<style scoped>
.btn-space{
    margin-right: 10px;
}
</style>
