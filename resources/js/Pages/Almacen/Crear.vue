<script>
  export default {
    name: 'AlmacenCrear'
  }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Almacen/Form.vue'
 
const props = defineProps ({
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
  sector: '',
  direccion: '',
  cantidadMaxima: '',
  unidad: '',
  empresa_id: '',
  productos: []
})

</script>

<template>
  <AppLayout title="Registrar Almacén">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Almacenes</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" :empresas="empresas" :productos="productos" @submit="form.post(route('almacen.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>