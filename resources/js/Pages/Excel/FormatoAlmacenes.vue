<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  almacenes: {
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
  archivo: "formatos\Formato Data de Silos, Almacenes, Depósitos\Formato Data de Silos, Almacenes, Depósitos 2025.xlsx"
})

const eliminarArchivo = () => {
  if (confirm('¿Esta seguro que desea eliminar todos los registros de la tabla de excel actual?')) {
    Inertia.get(route('excel.almacenesDestroy'))
  }
}
const descargar = () => {
  const url = route('descarga.formatoAlmacenes') + `?t=${new Date().getTime()}`; //The last addition is for disabling browser cache
  window.location.href = url;
}
const eliminarFila = (index) => {
  if (confirm('¿Esta seguro que desea eliminar este registro de la tabla de excel actual?')) {
    Inertia.delete(route('excel.almacenesDelete', index))
  }
}

</script>

<template>
    <AppLayout title="Formato Almacenes"> 
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Formato Data de Silos, Almacenes, Depósitos {{year}}
            </h2>
        </template>
        <div class="py-4">
          <div class="max-w-full mx-auto sm:px-6 lg:px-8 overflow-x-auto">
            <div class="grid grid-cols-3 grid-rows-1 place-items-center w-full p-6 my-4 text-sm bg-white shadow-xl sm:rounded-lgp-4">
              <SecondaryButton>
                <Link :href="route('excel.almacenesCreate')">
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
                    <th>Tipo de Evento</th><th>Registro de Notificacion</th><th>Fecha de Notificacion</th><th>Fecha de Inspeccion</th><th>Semana Epidemiologica</th><th>Lugar donde se realizo la inspeccion</th><th>Nombre Propietario</th><th>Rubro o Producto</th><th>Cantidad de Producto</th><th>Unidad de Medida</th><th>Cant de Producto Nacional o Importado</th><th>Cant de Producto Afectado</th><th>Plagas o Enfermedades</th><th>Responsable de la Empresa</th><th>Medidas Recomendadas</th><th>¿Posee Certificado Fitosanitario?</th><th>Fecha de la Proxima Visita</th><th>Tecnico Responsable de la Inspeccion</th><th>Eliminar Fila</th>
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
                      {{ tabla.fecha_notificacion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.fecha_inspeccion }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.semana_epidemiologica }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.almacen_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.propietario_nombre}}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.producto_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.cantidad_total }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.unidad }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.cantidad_nacional }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.cantidad_afectado }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.plagas }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.responsable_nombre }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.medidas_recomendadas }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.fitosanitario }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.fecha_proxima }}
                    </td>
                    <td v-if="index >= 6 && tabla.tipo_evento !== null">
                      {{ tabla.tecnico_nombre }}
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
<!--
    <form>
                <div class="text-sm bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <div class="p-6">
                    <Link :href="route('excel.almacenesCreate')">
                      Crear Almacen
                    </Link>
                  </div>
                </div>
                <div class="text-xs bg-white overflow-x-scroll overflow-y-hidden shadow-xl sm:rounded-lg mt-4">
                  <div class="w-full h-28 flex flex-col flex-wrap place-content-evenly flex-shrink-0 p-4">
                    <div>
                      <InputLabel for="tipo_evento" value="Tipo de Evento" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <select name="tipo_evento" id="tipo_evento" v-model:="form.tipo_evento" class="w-40 text-[length:inherit]">
                        <option value="0">0 - Plagas Comunes</option>
                        <option value="1">1 - Presuntivo</option>
                        <option value="2">2 - Plaga Cuarentenaria</option>
                        <option value="3">3 - Sin Novedad</option>
                      </select>
                    </div>
                    <div>
                      <InputLabel for="registro_notificacion" value="Registro de notificacion" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="registro_notificacion" type="text" v-model:="form.registro_notificacion" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="fecha_notificacion" value="Fecha de notificacion" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="fecha_notificacion" type="date" v-model:="form.fecha_notificacion" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="fecha_inspeccion" value="Fecha de inspeccion" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="fecha_inspeccion" type="date" v-model:="form.fecha_inspeccion" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="semana_epidemiologica" value="Semana epidemiologica" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="semana_epidemiologica" type="number" v-model:="form.semana_epidemiologica" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="almacen_id" value="Lugar donde se realizo la inspeccion" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <select name="almacen_id" id="almacen_id" v-model:="form.almacen_id" class="w-40 text-[length:inherit]">  
                        <option v-for="almacen in almacenes" :value="almacen.id">{{ almacen.nombre }}</option>
                      </select>
                    </div>
                    <div v-if="form.almacen_id !== ''">
                      <div v-if="almacenes.find(isOwner).persona === null">
                        <InputLabel for="empresa_id" value="Nombre de empresa inspeccionada" class="h-10 w-40 text-center text-[length:inherit]"/>
                        <select name="empresa_id" id="empresa_id" v-model:="form.empresa_id" class="w-40 text-[length:inherit]">  
                          <option value="">{{ almacenes[almacenes.findIndex(isOwner)].empresa.nombre }}</option>
                        </select>
                      </div>
                      <div v-else-if="almacenes.find(isOwner).empresa === null">
                        <InputLabel for="persona_id" value="Nombre de persona inspeccionada" class="h-10 w-40 text-center text-[length:inherit]"/>
                        <select name="persona_id" id="persona_id" v-model:="form.persona_id" class="w-40 text-[length:inherit]">  
                          <option value="">{{ almacenes[almacenes.findIndex(isOwner)].persona.nombre }} </option>
                        </select>
                      </div>
                    <div v-else></div>
                    </div>
                    <div v-if="form.almacen_id !== ''">
                      <InputLabel for="producto_id" value="Rubro o Producto" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <select name="producto_id" id="producto_id" v-model:="form.producto_id" class="w-40 text-[length:inherit]">                          <option v-for="producto in almacenes.find(isOwner).productos" :value="producto.id">{{ producto.nombre }}</option>
                      </select>
                    </div>
                    <div>
                      <InputLabel for="cantidad_total" value="Cantidad total de producto" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="cantidad_total" type="number" v-model:="form.cantidad_total" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="unidad" value="Unidad de medida" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="unidad" type="text" v-model:="form.unidad" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="cantidad_nacional" value="Cantidad de producto nacional o importado" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="cantidad_nacional" type="number" v-model:="form.cantidad_nacional" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="cantidad_afectado" value="Cantidad de producto afectado" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="cantidad_afectado" type="number" v-model:="form.cantidad_afectado" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="plagas" value="Plagas o enfermedades" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="plagas" type="text" v-model:="form.plagas" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="medidas_recomendadas" value="Medidas recomendadas" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="medidas_recomendadas" type="text" v-model:="form.medidas_recomendadas" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div class="flex flex-col items-center">
                      <InputLabel for="fitosanitario" value="¿Posee certificado fito sanitario?" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="fitosanitario" type="checkbox" v-model:="form.fitosanitario" class="w-10 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="fecha_proxima" value="Fecha de la proxima visita" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="fecha_proxima" type="date" v-model:="form.fecha_proxima" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="observaciones" value="Observaciones" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <TextInput id="observaciones" type="text" v-model:="form.observaciones" class="w-40 text-[length:inherit]"/>
                    </div>
                    <div>
                      <InputLabel for="tecnico_id" value="Tecnico responsable de la inspeccion" class="h-10 w-40 text-center text-[length:inherit]"/>
                      <select id="tecnico_id" v-model:="form.tecnico_id" class="w-40 text-[length:inherit]">
                        <option v-for="tecnico in tecnicos" :value="tecnico.id">{{ tecnico.nombre }}</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>   -->
</template>


