<script>
  export default {
    name: 'EmpresaCrear'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Empresa/Form.vue'
 
const form = useForm ({
  rif: '',
  nombre: '',
  nombre_responsable: '',
  cedula_responsable: '',
  telefono_responsable: ''
})
</script>

<template>
  <AppLayout title="Crear Empresa">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Crear Empresa</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" @submit="form.post(route('empresa.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>