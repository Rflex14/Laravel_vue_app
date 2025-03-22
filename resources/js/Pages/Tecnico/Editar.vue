<script>
export default {
  name: 'TecnicoEditar'
}
</script>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Tecnico/Form.vue'

const props = defineProps({
  tecnico: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  cedula: props.tecnico.cedula,
  nombre: props.tecnico.nombre,
  apellido: props.tecnico.apellido,
  telefono: props.tecnico.telefono
})
</script>

<template>
  <AppLayout title="Editar Tecnico">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Editar Tecnico</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" @submit="form.put(route('tecnico.update', tecnico.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>