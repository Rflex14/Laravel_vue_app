<script>
  export default {
    name: 'VehiculoIndex'
  }
</script>

<script setup>
import { ref, onBeforeMount } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  vehiculos: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('vehiculo.destroy', id))
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
          `/api/vehiculos?search=${searchTerm.value}&page=${page}`
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
  <AppLayout title="Vehículos">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Vehículos</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('vehiculo.create')" class="mt-2">
              Registrar un Vehículo
            </Link>
            <div>
              <input
              v-model="searchTerm"
              type="text"
              placeholder="Buscar un vehiculo"
              @input="fetchRegisters"
              />
            </div>
          </div>
        </div>
        <div v-if="registers.length> 0" class="mt-4">
          <div class="w-full px-4 pb-3 border-solid border-b-2 border-gray-700">
            <div class="w-full pl-4 grid grid-cols-6 grid-rows-2 place-content-evenly">
              <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">Placa</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">Modelo</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">Marca</p>
                  <p class="w-full block text-sm text-center leading-6 text-gray-900 row-span-2 col-span-2">Propietario</p>
                  <p class="w-full ml-20 text-sm flex items-center leading-6 text-gray-900 row-span-2">Acciones</p>
                </div>
            </div>
          <ul v-if="registers.length > 0" role="list" class="pt-2 divide-y divide-gray-100">
            <li class="mb-2" v-for="vehiculo in registers"> 
              <div class="w-full px-4 pb-3 border-solid border-b-2 border-gray-700">
                <div class="w-full pl-4 grid grid-cols-6 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{vehiculo.placa}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.modelo}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.marca}}</p>
                  <div v-if="!(vehiculo.persona_id === null)" class="w-full place-items-center col-span-2 row-span-2 grid grid-cols-2 rounded border-2 border-dashed border-black pt-6 pb-6">
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{vehiculo.persona.rif}}</p>
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{vehiculo.persona.nombre}}</p>
                  </div>
                  <div v-else class="w-full place-items-center col-span-2 row-span-2 grid grid-cols-2 rounded border-2 border-dashed border-black pt-6 pb-6">
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{vehiculo.empresa.rif}}</p>
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{vehiculo.empresa.nombre}}</p>
                  </div>
                  <Link class="mb-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 rounded border border-2 border-solid border-black" :href="route('vehiculo.edit', vehiculo.id)">EDITAR</Link>
                  <button class="mt-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 rounded border border-2 border-solid border-black" @click="deleteCategory(vehiculo.id)">BORRAR</button>
                </div>
              </div>
            </li>
          </ul>
          <div v-else>
            <div class="w-full px-4 py-3 border-solid border-y-2 border-gray-700">
              <div class="w-full py-4 grid place-items-center text-xl">No se encontró ningún vehículo</div>
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