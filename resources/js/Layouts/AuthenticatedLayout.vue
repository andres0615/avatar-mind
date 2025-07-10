<script setup>
// import { ref } from 'vue';
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
// import { Link } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar/Sidebar.vue';

// const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex h-screen">
        <Sidebar/>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="max-w-4xl mx-auto p-8">
                <slot/>               
            </div>
        </main>
    </div>

</template>