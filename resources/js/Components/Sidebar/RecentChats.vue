<script setup>
import { Link, router } from '@inertiajs/vue3';
import { onMounted, defineProps, ref, reactive, nextTick } from 'vue';

const characters = ref([]);
const allCharacters = ref([]);

const filters = reactive({
    name: '',
});

onMounted(async () => {
    await getRecentChats();
});

const getRecentChats = async () => {
    try {
        let config = {};
        let requestUrl = route('api.character.index');

        const response = await axios.get(requestUrl, config);
        let { success, message, data: responseData } = response.data;

        if (success) {
            console.log('Recent chats obtained:', responseData);
            // Aquí puedes manejar los datos obtenidos, por ejemplo, guardarlos en una variable reactiva

            characters.value = responseData.characters;
            allCharacters.value = responseData.characters;
        } else {
            console.error('Error fetching recent chats:', message);
        }

    } catch (error) {
        console.error('Error al obtener los mensajes:', error);
    }
}

const getTimeAgo = (character) => {
    return character.chat.last_message.time_ago;
}

const getNameInitial = (name) => {
    if (!name) return '';
    const parts = name.split(' ');
    if (parts.length === 0) return '';
    return parts[0].charAt(0).toUpperCase();
}

function filterCharacters() {

    let filteredCharacters = allCharacters.value.filter(character => {

        if(filters.name.length > 0){
            if(!character.name.toLowerCase().includes(filters.name.toLowerCase())) {
                return false;
            }
        }

        return true;
    });

    characters.value = filteredCharacters;
    
    return true;
}

function showCharacterChat(characterId) {
    // Aquí puedes manejar la lógica para mostrar el chat del personaje seleccionado
    console.log('Mostrar chat para el personaje con ID:', characterId);
    // Por ejemplo, podrías redirigir a una ruta específica
    // window.location.href = route('chat.show', { characterId: characterId });

    // let chatUrl = route('chat.show', { characterId: characterId });
    // let requestData = {};
    // let requestConfig = {
    //     preserveScroll: true,
    //     only: ['characterId'],
    // };

    // router.get(chatUrl, requestData, requestConfig);

    // Redirigir al componente Chat/Show.vue usando router.push
    // router.push(route('chat.show', { characterId: characterId }));

    let chatUrl = route('chat.show', { characterId: characterId });
    let requestProps = {
        characterId: characterId
    };

    router.push({
        url: chatUrl,
        props: requestProps,
        component: 'Chat/Show',
        preserveScroll: true,
        preserveState: true,
    });

}

</script>

<template>
    <!-- Recent Chats -->
    <div class="flex-1 p-4">
        <div class="mb-4">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Chats Recientes</h4>
            <div class="relative">
                <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Buscar en historial..." 
                @input="filterCharacters"
                v-model="filters.name"
                class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="space-y-2" id="recent-chats">
            <!-- <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: 1 })">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">N</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Naruto Uzumaki</p>
                        <p class="text-xs text-gray-500">2 min ago</p>
                    </div>
                </Link>
            </div> -->
            <div 
            v-for="character in characters"
            :key="character.id"
            class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <!-- <Link class="flex items-center space-x-3"
                :href="route('chat.show', { characterId: character.id })"> -->
                <a class="flex items-center space-x-3"
                @click="showCharacterChat(character.id)">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-medium text-white">{{ getNameInitial(character.name) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ character.name }}</p>
                        <p class="text-xs text-gray-500">{{ getTimeAgo(character) }}</p>
                    </div>
                </a>
                <!-- </Link> -->
            </div>
        </div>
    </div>
</template>