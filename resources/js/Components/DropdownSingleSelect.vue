<template>
    <label for="dropdown">Student's Career</label>
    <select class="form-control" id="dropdown" v-model="selectedItem" @change="fetchSubjects">
        <option v-if="items.length === 0">Nothing</option>
        <option v-else v-for="item in items" :key="item.id" :value="item.id">
            {{ item.name }}
        </option>
    </select>
    <div class="form-group" v-if="subjects">
        <DropdownMultiSelect :items="subjects" />
    </div>

</template>

<script setup>
import {ref} from 'vue';
import DropdownMultiSelect from "@/Components/DropdownMultiSelect.vue";
import axios from "axios";

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const selectedItem = ref(null);
const subjects = ref(null);
const fetchSubjects = async () => {
    try {
        const response = await axios.get('/api/fetch/subjects/' + selectedItem.value);
        console.log('subjects');
        subjects.value = response.data;
    } catch (error) {
        console.error(error);
    }
}
</script>
