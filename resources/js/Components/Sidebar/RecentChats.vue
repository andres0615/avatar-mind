<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Recent Chats -->
    <div class="flex-1 p-4">
        <div class="mb-4">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Chats Recientes</h4>
            <div class="relative">
                <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Buscar en historial..." class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="space-y-2" id="recent-chats">
            <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 1 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">N</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Naruto Uzumaki</p>
                        <p class="text-xs text-gray-500">2 min ago</p>
                    </div>
                </Link>
            </div>
            <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 2 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">H</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Hermione Granger</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </Link>
            </div>
            <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 2 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">H</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Hermione Granger</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </Link>
            </div>
            <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 2 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">H</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Hermione Granger</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </Link>
            </div>
            <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 2 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">H</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Hermione Granger</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>