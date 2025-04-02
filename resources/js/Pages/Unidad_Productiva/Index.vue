<script>
  export default {
    name: 'Unidad_ProductivaIndex'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  unidades_productivas: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('unidadProductiva.destroy', id))
  }
}

</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Unidades Productivas</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('unidadProductiva.create')">
              Crear Unidad Productiva
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="unidad_productiva in unidades_productivas.data"> 
              <div class="w-full px-4 py-3 rounded-lg border-solid border-2 border-gray-900">
                <div class="w-full h-24 grid grid-cols-8 grid-rows-2 gap-x-1 place-items-center">
                  <p class="text-sm font-semibold leading-6 text-gray-900 row-span-2">{{unidad_productiva.nombre}}</p>
                  <div class="row-span-2">
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{unidad_productiva.estado}}</p>
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{unidad_productiva.municipio}}</p>
                    <p class="text-sm leading-6 text-gray-900 row-span-2">{{unidad_productiva.parroquia}}</p>
                  </div>
                  <p class="text-sm leading-6 text-gray-900 col-span-2 row-span-2">{{unidad_productiva.direccion}}</p>
                  <div v-if="!(unidad_productiva.persona_id === null)" class="w-full h-full place-items-center col-span-2 row-span-2 grid grid-cols-2 rounded border border-solid border-black bg-yellow-400">
                    <p class="text-sm leading-6 font-semibold text-gray-900 row-span-2">{{unidad_productiva.persona.rif}}</p>
                    <p class="text-sm leading-6 font-semibold text-gray-900 row-span-2">{{unidad_productiva.persona.nombre}}</p>
                  </div>
                  <div v-else class="w-full h-full place-items-center col-span-2 row-span-2 grid grid-cols-2 rounded border border-solid border-black bg-yellow-400">
                    <p class="text-sm leading-6 font-semibold text-gray-900 row-span-2">{{unidad_productiva.empresa.rif}}</p>
                    <p class="text-sm leading-6 font-semibold text-gray-900 row-span-2">{{unidad_productiva.empresa.nombre}}</p>
                  </div>
                  <div class="w-full h-full ml-1 col-span-1 row-span-2 grid-cols-1 place-items-start content-center rounded border border-solid border-black bg-blue-400 overflow-y-auto overflow-x-hidden">
                    <p class="ml-1 font-semibold text-sm" v-for="producto in unidad_productiva.productos">-{{producto.nombre}}</p>
                  </div>
                  <Link class="w-full flex items-center justify-center h-5/6 mb-1 text-sm ml-3 text-gray-900 font-bold p-1 bg-red-500 rounded border border-solid border-black" :href="route('unidadProductiva.edit', unidad_productiva.id)">EDITAR</Link>
                  <button class="w-full flex items-center justify-center h-5/6 mt-1 text-sm ml-3 text-gray-900 font-bold p-1 bg-red-500 rounded border border-solid border-black" @click="deleteCategory(unidad_productiva.id)">BORRAR</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-2">
          <Link v-if="unidades_productivas.current_page > 1" :href="unidades_productivas.prev_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </Link>
          <div v-else></div>
          <Link v-if="unidades_productivas.current_page < unidades_productivas.last_page" :href="unidades_productivas.next_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </Link>
          <div v-else></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>