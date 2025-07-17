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
    <div class="flex justify-start">
        <div class="max-w-2xl">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-bold text-white">N</span>
                </div>
                <div>
                    <div class="px-4 py-3 rounded-2xl bg-gray-100 text-gray-900">
                        <p class="text-sm leading-relaxed">{{ props.message }}</p>
                    </div>
                    <!-- <div class="mt-1 text-left">
                        <span class="text-xs text-gray-500"> {{ date }}</span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>