<template>
    <div class="form-group">
        <label for="name">{{ lblText }}</label>
        <input type="{{ type }}" class="form-control" id="{{ id }}" name="{{ name }}" :placeholder="placeholder" :value="modelValue" @input="updateValue">
    </div>

</template>

<script>
export default {
    props: {
        lblText: {
            required: true,
            type: String,
        },
        type: {
            required: true,
            type: String,
        },
        name: {
            required: true,
            type: String,
        },
        id: {
            required: true,
            type: String,
        },
        placeholder: {
            required: true,
            type: String,
        },
        modelValue: {
            type: String,
            default: ''
        },
    },
    methods: {
        updateValue(event) {
            this.$emit('update:modelValue', event.target.value);
        }
    }
}

</script>

<style scoped>

</style>
