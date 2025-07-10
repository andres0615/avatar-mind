<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Bienvenido a AvatarMind</h1>
            <p class="text-xl text-gray-600 mb-8">Crea y chatea con personajes únicos con personalidad propia</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
                <a href="crear-personaje.html" class="block p-6 bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Crear Personaje</h3>
                    <p class="text-gray-600">Diseña un personaje único con personalidad propia</p>
                </a>

                <!-- <a href="chat.html" class="block p-6 bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Iniciar Chat</h3>
                    <p class="text-gray-600">Conversa con tus personajes favoritos</p>
                </a> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
