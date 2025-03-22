<script>
export default {
  name: 'PersonaEditar'
}
</script>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Persona/Form.vue'

const props = defineProps({
  persona: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  rif: props.persona.rif,
  cedula: props.persona.cedula,
  nombre: props.persona.nombre,
  apellido: props.persona.apellido,
  telefono: props.persona.telefono
})
</script>

<template>
  <AppLayout title="Editar Persona">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Editar Persona</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" @submit="form.put(route('persona.update', persona.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>