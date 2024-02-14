<template>
        <AppLayout>
            <template #main>
                <StudentForm></StudentForm>
            </template>
        </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import StudentForm from "@/Components/StudentForm.vue";
export default {
    components: {
        AppLayout, StudentForm
    }
}
</script>

