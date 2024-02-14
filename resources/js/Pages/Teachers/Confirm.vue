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
                                <p>¿Estás seguro de eliminar al profesor: {{ prof.name }} {{ prof.last_name }} con el email: {{ prof.email }} ?</p>
                                <p>Ten en cuenta que al realizar esta accion, si el profesor cuenta con materias activas, estos registros se borraran.</p>
                                <button class="btn btn-danger btn-space" @click="deleteTeachertRoute">Sí</button>
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
