<script>
  export default {
    name: 'TecnicoIndex'
  }
</script>

<script setup>
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

</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Tecnicos</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('tecnico.create')">
              Crear Tecnico
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="tecnico in tecnicos.data"> 
              <div class="w-full px-4 py-3 border-solid border-2 border-gray-900">
                <div class="w-full pl-4 grid grid-cols-5 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{tecnico.cedula}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.nombre}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.apellido}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{tecnico.telefono}}</p>
                  <Link class="mb-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" :href="route('tecnico.edit', tecnico.id)">EDITAR</Link>
                  <Link class="mt-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" @click="deleteCategory(tecnico.id)">BORRAR</Link>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-2">
          <Link v-if="tecnicos.current_page > 1" :href="tecnicos.prev_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </Link>
          <div v-else></div>
          <Link v-if="tecnicos.current_page < tecnicos.last_page" :href="tecnicos.next_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </Link>
          <div v-else></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>