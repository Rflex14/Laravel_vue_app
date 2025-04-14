<script>
  export default {
    name: 'Unidad_ProductivaCrear'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Unidad_Productiva/Form.vue'
 
const props = defineProps ({
  personas: {
    type: Object,
    required: true
  },
  empresas: {
    type: Object,
    required: true
  },
  productos: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  nombre: '',
  estado: '',
  municipio: '',
  parroquia: '',
  direccion: '',
  sector: '',
  hectareasActivas: '',
  hectareasInactivas: '',
  este: '',
  norte: '',
  persona_id: '',
  empresa_id: '',
  productos: []
})

</script>

<template>
  <AppLayout title="Registrar Unidad Productiva">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Unidades Productivas</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" :personas="personas" :empresas="empresas" :productos="productos" @submit="form.post(route('unidadProductiva.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>