<script>
export default {
  name: 'FormatoEpidemiologicoForm'
}
</script>

<script setup>
import { ref, computed, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const tipo_lugar = ref('');

const props = defineProps({
  form: {
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
  unidades: {
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

const productosFiltrados = computed(() => {
  if (tipo_lugar.value === 'unidad') {
    const unidad = props.unidades.find(unidad => unidad.id === props.form.lugar_id);
    return unidad ? unidad.productos : [];
  } else if (tipo_lugar.value === 'almacen') {
    const almacen = props.almacenes.find(almacen => almacen.id === props.form.lugar_id);
    return almacen ? almacen.productos : [];
  } else if (tipo_lugar.value === 'vehiculo') {
    return props.productos;
  }
  return [];
})

const propietario = computed(() => {
  if (tipo_lugar.value === 'unidad') {
    const unidad = props.unidades.find(unidad => unidad.id === props.form.lugar_id);
    if(unidad) {
      let owner = unidad.empresa_id ? unidad.empresa : unidad.persona;
      props.form.propietario_id = owner.id;
      return owner;
    }
  } else if (tipo_lugar.value === 'almacen') {
    const almacen = props.almacenes.find(almacen => almacen.id === props.form.lugar_id);
    if(almacen) {
      let owner = almacen.empresa_id ? almacen.empresa : almacen.persona;
      props.form.propietario_id = owner.id;
      return owner;
    }
  } else if (tipo_lugar.value === 'vehiculo') {
    const vehiculo = props.vehiculos.find(vehiculo => vehiculo.id === props.form.lugar_id)
    if(vehiculo) {
      let owner = vehiculo.empresa_id ? vehiculo.empresa : vehiculo.persona;
      props.form.propietario_id = owner.id;
      return owner;
    }
  }
  return null;
})

watch([() => props.form.tipo_lugar, () => props.form.lugar_id], () => {
  props.form.producto_id = '';
});

const aver = () => {
  console.log(props.form);
  console.log(productosFiltrados.value);
}

const reiniciarTipo = () => {
  props.form.lugar_id = '';
  props.form.tipo_lugar_inspeccion= tipo_lugar.value;
  console.log(props.form.lugar_id);
} 

defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      Registro Data Epidemiologica
    </template>
    <template #description>
      Registrar una nueva inspeccion
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="tipo_evento" value="Tipo de Evento"/>
        <select name="tipo_evento" id="tipo_evento" v-model="form.tipo_evento" class="mt-1 block w-full">
          <option value="0">0 - Plagas Comunes</option>
          <option value="1">1 - Presuntivo</option>
          <option value="2">2 - Plaga Cuarentenaria</option>
          <option value="3">3 - Sin Novedad</option>
        </select>
        <InputError :message="$page.props.errors.tipo_evento" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="registro_notificacion" value="Registro de notificacion"/>
        <TextInput id="registro_notificacion" type="text" v-model="form.registro_notificacion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.registro_notificacion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="registro_eventos_fitosanitarios" value="Registro de eventos fitosanitarios"/>
        <TextInput id="registro_eventos_fitosanitarios" type="text" v-model="form.registro_eventos_fitosanitarios" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.registro_eventos_fitosanitarios" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha_notificacion" value="Fecha de notificacion"/>
        <TextInput id="fecha_notificacion" type="date" v-model="form.fecha_notificacion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha_notificacion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="año_mes_dia" value="Año_Mes_Dia"/>
        <TextInput id="año_mes_dia" type="date" v-model="form.año_mes_dia" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.año_mes_dia" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="semana_epidemiologica" value="Semana epidemiologica"/>
        <TextInput id="semana_epidemiologica" type="number" v-model="form.semana_epidemiologica" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.semana_epidemiologica" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="tipo_lugar" value="Tipo de lugar donde se realizo la inspeccion"/>
        <select v-on:change="reiniciarTipo" name="tipo_lugar" id="tipo_lugar" v-model="tipo_lugar" class="mt-1 block w-full">
          <option value="unidad">Unidad Productiva</option>
          <option value="almacen">Almacen</option>
          <option value="vehiculo">Vehiculo</option>
        </select>
        <InputError :message="$page.props.errors.tipo_lugar_inspeccion" class="mt-2" />
      </div>

      <div v-if="tipo_lugar !== '' && tipo_lugar === 'unidad'" class="col-span-6 sm:col-span-6">
        <InputLabel for="unidad_id" value="Unidad productiva inspeccionada"/>
        <select name="unidad_id" id="unidad_id" v-model="form.lugar_id" class="mt-1 block w-full">
          <option v-if="unidades.length === 0" disabled>No hay unidades productivas disponibles</option>
          <option v-for="unidad in unidades" :value="unidad.id">{{ unidad.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.lugar_id" class="mt-2" />
      </div>
      <div v-if="tipo_lugar !== '' && tipo_lugar === 'almacen'" class="col-span-6 sm:col-span-6">
        <InputLabel for="almacen_id" value="Almacen inspeccionado"/>
        <select name="almacen_id" id="almacen_id" v-model="form.lugar_id" class="mt-1 block w-full">
          <option v-if="almacenes.length === 0" disabled>No hay almacenes disponibles</option>
          <option v-for="almacen in almacenes" :value="almacen.id">{{ almacen.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.lugar_id" class="mt-2" />
      </div>
      <div v-if="tipo_lugar !== '' && tipo_lugar === 'vehiculo'" class="col-span-6 sm:col-span-6">
        <InputLabel for="vehiculo_id" value="Vehiculo inspeccionado"/>
        <select name="vehiculo_id" id="vehiculo_id" v-model="form.lugar_id" class="mt-1 block w-full">
          <option v-if="vehiculos.length === 0" disabled>No hay vehiculos disponibles</option>
          <option v-for="vehiculo in vehiculos" :value="vehiculo.id">{{ vehiculo.placa + ' - ' + vehiculo.marca}}</option>
        </select>
        <InputError :message="$page.props.errors.lugar_id" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="propietario" value="Propietario"/>
        <div v-if="propietario !== null" id="propietario" name="propietario" class="block mt-1 h-12 pl-2 w-full flex items-center border border-solid border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm">{{propietario.nombre}}</div>
        <div v-else id="propietario" name="propietario" class="block mt-1 h-12 pl-2 w-full flex items-center border border-solid border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm">Seleccione un lugar primero</div>
      </div>

      <div v-if="tipo_lugar !== '' && form.lugar_id !== ''" class="col-span-6 sm:col-span-6">
        <InputLabel for="producto_id" value="Producto inspeccionado"/>
        <select name="producto_id" id="producto_id" v-model="form.producto_id" class="mt-1 block w-full">
          <option v-if="productosFiltrados.length === 0" disabled>No hay productos disponibles</option>
          <option v-for="producto in productosFiltrados" :key="producto.id" :value="producto.id">{{ producto.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.producto_id" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="plaga_nombre_comun" value="Nombre comun de plaga"/>
        <TextInput id="plaga_nombre_comun" type="text" v-model="form.plaga_nombre_comun" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.plaga_nombre_comun" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="plaga_nombre_cientifico" value="Nombre cientifico de plaga"/>
        <TextInput id="plaga_nombre_cientifico" type="text" v-model="form.plaga_nombre_cientifico" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.plaga_nombre_cientifico" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="porcentaje_infestacion" value="Porcentaje de infestacion"/>
        <TextInput id="porcentaje_infestacion" type="number" v-model="form.porcentaje_infestacion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.porcentaje_infestacion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidad_inspeccionada" value="Cantidad inspeccionada"/>
        <TextInput id="cantidad_inspeccionada" type="number" v-model="form.cantidad_inspeccionada" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.cantidad_inspeccionada" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="unidad" value="Unidad de medida"/>
        <TextInput id="unidad" type="text" v-model="form.unidad" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.unidad" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidad_afectada" value="Cantidad de producto afectado"/>
        <TextInput id="cantidad_afectada" type="number" v-model="form.cantidad_afectado" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.cantidad_afectado" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="parte_afectada" value="Parte afectada"/>
        <TextInput id="parte_afectada" type="text" v-model="form.parte_afectada" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.parte_afectada" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="estado_fenologico" value="Estado fenologico del cultivo"/>
        <TextInput id="estado_fenologico" type="text" v-model="form.estado_fenologico" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.estado_fenologico" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="punto_referencia" value="Punto de referencia"/>
        <TextInput id="punto_referencia" type="text" v-model="form.punto_referencia" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.punto_referencia" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="nombre_laboratorio" value="Laboratorio donde se envia la muestra"/>
        <TextInput id="nombre_laboratorio" type="text" v-model="form.nombre_laboratorio" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.nombre_laboratorio" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha_envio" value="Fecha de envio"/>
        <TextInput id="fecha_envio" type="date" v-model="form.fecha_envio" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha_envio" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="numero_muestras_enviadas" value="Numero de muestras enviadas"/>
        <TextInput id="numero_muestras_enviadas" type="number" v-model="form.numero_muestras_enviadas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.numero_muestras_enviadas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="observaciones" value="Observaciones"/>
        <TextInput id="observaciones" type="text" v-model="form.observaciones" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.observaciones" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="tecnico_id" value="Tecnico responsable de la inspeccion"/>
        <select id="tecnico_id" v-model="form.tecnico_id" class="mt-1 block w-full">
          <option v-for="tecnico in tecnicos" :value="tecnico.id">{{ tecnico.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.tecnico_id" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="responsable_transcripcion" value="Responsable de la transcripcion"/>
        <TextInput id="responsable_transcripcion" type="text" v-model="form.responsable_transcripcion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.responsable_transcripcion" class="mt-2" />
      </div>
    </template>
    <template #actions>
      <PrimaryButton v-on:click="aver">
        Registrar
      </PrimaryButton>
    </template>
  </FormSection>
</template>