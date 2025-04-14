<script>
export default {
  name: 'EmpresaEditar'
}
</script>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Empresa/Form.vue'

const props = defineProps({
  empresa: {
    type: Object,
    required: true
  }
})

const form = useForm ({
  rif: props.empresa.rif,
  nombre: props.empresa.nombre,
  nombre_responsable: props.empresa.nombre_responsable,
  apellido_responsable: props.empresa.apellido_responsable,
  cedula_responsable: props.empresa.cedula_responsable,
  telefono_responsable: props.empresa.telefono_responsable
})
</script>

<template>
  <AppLayout title="Editar Empresa">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Empresas</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :updating="true" :form="form" @submit="form.put(route('empresa.update', empresa.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>