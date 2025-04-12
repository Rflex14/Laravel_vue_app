<script>
  export default {
    name: 'AlmacenIndex'
  }
</script>

<script setup>
import { ref, onBeforeMount } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  almacenes: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('almacen.destroy', id))
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
          `/api/almacenes?search=${searchTerm.value}&page=${page}`
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
  <AppLayout title="Almacenes">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Almacenes</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('almacen.create')" class="mt-2">
              Crear Almacen
            </Link>
            <div>
              <input
              v-model="searchTerm"
              type="text"
              placeholder="Buscar un almacen"
              @input="fetchRegisters"
              />
            </div>
          </div>
        </div>
        <div class="mt-4">
          <ul v-if="registers.length > 0"role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="almacen in registers"> 
              <div class="w-full px-4 py-3 rounded-lg border-solid border-2 border-gray-900">
                <div class="w-full h-24 grid grid-cols-8 grid-rows-2 gap-x-1 place-items-center">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{almacen.nombre}}</p>
                  <div class="row-span-2">
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{almacen.estado}}</p>
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{almacen.municipio}}</p>
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{almacen.parroquia}}</p>
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{almacen.sector}}</p>
                  </div>
                  <p class="text-sm leading-6 text-gray-900 col-span-2 row-span-2">{{almacen.direccion}}</p>
                  <div class="w-full h-full place-items-center col-span-2 row-span-2 grid grid-cols-2 rounded border border-solid border-black bg-yellow-400">
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{almacen.empresa.rif}}</p>
                    <p class="text-sm flex items-center leading-6 font-semibold text-gray-900 row-span-2">{{almacen.empresa.nombre}}</p>
                  </div>
                  <div class="w-full h-full ml-1 col-span-1 row-span-2 grid-cols-1 place-items-start content-center rounded border border-solid border-black bg-blue-400 overflow-y-auto overflow-x-hidden">
                    <p class="ml-1 font-semibold text-sm" v-for="producto in almacen.productos">-{{producto.nombre}}</p>
                  </div>
                  <Link class="w-full flex items-center justify-center h-5/6 mb-1 text-sm ml-3 text-gray-900 font-bold p-1 bg-red-500 rounded border border-solid border-black" :href="route('almacen.edit', almacen.id)">EDITAR</Link>
                  <button class="w-full flex items-center justify-center h-5/6 mt-1 text-sm ml-3 text-gray-900 font-bold p-1 bg-red-500 rounded border border-solid border-black" @click="deleteCategory(almacen.id)">BORRAR</button>
                </div>
              </div>
            </li>
          </ul>
          <div v-else>
            <div class="w-full px-4 py-3 rounded-lg border-solid border-2 border-gray-900">
              <div class="w-full py-4 grid place-items-center text-xl">No se encontro ningun almacen</div>
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