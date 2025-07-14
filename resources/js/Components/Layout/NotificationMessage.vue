<script setup>

import { ref } from 'vue';

const notificationMessage = ref('');
const notificationType = ref(''); // 'error' or 'success'

function getClassByType(type) {
    let notificationClass = 'bg-blue-500'; // Default class

    if (type === 'error') {
        notificationClass = 'bg-red-500'; // You can modify this to change the background color
    }

    if (type === 'success') {
        notificationClass = 'bg-green-500'; // You can modify this to change the background color
    }

    return notificationClass; // You can modify this to change the background color
}

</script>

<template>
    <div class="fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 hidden"  
         :class="getClassByType(notificationType)">
        {{ notificationMessage }}
    </div>
</template>