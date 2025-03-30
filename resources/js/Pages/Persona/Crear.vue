<script>
  export default {
    name: 'PersonaCrear'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Persona/Form.vue'
 
const form = useForm ({
  rif: '',
  cedula: '',
  nombre: '',
  apellido: '',
  telefono: ''
})
</script>

<template>
  <AppLayout title="Crear Persona">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Crear Persona</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" @submit="form.post(route('persona.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>