<script>
  export default {
    name: 'respaldoVegetalIndex'
  }
</script>

<script setup>
import { ref, onBeforeMount, computed } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import { parserOptions } from "@vue/compiler-dom";

const props = defineProps ({
  archivos: {
    type: Object,
    required: true
  }
})

const searchTerm = ref("");

const archivosFiltrados = computed(() => {
  const ArchivosArray = Object.values(props.archivos);
  return ArchivosArray.filter((fileName) =>
    fileName.toLowerCase().includes(searchTerm.value.toLowerCase())
  );
})

const Descargar = (archivo) => {
  const url = route('descarga.respaldoVegetal', { file: archivo });
  window.location.href = url;
}
</script>

<template>
  <AppLayout title="Respaldos">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Respaldos formato vegetal</h1>
    </template>

    <div class="py-12 ">        
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <div class="mt-2">Respaldos</div>
            <div>
              <input
              v-model="searchTerm"
              type="text"
              placeholder="Buscar un archivo"
              @input="filtrar"
              />
            </div>
          </div>
        </div>
        <div class="mt-4">
          <ul v-if="archivosFiltrados.length !== 0" role="list" class="pt-2 divide-y divide-gray-100">
            <li class="mb-2" v-for="archivo in archivosFiltrados"> 
              <div class="w-full px-4 pb-3 border-solid border-b-2 border-gray-700">
                <div class="w-full flex items-center justify-between pl-4">
                  <div>{{ archivo }}</div>
                  <button type="button" @click="Descargar(archivo)" class=" flex text-sm text-gray-900 font-bold p-4 rounded border border-2 border-solid border-black">Descargar</button>
                </div>
              </div>
            </li>
          </ul>
          <div v-else>
            <div class="w-full px-4 py-3 border-solid border-y-2 border-gray-700">
              <div class="w-full py-4 grid place-items-center text-xl">No se encontró ningún archivo</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>