<script>
export default {
  name: 'FormatoAlmacenForm'
}
</script>

<script setup>
import { ref } from 'vue';
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import SeleccionPropietario from '@/Components/Compartido/SeleccionPropietario.vue'
import SeleccionProducto from '@/Components/Compartido/SeleccionProducto.vue'


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
  }
})

const isOwner = (almacen) => {
  console.log(props.form);
  return almacen.id === props.form.almacen_id;
}

defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      Registrar Inspeccion de Silo, almacen o deposito
    </template>
    <template #description>
      Registrar una nueva inspeccion
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="tipo_evento" value="Tipo de Evento"/>
        <select name="tipo_evento" id="tipo_evento" v-model:="form.tipo_evento" class="mt-1 block w-full">
          <option value="0">0 - Plagas Comunes</option>
          <option value="1">1 - Presuntivo</option>
          <option value="2">2 - Plaga Cuarentenaria</option>
          <option value="3">3 - Sin Novedad</option>
        </select>
        <InputError :message="$page.props.errors.tipo_evento" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="registro_notificacion" value="Registro de notificacion"
          class=" " />
        <TextInput id="registro_notificacion" type="text" v-model:="form.registro_notificacion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.registro_notificacion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha_notificacion" value="Fecha de notificacion"/>
        <TextInput id="fecha_notificacion" type="date" v-model:="form.fecha_notificacion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha_notificacion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha_inspeccion" value="Fecha de inspeccion"/>
        <TextInput id="fecha_inspeccion" type="date" v-model:="form.fecha_inspeccion" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha_inspeccion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="semana_epidemiologica" value="Semana epidemiologica"/>
        <TextInput id="semana_epidemiologica" type="number" v-model:="form.semana_epidemiologica" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.semana_epidemiologica" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="almacen_id" value="Lugar donde se realizo la inspeccion"/>
        <select name="almacen_id" id="almacen_id" v-model:="form.almacen_id" class="mt-1 block w-full">
          <option v-for="almacen in almacenes" :value="almacen.id">{{ almacen.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.almacen_id" class="mt-2" />
      </div>
      <div v-if="form.almacen_id !== ''" class="col-span-6 sm:col-span-6">
        <div class="col-span-6 sm:col-span-6">
          <InputLabel for="empresa_id" value="Nombre de empresa inspeccionada"/>
          <select name="empresa_id" id="empresa_id" v-model:="form.empresa_id" class="mt-1 block w-full">
            <option :value="almacenes[almacenes.findIndex(isOwner)].empresa.id">{{ almacenes[almacenes.findIndex(isOwner)].empresa.nombre }}</option>
          </select>
          <InputError :message="$page.props.errors.empresa_id" class="mt-2" />
        </div>
      </div>
      <div v-if="form.almacen_id !== ''" class="col-span-6 sm:col-span-6">
        <InputLabel for="producto_id" value="Rubro o Producto"/>
        <select name="producto_id" id="producto_id" v-model:="form.producto_id" class="mt-1 block w-full">
          <option v-for="producto in almacenes.find(isOwner).productos" :value="producto.id">{{ producto.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.producto_id" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidad_total" value="Cantidad total de producto"/>
        <TextInput id="cantidad_total" type="number" v-model:="form.cantidad_total" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.cantidad_total" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="unidad" value="Unidad de medida"/>
        <TextInput id="unidad" type="text" v-model:="form.unidad" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.unidad" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidad_nacional" value="Cantidad de producto nacional o importado"/>
        <TextInput id="cantidad_nacional" type="number" v-model:="form.cantidad_nacional" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.cantidad_nacional" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidad_afectado" value="Cantidad de producto afectado"/>
        <TextInput id="cantidad_afectado" type="number" v-model:="form.cantidad_afectado" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.cantidad_afectado" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="plagas" value="Plagas o enfermedades"/>
        <TextInput id="plagas" type="text" v-model:="form.plagas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.plagas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="medidas_recomendadas" value="Medidas recomendadas"/>
        <TextInput id="medidas_recomendadas" type="text" v-model:="form.medidas_recomendadas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.medidas_recomendadas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fitosanitario" value="¿Posee certificado fito sanitario?"/>
        <TextInput id="fitosanitario" type="checkbox" checked v-model:="form.fitosanitario" class="w-10 h-5 mt-1"/>
        <InputError :message="$page.props.errors.fitosanitario" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha_proxima" value="Fecha de la proxima visita"/>
        <TextInput id="fecha_proxima" type="date" v-model:="form.fecha_proxima" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha_proxima" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="observaciones" value="Observaciones"/>
        <TextInput id="observaciones" type="text" v-model:="form.observaciones" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.observaciones" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="tecnico_id" value="Tecnico responsable de la inspeccion"/>
        <select id="tecnico_id" v-model:="form.tecnico_id" class="mt-1 block w-full">
          <option v-for="tecnico in tecnicos" :value="tecnico.id">{{ tecnico.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.tecnico_id" class="mt-2" />
      </div>
    </template>
    <template #actions>
      <PrimaryButton>
        Registrar
      </PrimaryButton>
    </template>
  </FormSection>
</template>