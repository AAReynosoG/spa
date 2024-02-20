<template>
    <AppLayout>
        <template #main>
            <div class="error-container">
                <p class="error-text">Empty table.</p>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    components: {
        AppLayout
    }
}
</script>

<style scoped>
.error-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

.error-code {
    font-size: 6em;
    color: #ff0000;
}

.error-text {
    font-size: 2em;
    margin-bottom: 1em;
}

.error-link {
    color: #007bff;
    text-decoration: none;
}
</style>
#
