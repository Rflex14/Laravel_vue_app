<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Excel/FormFormatoVegetal.vue'

const props = defineProps({
  unidades: {
    type: Object,
    required: true
  },
  tecnicos: {
    type: Object,
    required: true
  }
})

const date = new Date();
let year = date.getFullYear();

const form = useForm ({
  semana: '',
  numero_acta: '',
  fecha: '',
  unidad_id: '',
  rubro_id: '',
  hectareas_totales: '',
  hectareas_sembradas: '',
  hectareas_atendidas: '',
  hectareas_afectadas: '',
  plaga: '',
  medidas: '',
  observaciones: '',
  tecnico_id: '',
})

</script>

<template>
  <AppLayout title="Registrar nueva Inspeccion">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Registrar nueva Inspección</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" :unidades="unidades" :tecnicos="tecnicos" @submit="form.post(route('excel.vegetalStore'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>