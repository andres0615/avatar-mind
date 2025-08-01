<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { useNotifications } from '@/composables/useNotifications';

// Datos reactivos del formulario
const form = ref({
    name: '',
    category: '',
    tagline: '',
    visibility: 'public',
    personality_description: '',
    age: '',
    occupation: '',
    interests: [],
    creativity_level: 7,
    response_length: 'medium'
});

// Estados de la interfaz
const isSubmitting = ref(false);
const errors = ref({});
const interests = ref([]);
const interestsInput = ref('');

// Manejar el slider de creatividad
const creativityValue = ref(7);

// Referencias a los campos del formulario
const nameField = ref(null);
const categoryField = ref(null);
const taglineField = ref(null);
const personalityField = ref(null);
const ageField = ref(null);
const occupationField = ref(null);
const interestsField = ref(null);

const { showNotification } = useNotifications();

// Agregar interés
const addInterest = () => {
    if (interestsInput.value.trim() && !interests.value.includes(interestsInput.value.trim())) {
        interests.value.push(interestsInput.value.trim());
        form.value.interests = interests.value;
        interestsInput.value = '';
    }
};

// Remover interés
const removeInterest = (index) => {
    interests.value.splice(index, 1);
    form.value.interests = interests.value;
};

// Manejar envío del formulario
const handleSubmit = async () => {
    isSubmitting.value = true;
    errors.value = {};

    try {

        let config = {};

        let requestUrl = route('api.character.store');

        const response = await axios.post(requestUrl, form.value, config);

        let { success, message, data } = response.data;
        let { character, chat } = data || {};

        if (success) {
            console.log(response);

            let characterId = character.id;
            console.log('Personaje creado con ID:', characterId);

            // Mostrar notificación de éxito
            showNotification(message, 'success');

            // let responseNotification = {
            //     message: 'Personaje creado exitosamente',
            //     type: 'success'
            // };

            let redirectUrl = route('chat.show', { characterId: characterId });
            console.log('Redirigiendo a:', redirectUrl);

            // Redirigir al dashboard o página de characters
            router.visit(redirectUrl, {
                preserveState: true,
                onSuccess: () => {
                    // Mostrar mensaje de éxito si tienes un sistema de notificaciones
                    console.log('Personaje creado exitosamente');
                }
            });

        } else {
            console.error('Error:', message);
        }
    } catch (error) {
        // Manejar errores de validación (422) y otros errores
        if (error.response && error.response.status === 422) {
            console.log(error);
            errors.value = error.response.data.errors;

            // Focus en el primer campo con error
            await nextTick();
            focusFirstErrorField();
        } else if (error.response && error.response.data.message) {
            console.error('Error:', error.response.data.message);
        } else {
            console.error('Error al crear el personaje:', error);
        }
    } finally {
        isSubmitting.value = false;
    }
};

const focusFirstErrorField = () => {
    const errorFields = Object.keys(errors.value);
    if (errorFields.length > 0) {
        const firstErrorField = errorFields[0];
        
        // Mapeo de nombres de campos a referencias
        const fieldRefs = {
            name: nameField,
            category: categoryField,
            tagline: taglineField,
            personality_description: personalityField,
            age: ageField,
            occupation: occupationField,
            interests: interestsField
        };
        
        const fieldRef = fieldRefs[firstErrorField];
        if (fieldRef?.value) {
            fieldRef.value.focus();
            fieldRef.value.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
};

// Actualizar valor del slider
const updateCreativity = (event) => {
    creativityValue.value = event.target.value;
    form.value.creativity_level = parseInt(event.target.value);
};

// Manejar tecla Enter en el input de intereses
const handleInterestKeydown = (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        addInterest();
    }
};

onMounted(() => {
    // Configurar el slider de creatividad
    const slider = document.getElementById('creativity-slider');
    const valueDisplay = document.getElementById('creativity-value');
    
    if (slider && valueDisplay) {
        slider.addEventListener('input', (e) => {
            valueDisplay.textContent = e.target.value;
            updateCreativity(e);
        });
    }
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Crear Personaje</h1>
            <p class="text-lg text-gray-600">Crea un personaje único con personalidad propia</p>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-8">
            <!-- Información Básica -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Información Básica</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del personaje *</label>
                        <input 
                            type="text" 
                            v-model="form.name"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Ej: Harry Potter"
                            :class="{ 'border-red-500': errors.name }"
                            ref="nameField"
                        >
                        <p v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name[0] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                        <select 
                            v-model="form.category"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            :class="{ 'border-red-500': errors.category }"
                            ref="categoryField"
                        >
                            <option value="">Seleccionar categoría</option>
                            <option value="Anime">Anime</option>
                            <option value="Videojuegos">Videojuegos</option>
                            <option value="Películas">Películas</option>
                            <option value="Libros">Libros</option>
                            <option value="Histórico">Histórico</option>
                            <option value="Original">Original</option>
                        </select>
                        <p v-if="errors.category" class="text-red-500 text-sm mt-1">{{ errors.category[0] }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tagline/Descripción corta (100 caracteres max) *</label>
                    <input 
                        type="text" 
                        v-model="form.tagline"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        placeholder="Una breve descripción del personaje..." 
                        maxlength="100"
                        :class="{ 'border-red-500': errors.tagline }"
                        ref="taglineField"
                    >
                    <p v-if="errors.tagline" class="text-red-500 text-sm mt-1">{{ errors.tagline[0] }}</p>
                </div>

                <!-- <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Visibilidad</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" v-model="form.visibility" value="public" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Público</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" v-model="form.visibility" value="private" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Privado</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" v-model="form.visibility" value="friends" class="text-blue-600">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Solo amigos</span>
                        </label>
                    </div>
                </div> -->
            </div>

            <!-- Personalidad y Trasfondo -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Personalidad y Trasfondo</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descripción de personalidad (800 caracteres max)</label>
                        <textarea 
                            rows="5" 
                            v-model="form.personality_description"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" 
                            placeholder="Describe la personalidad del personaje..." 
                            maxlength="2000"
                            :class="{ 'border-red-500': errors.personality_description }"
                            ref="personalityField"
                        ></textarea>
                        <p v-if="errors.personality_description" class="text-red-500 text-sm mt-1">{{ errors.personality_description[0] }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad</label>
                            <input 
                                type="text" 
                                v-model="form.age"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                placeholder="Ej: 16 años"
                                :class="{ 'border-red-500': errors.age }"
                                ref="ageField"
                            >
                            <p v-if="errors.age" class="text-red-500 text-sm mt-1">{{ errors.age[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ocupación</label>
                            <input 
                                type="text" 
                                v-model="form.occupation"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                placeholder="Ej: Estudiante"
                                :class="{ 'border-red-500': errors.occupation }"
                                ref="occupationField"
                            >
                            <p v-if="errors.occupation" class="text-red-500 text-sm mt-1">{{ errors.occupation[0] }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Intereses/Hobbies</label>
                        <div class="flex flex-wrap gap-2 p-3 border border-gray-200 rounded-lg min-h-12" 
                             :class="{ 'border-red-500': errors.interests }">
                            <span v-for="(interest, index) in interests" :key="index" 
                                  class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                {{ interest }}
                                <button type="button" @click="removeInterest(index)" 
                                        class="ml-2 text-blue-600 hover:text-blue-800">
                                    ×
                                </button>
                            </span>
                            <input 
                                type="text" 
                                v-model="interestsInput"
                                @keydown="handleInterestKeydown"
                                @blur="addInterest"
                                class="flex-1 min-w-32 outline-none text-sm" 
                                placeholder="Agregar interés..."
                                id="interests-input"
                                ref="interestsField"
                            >
                        </div>
                        <p v-if="errors.interests" class="text-red-500 text-sm mt-1">{{ errors.interests[0] }}</p>
                    </div>
                </div>
            </div>

            <!-- Configuración Avanzada -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Configuración Avanzada</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Creatividad: <span class="text-blue-600 font-semibold" id="creativity-value">{{ creativityValue }}</span>
                        </label>
                        <input 
                            type="range" 
                            min="1" 
                            max="10" 
                            v-model="creativityValue"
                            @input="updateCreativity"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider" 
                            id="creativity-slider"
                        >
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Conservador</span>
                            <span>Creativo</span>
                        </div>
                    </div>

                    <!-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Longitud de respuestas</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" v-model="form.response_length" value="short" class="text-blue-600">
                                <span class="text-sm text-gray-700">Corta</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" v-model="form.response_length" value="medium" class="text-blue-600">
                                <span class="text-sm text-gray-700">Media</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" v-model="form.response_length" value="long" class="text-blue-600">
                                <span class="text-sm text-gray-700">Larga</span>
                            </label>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4">
                <button 
                    type="button" 
                    @click="$inertia.visit('/settings')"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    Cancelar
                </button>
                <button 
                    type="submit" 
                    :disabled="isSubmitting"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50"
                >
                    {{ isSubmitting ? 'Creando...' : 'Crear Personaje' }}
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>