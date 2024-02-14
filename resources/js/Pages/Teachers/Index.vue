<template>
    <AppLayout>
        <template #main>
            <TeachersTable :arr="arr"></TeachersTable>
        </template>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TeachersTable from "@/Components/TeachersTable.vue";
export default {
    components: {
        AppLayout, TeachersTable
    },
    props: {
        arr: Array
    }
}
</script>
