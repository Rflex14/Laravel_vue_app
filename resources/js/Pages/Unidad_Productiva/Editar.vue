<script>
export default {
  name: 'unidad_productivaEditar'
}
</script>

<script setup>
import { onBeforeMount } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Unidad_Productiva/Form.vue'

const props = defineProps({
  unidad_productiva: {
    type: Object,
    required: true
  },
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
  nombre: props.unidad_productiva.nombre,
  estado: props.unidad_productiva.estado,
  municipio: props.unidad_productiva.municipio,
  parroquia: props.unidad_productiva.parroquia,
  direccion: props.unidad_productiva.direccion,
  hectareasActivas: props.unidad_productiva.hectareasActivas,
  hectareasInactivas: props.unidad_productiva.hectareasInactivas,
  este: props.unidad_productiva.este,
  norte: props.unidad_productiva.norte,
  persona_id: props.unidad_productiva.persona_id,
  empresa_id: props.unidad_productiva.empresa_id
})
onBeforeMount(() => {
  console.log(form);
  console.log(props.unidad_productiva);
})
</script>

<template>
  <AppLayout title="Editar Vehiculo">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Editar Unidad Productiva</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" :personas="personas" :empresas="empresas" :productos="productos" @submit="form.put(route('unidad_productiva.update', unidad_productiva.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>