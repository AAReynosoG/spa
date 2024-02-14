<template>
    <AppLayout>
        <template #main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mt-5">
                            <div class="card-header bg-danger text-white">
                                <h3>Confirmación</h3>
                            </div>
                            <div class="card-body">
                                <p>¿Estás seguro de eliminar la carrera: {{ obj.name }} ?</p>
                                <p>Ten en cuenta que al realizar esta accion, si las materias estan activas se borraran los registros de estas.</p>
                                <button class="btn btn-danger btn-space" @click="deleteObjRoute">Sí</button>
                                <button class="btn btn-secondary btn-space" @click="cancelRoute">No</button>
                            </div>
                        </div>
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
            this.$inertia.replace('/subjects/index');
        },
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
