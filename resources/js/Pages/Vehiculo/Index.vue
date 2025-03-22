<script>
  export default {
    name: 'VehiculoIndex'
  }
</script>

<script setup>
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

</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Vehiculos</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('vehiculo.create')">
              Crear Vehiculo
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="vehiculo in vehiculos.data"> 
              <div class="w-full px-4 py-3 border-solid border-2 border-gray-900">
                <div class="w-full pl-4 grid grid-cols-6 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{vehiculo.placa}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.modelo}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.marca}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.persona_id}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{vehiculo.empresa_id}}</p>
                  <Link class="mb-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" :href="route('vehiculo.edit', vehiculo.id)">EDITAR</Link>
                  <Link class="mt-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" @click="deleteCategory(vehiculo.id)">BORRAR</Link>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-2">
          <Link v-if="vehiculos.current_page > 1" :href="vehiculos.prev_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </Link>
          <div v-else></div>
          <Link v-if="vehiculos.current_page < vehiculos.last_page" :href="vehiculos.next_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </Link>
          <div v-else></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>