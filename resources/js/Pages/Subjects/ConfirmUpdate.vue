<template>
    <AppLayout>
        <template #main>
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-5">
                        <div class="font-bold text-xl mb-2 text-white bg-red-500 p-3 rounded">Confirmación</div>
                        <p>¿Estás seguro de modificar la carrera de la materia: {{ obj.name }} ?</p>
                        <p>Ten en cuenta que al realizar esta acción, si las materia está siendo impartida de manera activa en otra carrera, se borrarán los registros de esta.</p>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 mr-2" @click="updateObjRoute">Sí</button>
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
        visitRoute: {
            type: String,
            required: true
        },
        updateObj: {
            type: Number,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        obj: {
            type: Object,
            required: true
        }
    },
    methods: {
        async updateObjRoute() {
            await this.$inertia.put(this.visitRoute, {
                name: this.name,
                career_id: this.updateObj
            });
            this.$inertia.replace('/subjects/index');
        }
        ,
        cancelRoute() {
            this.$inertia.replace('/subjects/index');
        }
    }
}
</script>

<style scoped>
.btn-space{
    margin-right: 10px;
}
</style>
