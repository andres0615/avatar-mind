<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Editar Personaje</h1>
                <p class="text-lg text-gray-600">Modifica las características de tu personaje</p>
            </div>

            <button class="flex items-center space-x-2 px-4 py-2 text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <span class="text-sm font-medium">Eliminar Personaje</span>
            </button>
        </div>

        <form class="space-y-8">
            <!-- Información Básica -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Básica</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del personaje *</label>
                        <input type="text" value="Naruto Uzumaki" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option selected>Anime</option>
                            <option>Videojuegos</option>
                            <option>Películas</option>
                            <option>Libros</option>
                            <option>Histórico</option>
                            <option>Original</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tagline/Descripción corta</label>
                    <input type="text" value="El ninja que nunca se rinde" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" maxlength="100">
                    <div class="mt-1 text-xs text-gray-500 text-right">32/100</div>
                </div>
            </div>

            <!-- Personalidad -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Personalidad y Trasfondo</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción de personalidad</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" maxlength="500">Naruto es un ninja enérgico y determinado que nunca se rinde ante las adversidades. Es leal a sus amigos y siempre busca proteger a su aldea. Aunque puede ser impulsivo y testarudo, tiene un gran corazón y la capacidad de inspirar a otros.</textarea>
                        <div class="mt-1 text-xs text-gray-500 text-right">245/500</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad</label>
                            <input type="text" value="16 años" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ocupación</label>
                            <input type="text" value="Ninja de Konoha" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Intereses/Hobbies</label>
                        <div class="flex flex-wrap gap-2 p-3 border border-gray-200 rounded-lg min-h-12" id="edit-interests-container">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Ramen <button type="button" class="ml-1 text-blue-600">×</button>
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Entrenamiento <button type="button" class="ml-1 text-green-600">×</button>
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                Proteger amigos <button type="button" class="ml-1 text-purple-600">×</button>
                            </span>
                            <input type="text" class="flex-1 min-w-32 outline-none text-sm" placeholder="Agregar interés..." id="edit-interests-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración de Conversación -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Configuración de Conversación</h2>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estilo de conversación</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option selected>Casual</option>
                                <option>Formal</option>
                                <option>Técnico</option>
                                <option>Divertido</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Idioma principal</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option selected>Español</option>
                                <option>English</option>
                                <option>Français</option>
                                <option>Deutsch</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Creatividad: <span class="text-blue-600 font-semibold" id="edit-creativity-value">8</span>
                        </label>
                        <input type="range" min="1" max="10" value="8" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider" id="edit-creativity-slider">
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Conservador</span>
                            <span>Creativo</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-between">
                <button type="button" class="flex items-center space-x-2 px-6 py-3 text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <span>Eliminar Personaje</span>
                </button>

                <div class="flex space-x-4">
                    <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Cancelar</button>
                    <button type="submit" class="flex items-center space-x-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h2m0 0h9a2 2 0 002-2V9a2 2 0 00-2-2h-2m0 0V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2m0 0h4"></path>
                        </svg>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </div>
        </form>          
    </AuthenticatedLayout>
</template>