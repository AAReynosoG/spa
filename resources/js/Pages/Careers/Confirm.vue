<template>
    <AppLayout>
        <template #main>
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-5">
                        <div class="font-bold text-xl mb-2 text-white bg-red-500 p-3 rounded">Confirmación</div>
                        <p>¿Estás seguro de eliminar la carrera: {{ obj.name }} ?</p>
                        <p>Si deseas eliminar la carrera, los registros sobre los alumnos que están cursando, los profesores que están impartiendo, y las materias que se están impartiendo, serán borrados.</p>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 mr-2" @click="deleteObjRoute">Sí</button>
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
        deleteObj: {
            type: String,
            required: true
        },
        cancel: {
            type: String,
            required: true
        },
        obj: {
            type: Object,
            required: true
        }
    },
    methods: {
        async deleteObjRoute() {
            await this.$inertia.delete(this.deleteObj);
            this.$inertia.replace('/careers/index');
        },
        cancelRoute() {
            this.$inertia.replace('/careers/index');
        }
    }
}
</script>

<style scoped>
.btn-space{
    margin-right: 10px;
}
</style>
#
