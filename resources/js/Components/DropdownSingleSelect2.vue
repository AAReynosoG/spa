<template>
    <label for="dropdown">Teacher for subject</label>
    <select class="form-control" id="dropdown" v-model="selectedItem">
        <option v-if="items.length === 0">Nothing</option>
        <option v-else v-for="item in items" :key="item.id" :value="item.id">
            {{ item.name }}
        </option>
    </select>
</template>

<script setup>
import {ref} from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const selectedItem = ref(null);
</script>
