<template>
    <div class="flex flex-col h-screen justify-between">
        <Navbar></Navbar>
        <div class="mb-auto overflow-auto">
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

</style>
