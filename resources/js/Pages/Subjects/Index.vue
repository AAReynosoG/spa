<template>
    <AppLayout>
        <template #main>
            <SubjectsTable :arr="arr"></SubjectsTable>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SubjectsTable from "@/Components/SubjectsTable.vue";
export default {
    props: {
        arr: Array
    },
    components: {
        AppLayout, SubjectsTable
    }
}
</script>

<style scoped>

</style>
