<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Excel/FormFormatoEpidemiologico.vue'

const props = defineProps({
  unidades: {
    type: Object,
    required: true
  },
  almacenes: {
    type: Object,
    required: true
  },
  tecnicos: {
    type: Object,
    required: true
  },
  vehiculos: {
    type: Object,
    required: true
  },
  productos: {
    type: Object,
    required: true
  }
})

const date = new Date();
let year = date.getFullYear();

const form = useForm ({
  tipo_evento: '',
  registro_notificacion: '',
  registro_eventos_fitosanitarios: '',
  fecha_notificacion: '',
  año_mes_dia: '',
  semana_epidemiologica: '',
  tipo_lugar_inspeccion: '',
  lugar_id: '',
  producto_id: '',
  plaga_nombre_comun: '',
  plaga_nombre_cientifico: '',
  porcentaje_infestacion: '',
  cantidad_inspeccionada: '',
  unidad: '',
  cantidad_afectado: '',
  parte_afectada: '',
  estado_fenologico: '',
  propietario_id: '',
  punto_referencia: '',
  nombre_laboratorio: '',
  fecha_envio: '',
  numero_muestras_enviadas: '',
  observaciones: '',
  tecnico_id: '',
  responsable_transcripcion: ''
})
</script>

<template>
  <AppLayout title="Registrar nueva Inspeccion">
    <template #header>
      <h1 class="font-semibold text-xl -text-gray-800 leading-tight">Registrar nueva Inspeccion</h1>
    </template>
    <div class="py-12">
      <div class="max-2-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <Form :form="form" :productos="productos" :almacenes="almacenes" :unidades="unidades" :vehiculos="vehiculos" :tecnicos="tecnicos" @submit="form.post(route('excel.epidemiologicoStore'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>