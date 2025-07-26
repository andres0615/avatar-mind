<script setup>
// import { ref } from 'vue';
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
// import { Link } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar/Sidebar.vue';
import NotificationMessage from '@/Components/Layout/NotificationMessage.vue';

// const showingNavigationDropdown = ref(false);

function layoutType() {
    let layoutType = 'default';

    // si la ruta coincide con 'chat' devuelve 'chat', de lo contrario devuelve 'default'
    if (route().current('chat.*')) {
        layoutType = 'chat';
    }

    console.log('Layout type:', layoutType);

    return layoutType; // or 'authenticated' based on your logic
}

</script>

<template>
    <NotificationMessage/>

    <div class="flex h-screen">
        <Sidebar/>

        <template v-if="layoutType() === 'chat'">
            <slot/>
        </template>
        <!-- Main Content -->
        <main class="flex-1 overflow-auto" v-else>
            <div class="max-w-4xl mx-auto p-8">
                <slot/>               
            </div>
        </main>
    </div>

</template>