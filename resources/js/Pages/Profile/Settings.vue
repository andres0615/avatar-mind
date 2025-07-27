<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Configuración de Perfil</h1>
            <p class="text-lg text-gray-600">Administra tu cuenta y preferencias</p>
        </div>

        <div class="space-y-8">
            <!-- Información Personal -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Personal</h2>

                <div class="space-y-6">
                    <!-- <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <button class="px-4 py-2 text-sm text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors">Cambiar foto</button>
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG o GIF. Máximo 2MB.</p>
                        </div>
                    </div> -->

                    <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de usuario</label>
                            <input type="text" value="usuario123" disabled class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                            <p class="text-xs text-gray-500 mt-1">El nombre de usuario no se puede cambiar</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre para mostrar</label>
                            <input type="text" value="Usuario" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div> -->

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="flex items-center space-x-3">
                            <input type="email" value="usuario@ejemplo.com" class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <!-- <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Verificado
                            </span> -->
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de nacimiento</label>
                            <input type="date" value="1995-06-15" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ubicación (opcional)</label>
                            <input type="text" value="Madrid, España" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ciudad, País">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacidad y Seguridad -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Privacidad y Seguridad</h2>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-base font-medium text-gray-900 mb-4">Cambiar contraseña</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña actual</label>
                                <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ingresa tu contraseña actual">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nueva contraseña</label>
                                    <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nueva contraseña">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar contraseña</label>
                                    <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Confirmar contraseña">
                                </div>
                            </div>

                            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span class="text-sm">Actualizar contraseña</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración de la Aplicación -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Configuración de la Aplicación</h2>

                <div class="space-y-6">
                    <!-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Tema de la aplicación</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="flex flex-col items-center p-4 border-2 border-blue-600 rounded-lg cursor-pointer bg-blue-50 transition-colors">
                                <input type="radio" name="theme" value="light" class="hidden" checked>
                                <svg class="w-6 h-6 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Claro</span>
                                <div class="w-4 h-4 border-2 border-blue-600 rounded-full mt-2 flex items-center justify-center">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                </div>
                            </label>

                            <label class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="theme" value="dark" class="hidden">
                                <svg class="w-6 h-6 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Oscuro</span>
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full mt-2"></div>
                            </label>

                            <label class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="theme" value="auto" class="hidden">
                                <svg class="w-6 h-6 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Automático</span>
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-full mt-2"></div>
                            </label>
                        </div>
                    </div> -->

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Idioma de la aplicación</label>
                        <select class="w-full md:w-64 px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option selected>Español</option>
                            <option>English</option>
                            <option>Français</option>
                            <option>Deutsch</option>
                            <option>Português</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4">
                <button class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Cancelar</button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Guardar Cambios</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>