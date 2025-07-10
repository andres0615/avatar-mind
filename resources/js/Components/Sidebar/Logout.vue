<script setup>
import { Link, router } from '@inertiajs/vue3';

function logout() {
    router.post(route('logout'));
}
</script>

<template>
    <!-- Logout -->
    <div class="p-4 border-t border-gray-100">
        <button 
        class="w-full flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors"
        @click="logout">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span class="text-sm font-medium">Cerrar Sesión</span>
        </button>
    </div>
</template>