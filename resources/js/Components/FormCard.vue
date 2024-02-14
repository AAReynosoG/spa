<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{header}}</div>
                    <div class="card-body">
                        <slot name="form"></slot>
                    </div>
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
