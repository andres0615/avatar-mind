<script setup>
import { defineProps } from 'vue';
const props = defineProps({
    message: {
        type: String,
        required: false,
        default: 'test'
    },
    date: {
        type: String,
        required: false,
        default: '00:00'
    }
});

</script>

<template>
    <div class="flex justify-end">
        <div class="max-w-2xl">
            <div class="px-4 py-3 rounded-2xl bg-blue-600 text-white flex-shrink-0">
                <p class="text-sm leading-relaxed">{{ props.message }}</p>
            </div>
            <!-- <div class="mt-1 text-right">
                <span class="text-xs text-gray-500">{{ date }}</span>
            </div> -->
        </div>
    </div>
</template>