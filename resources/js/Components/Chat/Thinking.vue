<script>

</script>

<template>
    <!-- <div>
    Thinking ...
  </div> -->
    <div class="flex items-start space-x-3">
        <!-- Avatar placeholder (similar al MessageReceived) -->
        <!-- <div class="w-8 h-8 bg-gray-300 rounded-full flex-shrink-0 flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
        </div> -->

        <!-- Mensaje de pensando -->
        <div class="flex-1 max-w-32 ml-10">
            <div class="bg-gray-100 rounded-2xl px-4 py-3">
                <div class="flex items-center space-x-1">
                    <!-- Texto -->
                    <span class="text-gray-600 text-sm mr-2">Pensando</span>

                    <!-- Animación de puntos -->
                    <div class="flex space-x-1">
                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;">
                        </div>
                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>