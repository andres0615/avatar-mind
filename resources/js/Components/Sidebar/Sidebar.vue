<script setup>
import UserSection from '@/Components/Sidebar/UserSection.vue';
import Navigation from '@/Components/Sidebar/Navigation.vue';
import RecentChats from '@/Components/Sidebar/RecentChats.vue';
import Logout from '@/Components/Sidebar/Logout.vue';
</script>

<template>
    <!-- Sidebar -->
        <div class="w-72 bg-white border-r border-gray-200 flex flex-col">
            <UserSection />
            
            <Navigation />
            
            <RecentChats />
            
            <Logout />            
        </div>
</template>