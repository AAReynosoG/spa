<template>
    <AppLayout>
        <template #main>
            <CareersTable :arr="arr"></CareersTable>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CareersTable from "@/Components/CareersTable.vue";
export default {
    components: {
        AppLayout, CareersTable
    },
    props: {
        arr: Array
    }
}

</script>

<style scoped>

</style>
