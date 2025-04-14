<script>
export default {
  name: 'almacenEditar'
}
</script>

<script setup>
import { onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Almacen/Form.vue'

const props = defineProps({
  almacen: {
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
  nombre: props.almacen.nombre,
  estado: props.almacen.estado,
  municipio: props.almacen.municipio,
  parroquia: props.almacen.parroquia,
  sector: props.almacen.sector,
  direccion: props.almacen.direccion,
  cantidadMaxima: props.almacen.cantidadMaxima,
  unidad: props.almacen.unidad,
  empresa_id: props.almacen.empresa_id,
  productos: props.almacen.productos
})
onBeforeMount(() => {
  console.log(form);
  console.log(props.almacen);
})
</script>

<template>
  <AppLayout title="Editar Almacén">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Almacenes</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" :empresas="empresas" :productos="productos" @submit="form.put(route('almacen.update', almacen.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>