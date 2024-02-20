<template>
    <div class="flex justify-center">
        <div class="w-full md:w-1/2 lg:w-1/3">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="font-bold text-xl mb-2">{{header}}</div>
                <div>
                    <slot name="form"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        header: {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>

</style>
