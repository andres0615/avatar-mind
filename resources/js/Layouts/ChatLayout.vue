<script setup>
import Sidebar from '@/Components/Sidebar/Sidebar.vue';
</script>

<template>
    <div class="flex h-screen">
        <Sidebar/>

        <!-- Main Content -->
        <slot/>
    </div>

</template>