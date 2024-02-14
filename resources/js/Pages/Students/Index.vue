<template>
    <AppLayout>
        <template #main>
            <DataTable :arr="arr"></DataTable>
        </template>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from "@/Components/DataTable.vue";
export default {
    components: {
        AppLayout, DataTable
    },
    props: {
        arr: Array
    }
}
</script>
