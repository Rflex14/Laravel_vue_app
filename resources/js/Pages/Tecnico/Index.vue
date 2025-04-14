<script>
  export default {
    name: 'TecnicoIndex'
  }
</script>

<script setup>
import { ref, onBeforeMount } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  tecnicos: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('tecnico.destroy', id))
  }
}

const searchTerm = ref("");
const registers = ref([]);
const currentPage = ref(1); 
const lastPage = ref(1); 

const fetchRegisters = async (page = 1) => {
      try {
        // Fetch from the API with the search term and page number
        const response = await fetch(
          `/api/tecnicos?search=${searchTerm.value}&page=${page}`
        );
        const data = await response.json();

        // Update reactive variables
        registers.value = data.data; // Register data
        currentPage.value = data.current_page; // Current page
        lastPage.value = data.last_page; // Total pages
      } catch (error) {
        console.error("Error fetching registers:", error);
      }
    }
onBeforeMount(() => {
  fetchRegisters();
});
</script>

<template>
  <AppLayout title="Tecnicos">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Técnicos</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('tecnico.create')" class="mt-2">
              Registrar un Técnico
            </Link>
            <div>
              <input
              v-model="searchTerm"
              type="text"
              placeholder="Buscar un tecnico"
              @input="fetchRegisters"
              />
            </div>
          </div>
        </div>
        <div v-if="registers.length> 0" class="mt-4">
          <div class="w-full px-4 pb-3 border-solid border-b-2 border-gray-700">
            <div class="w-full pl-4 grid grid-cols-5 grid-rows-2 place-content-evenly">
              <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">Cedula</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">Nombre</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">Apellido</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">Telefono</p>
                  <p class="w-full ml-24 text-sm flex items-center leading-6 text-gray-900 row-span-2">Acciones</p>
                </div>
            </div>
          <ul v-if="registers.length > 0" role="list" class="pt-2 divide-y divide-gray-100">
            <li class="mb-2" v-for="tecnico in registers"> 
              <div class="w-full px-4 pb-3 border-solid border-b-2 border-gray-700">
                <div class="w-full pl-4 grid grid-cols-5 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{tecnico.cedula}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.nombre}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.apellido}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.telefono}}</p>
                  <Link class="w-full flex items-center justify-center h-full mb-1 text-sm ml-3 text-gray-900 font-bold p-1 rounded border border-2 border-solid border-black" :href="route('tecnico.edit', tecnico.id)">EDITAR</Link>
                  <button class="w-full flex items-center justify-center h-full mt-1 text-sm ml-3 text-gray-900 font-bold p-1 rounded border border-2 border-solid border-black" @click="deleteCategory(tecnico.id)">BORRAR</button>
                </div>
              </div>
            </li>
          </ul>
          <div v-else>
            <div class="w-full px-4 py-3 border-solid border-y-2 border-gray-700">
              <div class="w-full py-4 grid place-items-center text-xl">No se encontró ningún técnico</div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-3 place-items-center mt-2">
          <button v-if="currentPage > 1" @click="fetchRegisters(currentPage - 1)" :disabled="currentPage === 1" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </button>
          <div v-else class="py-2 px-4 rounded bg-dark-subtle"></div>
          <div class="py-2 px-4">{{ currentPage }}</div>
          <button v-if="currentPage < lastPage" @click="fetchRegisters(currentPage + 1)" :disabled="currentPage === lastPage" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </button>
          <div v-else class="py-2 px-4 rounded bg-dark-subtle"></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>