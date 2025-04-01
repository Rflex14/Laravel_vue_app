<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import Form from '@/Components/Excel/FormFormatoAlmacenes.vue'

const props = defineProps({
  almacenes: {
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
  tipo_evento: '',
  registro_notificacion: '',
  fecha_notificacion: '',
  fecha_inspeccion: '',
  semana_epidemiologica: '',
  almacen_id: '',
  empresa_id: '',
  producto_id: '',
  cantidad_total: '',
  unidad: '',
  cantidad_nacional: '',
  cantidad_afectado: '',
  plagas: '',
  medidas_recomendadas: '',
  fitosanitario: '',
  fecha_proxima: '',
  observaciones: '',
  tecnico_id: '',
  archivo: "formatos/Formato Data de Silos, Almacenes, Depósitos/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx"
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
            <Form :form="form" :almacenes="almacenes" :tecnicos="tecnicos" @submit="form.post(route('excel.almacenesStore'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>