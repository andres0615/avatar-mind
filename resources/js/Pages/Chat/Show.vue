<script setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatHeader from '@/Pages/Chat/Header.vue';
import MessageReceived from '@/Components/Chat/MessageReceived.vue';
import MessageSent from '@/Components/Chat/MessageSent.vue';
import { onMounted, defineProps, ref, reactive, nextTick, watch } from 'vue';
// import { useNotifications } from '@/composables/useNotifications';

const props = defineProps({
    characterId: {
        type: Number,
        required: true
    }
});

const userMessage = ref('');

const chat = reactive({});

const character = reactive({});

const chatMessages = ref([]);

const messagesScroll = ref(null);

// const { responseNotification } = props;

// const { showNotification } = useNotifications();

// O resetea automáticamente en ciertas condiciones
watch(() => props.characterId, async(newCharacterId, oldCharacter) => {
    await getChat();
})

onMounted(async () => {
// Si hay una notificación de respuesta, mostrarla
//   console.log(responseNotification);
//   if (responseNotification.message) {    
//     console.log('Mostrando notificación:', responseNotification.message);
//     console.log(responseNotification);
//     showNotification(responseNotification.message, responseNotification.type);
//   }

    await getChat();

    // scrollAlFinal();

});

const getChat = async () => {
    try {
        let config = {};
        let requestUrl = route('api.chat.show', { characterId: props.characterId });

        const response = await axios.get(requestUrl, config);
        let { success, message, data: responseData } = response.data;

        if (success) {
            console.log('Chat obtenido:', responseData);

            chat.value = responseData.chat; // Asignar el personaje del chat
            character.value = responseData.character; // Asignar el personaje del chat
            chatMessages.value = responseData.chatMessages; // Asignar los mensajes del chat

            nextTick(() => {
                scrollAlFinal(); // Desplazar al final después de cargar los mensajes
            });

            console.log('chatMessages:', chatMessages.value);
        } else {
            console.error('Error:', message);
        }
    } catch (error) {
        console.error('Error al obtener los mensajes:', error);
    }
};

const sendMessage = async (event) => {
    console.log('Mensaje enviado:', userMessage.value);

    if (event.key === 'Enter' && event.shiftKey) {
        return; // Permitir nueva línea con Shift+Enter
    }

    if (!userMessage.value.trim()) {
        console.warn('El mensaje está vacío');
        return; // No enviar mensajes vacíos
    }

    try {

        // Obtener hora actual en formato 'HH:ii'
        let currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        console.log('userMessage: ', userMessage.value);

        let newUserMessage = {
            message: userMessage.value,
            type: 'user',
            created_at: currentTime,
        };

        let config = {};

        let requestUrl = route('api.chat_message.store', { chatId: chat.value.id });

        let requestData = {
            message: newUserMessage.message
        };

        // Agregar mensaje del usuario a los mensajes del chat
        chatMessages.value.push(newUserMessage);

        userMessage.value = ''; // Limpiar el campo de entrada después de enviar

        nextTick(() => {
            scrollAlFinal(); // Desplazar al final después de agregar el nuevo mensaje
        });

        const response = await axios.post(requestUrl, requestData, config);

        let { success, message, data: responseData } = response.data;

        if (success) {

            console.log('responseData: ', responseData);

            let { botResponse } = responseData;

            // convertir fecha recibida (en formato H:i) a hora local
            // botResponse.created_at = new Date(`1970-01-01T${botResponse.created_at}:00`).toLocaleTimeString(["es-CO"], { hour: '2-digit', minute: '2-digit' });
            
            console.log('Bot response:', botResponse);

            let newBotMessage = {
                message: botResponse.message,
                type: 'assistant',
                created_at: botResponse.created_at
            };

            // Agregar respuesta del bot a los mensajes del chat
            chatMessages.value.push(newBotMessage);

            nextTick(() => {
                scrollAlFinal(); // Desplazar al final después de agregar el nuevo mensaje
            });

        } else {
            console.error('Error:', message);
        }

    } catch (error) {
        console.error('Error al enviar el mensaje:', error);
    } finally {
        
    }
}

const scrollAlFinal = async () => {
    const el = messagesScroll.value;
    // console.log('scrollAlFinal', el);
    // console.log('clientHeight:', el.clientHeight);
    nextTick();
    if (!el) return
    // pon el scroll en la altura máxima
    el.scrollTop = el.scrollHeight;
}

</script>

<template>
    <AuthenticatedLayout>
        <main class="flex-1 flex flex-col bg-white">
            <ChatHeader :character="character.value" />

            <!-- Área de Mensajes -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6" 
            id="messages-container"
            ref="messagesScroll">

                <!-- <MessageSent /> -->

                <!-- <MessageReceived /> -->

                <template v-for="(chatMessage, index) in chatMessages" :key="index">

                    <MessageReceived 
                    v-if="chatMessage.type == 'assistant'" 
                    :message="chatMessage.message" 
                    :date="chatMessage.created_at"
                    :character="character.value" />

                    <MessageSent v-else-if="chatMessage.type == 'user'"
                    :message="chatMessage.message" 
                    :date="chatMessage.created_at" />

                    <!-- Componente thinking -->

                </template>
            </div>

            <!-- Área de Entrada -->
            <div class="p-6 border-t border-gray-200 bg-white">
                <div class="flex items-end space-x-4">
                    <div class="flex-1">
                        <div class="relative">
                            <textarea 
                            rows="1" 
                            class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm" 
                            placeholder="Escribe tu mensaje..." 
                            id="message-input" 
                            style="min-height: 3rem; max-height: 8rem;"
                            v-model="userMessage"
                            @keyup.enter="sendMessage($event)"></textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-gray-400" id="char-counter">0/2000</div>
                        </div>
                    </div>
                    <button 
                    class="p-3 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition-colors" 
                    id="send-button"
                    @click="sendMessage($event)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>

                <div class="mt-2 text-xs text-gray-500 text-center">
                    Presiona Enter para enviar, Shift+Enter para nueva línea
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>