<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  unidades: {
    type: Object,
    required: true
  },
  tecnicos: {
    type: Object,
    required: true
  },
  tablas: {
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
  persona_id: '',
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
})

const eliminarArchivo = () => {
  if (confirm('¿Esta seguro que desea eliminar todos los registros de la tabla de excel actual?')) {
    Inertia.get(route('excel.vegetalDestroy'))
  }
}
const descargar = () => {
  const url = route('descarga.formatoVegetal') + `?t=${new Date().getTime()}`; //The last addition is for disabling browser cache
  window.location.href = url;
}
const eliminarFila = (index) => {
  if (confirm('¿Esta seguro que desea eliminar este registro de la tabla de excel actual?')) {
    Inertia.delete(route('excel.vegetalDelete', index))
  }
}

</script>

<template>
    <AppLayout title="Dashboard"> 
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Formato Proteccion Vegetal {{year}}
            </h2>
        </template>
        <div class="py-4">
          <div class="max-w-full mx-auto sm:px-6 lg:px-8 overflow-x-auto">
            <div class="grid grid-cols-3 grid-rows-1 place-items-center w-full p-6 my-4 text-sm bg-white shadow-xl sm:rounded-lgp-4">
              <SecondaryButton>
                <Link :href="route('excel.vegetalCreate')">
                  Registrar nueva inspeccion
                </Link>
              </SecondaryButton>
              <SecondaryButton @click="eliminarArchivo">Reiniciar archivo de Excel</SecondaryButton>
              <SecondaryButton @click="descargar">Descargar Archivo Excel</SecondaryButton>
            </div>
          </div>
            <div v-if="tablas !== null" class="max-w-full mx-auto sm:px-6 lg:px-8 overflow-x-auto">
              <table v-if="tablas[5] !== null" class="w-full pt-2 pb-6 text-sm bg-white shadow-xl sm:rounded-lgp-4 border-separate border-spacing-x-12">
                <thead>
                  <tr>
                    <th>Semana</th><th>Numero de acta</th><th>Fecha</th><th>Estado</th><th>Municipio</th><th>Parroquia</th><th>Sector</th><th>Predio</th><th>Rubro o Producto</th><th>Nombre y Apellido del Productor</th><th>Cedula o Riff</th><th>Numero de Telefono</th><th>Hectareas Totales</th><th>Hectareas Sembradas</th><th>Hectareas Atendidas</th><th>Hectareas Afectadas</th><th>Plaga o Enfermedad</th><th>Observaciones</th><th>Tecnico Responsable de la Inspeccion</th><th>Eliminar Fila</th>
                  </tr>
                </thead>
                <tbody>  
                  <tr v-for="(tabla, index) in tablas" class="text-center">
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.semana }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.numero_acta }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.fecha }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.estado }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.municipio }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.parroquia }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.sector }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.predio }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.rubro }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.nombre_apellido_productor }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.cedula_riff }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.numero_telefono }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.hectareas_totales }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.hectareas_sembradas }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.hectareas_atendidas }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.hectareas_afectadas }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.plaga }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.observaciones }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      {{ tabla.tecnico_nombre }}
                    </td>
                    <td v-if="index >= 5 && tabla.semana !== null">
                      <button @click="eliminarFila(index)" class="w-full items-center justify-center h-5/6 text-sm text-gray-900 font-bold px-3 py-2 my-1 bg-red-500 rounded border border-solid border-black">Borrar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </AppLayout>
</template>