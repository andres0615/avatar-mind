<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Crear Personaje</h1>
            <p class="text-lg text-gray-600">Crea un personaje único con personalidad propia</p>
        </div>

        <form class="space-y-8">
            <!-- Información Básica -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Básica</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del personaje *</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ej: Naruto Uzumaki">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>Seleccionar categoría</option>
                            <option>Anime</option>
                            <option>Videojuegos</option>
                            <option>Películas</option>
                            <option>Libros</option>
                            <option>Histórico</option>
                            <option>Original</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tagline/Descripción corta (100 caracteres max)</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Una breve descripción del personaje..." maxlength="100">
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Visibilidad</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="visibility" value="public" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Público</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="visibility" value="private" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Privado</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="visibility" value="friends" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Solo amigos</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Personalidad y Trasfondo -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Personalidad y Trasfondo</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción de personalidad (500 palabras max)</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Describe la personalidad del personaje..." maxlength="500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ej: 16 años">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ocupación</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ej: Ninja">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Intereses/Hobbies</label>
                        <div class="flex flex-wrap gap-2 p-3 border border-gray-200 rounded-lg min-h-12" id="interests-container">
                            <input type="text" class="flex-1 min-w-32 outline-none text-sm" placeholder="Agregar interés..." id="interests-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración Avanzada -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Configuración Avanzada</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Creatividad: <span class="text-blue-600 font-semibold" id="creativity-value">7</span>
                        </label>
                        <input type="range" min="1" max="10" value="7" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider" id="creativity-slider">
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Conservador</span>
                            <span>Creativo</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Longitud de respuestas</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="length" value="short" class="text-blue-600">
                                <span class="text-sm text-gray-700">Corta</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="length" value="medium" class="text-blue-600" checked>
                                <span class="text-sm text-gray-700">Media</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="length" value="long" class="text-blue-600">
                                <span class="text-sm text-gray-700">Larga</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4">
                <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Cancelar</button>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Crear Personaje</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>