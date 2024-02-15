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
                                <p>¿Estás seguro de modificar la carrera de la materia: {{ obj.name }} ?</p>
                                <p>Ten en cuenta que al realizar esta accion, si las materia esta siendo impartida de manera activa en otra carrera, se borraran los registros de esta.</p>
                                <button class="btn btn-danger btn-space" @click="updateObjRoute">Sí</button>
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
