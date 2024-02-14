<template>
    <AppLayout>
        <template #main>
            <div class="error-container">
                <h1 class="error-code">404</h1>
                <p class="error-text">¡Vaya! El recurso que estás buscando no se pudo encontrar.</p>
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
