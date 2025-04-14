<script>
  export default {
    name: 'VehiculoCrear'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Vehiculo/Form.vue'
 
const props = defineProps ({
  personas: {
    type: Object,
    required: true
  },
  empresas: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  placa: '',
  modelo: '',
  marca: '',
  persona_id:'',
  empresa_id:''
})
</script>

<template>
  <AppLayout title="Registrar Vehículo">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Vehículos</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" :personas="personas" :empresas="empresas" @submit="form.post(route('vehiculo.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>