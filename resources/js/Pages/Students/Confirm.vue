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
                                <p>¿Estás seguro de eliminar al estudiante: {{ student.name }} {{ student.last_name }} con el email: {{ student.email }} ?</p>
                                <button class="btn btn-danger btn-space" @click="deleteStudentRoute">Sí</button>
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
