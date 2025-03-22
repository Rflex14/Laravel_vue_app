<script>
  export default {
    name: 'PersonaIndex'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  personas: {
    type: Object,
    required: true
  }
})

const deleteCategory = id => {
  if (confirm('Esta seguro?')) {
    Inertia.delete(route('persona.destroy', id))
  }
}

</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Personas</h1>
    </template>

    <div class="py-12 ">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link :href="route('persona.create')">
              Crear Persona
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li class="mb-2" v-for="persona in personas.data"> 
              <div class="w-full px-4 py-3 border-solid border-2 border-gray-900">
                <div class="w-full pl-4 grid grid-cols-6 grid-rows-2 place-content-evenly">
                  <p class="text-sm flex items-center font-semibold leading-6 text-gray-900 row-span-2">{{persona.rif}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{persona.cedula}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{persona.nombre}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{persona.apellido}}</p>
                  <p class="text-sm flex items-center leading-6 text-gray-900 row-span-2">{{persona.telefono}}</p>
                  <Link class="mb-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" :href="route('persona.edit', persona.id)">EDITAR</Link>
                  <Link class="mt-1 text-sm ml-3 leading-6 text-gray-900 font-bold text-center p-1 bg-red-400 rounded border border-solid border-black" @click="deleteCategory(persona.id)">BORRAR</Link>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-2">
          <Link v-if="personas.current_page > 1" :href="personas.prev_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Anterior
          </Link>
          <div v-else></div>
          <Link v-if="personas.current_page < personas.last_page" :href="personas.next_page_url" class="py-2 px-4 rounded bg-dark-subtle">
            Siguiente
          </Link>
          <div v-else></div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>