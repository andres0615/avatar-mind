<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted, nextTick, watch, reactive } from 'vue';

const user = reactive({
    email: '',
});

onMounted(() => {
    getUser();
});

async function getUser()
{
    try {

        let config = {};

        let requestUrl = route('user');

        const response = await axios.get(requestUrl, config);
        console.log('Respuesta usuario: ', response);
        let { data: userData } = response;

        console.log('User obtained:', userData);
        Object.assign(user, userData);

    } catch (error) {
        console.error('Error al obtener el usuario:', error);
    }
}

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
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="flex items-center space-x-3">
                            <input type="email" 
                            placeholder="usuario@ejemplo.com"
                            v-model="user.email" 
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Verificado
                            </span>
                        </div>
                    </div>                </div>
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