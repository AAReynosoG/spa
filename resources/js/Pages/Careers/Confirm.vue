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
                                <p>Si deseas eliminar la carrera, los registros sobre los alumnos que estan cursando, los profesores que estan impartiendo, y las materias que se estan impartiendo, seran borrados.</p>
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
