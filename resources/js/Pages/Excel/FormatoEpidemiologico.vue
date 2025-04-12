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
  registro_eventos_fitosanitarios: '',
  fecha_notificacion: '',
  dia: '',
  mes: '',
  año: '',
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
  responsable_transcripcion: '',
})

const eliminarArchivo = () => {
  if (confirm('¿Esta seguro que desea eliminar todos los registros de la tabla de excel actual?')) {
    Inertia.get(route('excel.epidemiologicoDestroy'))
  }
}
const descargar = () => {
  const url = route('descarga.formatoEpidemiologico') + `?t=${new Date().getTime()}`; //The last addition is for disabling browser cache
  window.location.href = url;
}
const eliminarFila = (index) => {
  if (confirm('¿Esta seguro que desea eliminar este registro de la tabla de excel actual?')) {
    Inertia.delete(route('excel.epidemiologicoDelete', index))
  }
}

</script>

<template>
    <AppLayout title="Formato Epidemiologico"> 
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Formato Data Epidemiológica {{year}}
            </h2>
        </template>
        <div class="py-4">
          <div class="max-w-full mx-auto sm:px-6 lg:px-8 overflow-x-auto">
            <div class="grid grid-cols-3 grid-rows-1 place-items-center w-full p-6 my-4 text-sm bg-white shadow-xl sm:rounded-lgp-4">
              <SecondaryButton>
                <Link :href="route('excel.epidemiologicoCreate')">
                  Registrar nueva inspeccion
                </Link>
              </SecondaryButton>
              <SecondaryButton @click="eliminarArchivo">Reiniciar archivo de Excel</SecondaryButton>
              <SecondaryButton @click="descargar">Descargar Archivo Excel</SecondaryButton>
            </div>
          </div>
            <div v-if="tablas !== null" class="max-w-full mx-auto sm:px-6 lg:px-8 overflow-x-auto">
              <table v-if="tablas[6] !== null" class="w-full pt-2 pb-6 text-sm bg-white shadow-xl sm:rounded-lgp-4 border-separate border-spacing-x-12">
                <thead>
                  <tr>
                    <th>Tipo de Evento</th><th>Registro de Notificacion</th><th>Registro de Eventos Fitosanitarios</th><th>Fecha de Notificacion</th><th>Dia-Mes-Año</th><th>Semana Epidemiologica</th><th>Lugar Donde se Realizo la Inspeccion</th><th>Direccion de la Unidad Inspeccionada</th><th>Nombre de la Unidad Inspeccionada</th><th>Rubro o Producto</th><th>Nombre Comun de la Plaga</th><th>Nombre Cientifico de la Plaga</th><th>Porcentaje de Infestacion</th><th>Cantidad Inspeccionada</th><th>Unidad de Medida</th><th>Cant de Producto Afectado</th><th>Parte Afectada</th><th>Estado Fenologico del Cultivo</th><th>Nombre del Propietario</th><th>C.I o RIF del Propietario</th><th>Punto de Referencia</th><th>Laboratorio Donde se Envia la Muestra</th><th>Fecha de Envio al Laboratorio</th><th>Numero de Muestras Enviadas</th><th>Tecnico Responsable de la Inspeccion</th><th>Responsable de la Transcripcion</th><th>Eliminar Fila</th>
                  </tr>
                </thead>
                <tbody>  
                  <tr v-for="(tabla, index) in tablas" class="text-center">
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.tipo_evento }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.registro_notificacion}}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.registro_eventos_fitosanitarios }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.fecha_notificacion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.dia+'-'+tabla.mes+'-'+tabla.año }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.semana_epidemiologica }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.tipo_lugar_inspeccion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.unidad_direccion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.unidad_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.producto_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.plaga_nombre_comun }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.plaga_nombre_cientifico }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.porcentaje_infestacion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.cantidad_inspeccionada }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.unidad }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.cantidad_afectado }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.parte_afectada }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.estado_fenologico }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.propietario_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.propietario_ci }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.punto_referencia }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.nombre_laboratorio }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.fecha_envio }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.numero_muestras_enviadas }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.tecnico_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.responsable_transcripcion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      <button @click="eliminarFila(index)" class="w-full items-center justify-center h-5/6 text-sm text-gray-900 font-bold px-3 py-2 my-1 bg-red-500 rounded border border-solid border-black">Borrar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </AppLayout>
  </template>