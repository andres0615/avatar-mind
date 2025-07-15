import { ref, reactive } from 'vue';

// Estado global para las notificaciones
const notification = reactive({
    message: '',
    type: '',
    visible: false
});

export function useNotifications() {
    const showNotification = (message, type = 'success') => {
        notification.message = message;
        notification.type = type;
        notification.visible = true;

        console.log(`Notificación: ${message} (${type})`);
        
        // Ocultar automáticamente después de 5 segundos
        setTimeout(() => {
            hideNotification();
        }, 5000);
    };

    const hideNotification = () => {
        notification.message = '';
        notification.type = '';
        notification.visible = false;
    };

    return {
        notification,
        showNotification,
        hideNotification
    };
}