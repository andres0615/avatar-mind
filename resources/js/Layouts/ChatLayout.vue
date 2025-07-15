<script setup>
import Sidebar from '@/Components/Sidebar/Sidebar.vue';
import NotificationMessage from '@/Components/Layout/NotificationMessage.vue';
</script>

<template>
    <NotificationMessage/>

    <div class="flex h-screen">
        <Sidebar/>

        <!-- Main Content -->
        <slot/>
    </div>

</template>