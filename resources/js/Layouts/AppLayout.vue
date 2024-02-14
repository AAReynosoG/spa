<template>
    <div class="d-flex flex-column min-vh-100">
        <Navbar></Navbar>
        <div class="container" style="overflow-y: auto; flex: 1;">
            <slot name="main"></slot>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
export default {
    components: {
        Navbar, Footer
    }
}
</script>

<style scoped>
.container {
    max-height: calc(100vh - 56px - 105px);
}
</style>
