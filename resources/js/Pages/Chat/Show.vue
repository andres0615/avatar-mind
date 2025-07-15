<script setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import ChatHeader from '@/Pages/Chat/Header.vue';
import MessageReceived from '@/Components/Chat/MessageReceived.vue';
import MessageSent from '@/Components/Chat/MessageSent.vue';
import { onMounted, defineProps } from 'vue';
// import { useNotifications } from '@/composables/useNotifications';

const props = defineProps({
//   responseNotification: {
//     type: Object,
//     required: false,
//     default: {}
//   },
});

// const { responseNotification } = props;

// const { showNotification } = useNotifications();

onMounted(() => {
  // Si hay una notificación de respuesta, mostrarla
//   console.log(responseNotification);
//   if (responseNotification.message) {    
//     console.log('Mostrando notificación:', responseNotification.message);
//     console.log(responseNotification);
//     showNotification(responseNotification.message, responseNotification.type);
//   }

});

</script>

<template>
    <ChatLayout>
        <main class="flex-1 flex flex-col bg-white">
            <ChatHeader />

            <!-- Área de Mensajes -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6" id="messages-container">
                <MessageReceived />

                <MessageReceived />

                <MessageReceived />

                <MessageSent />

                <MessageReceived />
            </div>

            <!-- Área de Entrada -->
            <div class="p-6 border-t border-gray-200 bg-white">
                <div class="flex items-end space-x-4">
                    <div class="flex-1">
                        <div class="relative">
                            <textarea rows="1" class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm" placeholder="Escribe tu mensaje..." id="message-input" style="min-height: 3rem; max-height: 8rem;"></textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-gray-400" id="char-counter">0/2000</div>
                        </div>
                    </div>

                    <button class="p-3 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition-colors" id="send-button">
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
    </ChatLayout>
</template>