<script>
  export default {
    name: 'EmpresaIndex'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  empresas: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('empresa.destroy', id))
  }
}

</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Empresas</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('empresa.create')">
              Crear Empresa
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="empresa in empresas.data"> 
              <div class="w-full px-4 py-3 border-solid border-2 border-gray-900">
                <div class="w-full pl-4 grid grid-cols-6 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{empresa.rif}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{empresa.nombre}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{empresa.nombre_responsable}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{empresa.cedula_responsable}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{empresa.telefono_responsable}}</p>
                  <Link class="mb-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" :href="route('empresa.edit', empresa.id)">EDITAR</Link>
                  <button class="mt-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" @click="deleteCategory(empresa.id)">BORRAR</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-2">
          <Link v-if="empresas.current_page > 1" :href="empresas.prev_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </Link>
          <div v-else></div>
          <Link v-if="empresas.current_page < empresas.last_page" :href="empresas.next_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </Link>
          <div v-else></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>