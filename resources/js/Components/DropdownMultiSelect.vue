<template>
    <label for="dropdown">Career's subjects</label>
    <select class="form-control" id="dropdown" v-model="selectedItems" multiple @change="fetchTeachers">
        <option v-if="items.length === 0">Nothing</option>
        <option v-else v-for="item in items" :key="item.id" :value="item.id">
            {{ item.name }}
        </option>
    </select>
    <div class="form-group" v-for="item in selectedItems" :key="item">
        <DropdownSingleSelect2 :items="teachers" :subject="item"/>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DropdownSingleSelect2 from "@/Components/DropdownSingleSelect2.vue";

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const selectedItems = ref([]);
const teachers = ref([]);

const fetchTeachers = async () => {
    try {
        const response = await axios.get('/api/fetch/teachers/index');
        console.log('teachers');
        teachers.value = response.data;
    } catch (error) {
        console.error(error);
    }
}
</script>
