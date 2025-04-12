<script>
export default {
  name: 'ProductoEditar'
}
</script>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Producto/Form.vue'

const props = defineProps({
  producto: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  nombre: props.producto.nombre
})
</script>

<template>
  <AppLayout title="Editar Producto">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Editar Producto</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" @submit="form.put(route('producto.update', producto.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>