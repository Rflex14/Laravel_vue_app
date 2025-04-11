<script>
export default {
  name: 'FormatoVegetalForm'
}
</script>

<script setup>
import { ref, computed, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
  form: {
    type: Object,
    required: true
  },
  unidades: {
    type: Object,
    required: true
  },
  tecnicos: {
    type: Object,
    required: true
  }
})

const isOwner = (unidad) => {
  console.log(props.form);
  return unidad.id === props.form.unidad_id;
}

defineEmits(['submit'])

const productosFiltrados = computed(() => {
    const unidad = props.unidades.find(unidad => unidad.id === props.form.unidad_id);
    return unidad ? unidad.productos : [];
})

const propietario = computed(() => {
    const unidad = props.unidades.find(unidad => unidad.id === props.form.unidad_id);
    if(unidad) {
      let owner = unidad.empresa_id ? unidad.empresa : unidad.persona;
      props.form.propietario_id = owner.id;
      return owner;
  }
  return null;
})

watch([() => props.form.unidad_id], () => {
  props.form.rubro_id = '';
});

const aver = () => {
  console.log(props.form.rubro_id);
}
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      Registrar Inspeccion de Predios en el formato Proteccion Vegetal
    </template>
    <template #description>
      Registrar una nueva inspeccion
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="semana" value="Semana"/>
        <TextInput id="semana" type="number" v-model:="form.semana" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.semana" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="numero_acta" value="Numero de acta"/>
        <TextInput id="numero_acta" type="number" v-model:="form.numero_acta" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.numero_acta" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="fecha" value="Fecha"/>
        <TextInput id="fecha" type="date" v-model:="form.fecha" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.fecha" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="unidad_id" value="Predio"/>
        <select name="unidad_id" id="unidad_id" v-model:="form.unidad_id" class="mt-1 block w-full">
          <option v-if="unidades.length === 0" disabled>No hay unidades productivas disponibles</option>
          <option v-for="unidad in unidades" :value="unidad.id">{{ unidad.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.unidad_id" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="propietario" value="Propietario"/>
        <div v-if="propietario !== null" id="propietario" name="propietario" class="block mt-1 h-12 pl-2 w-full flex items-center border border-solid border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm">{{propietario.nombre}}</div>
        <div v-else id="propietario" name="propietario" class="block mt-1 h-12 pl-2 w-full flex items-center border border-solid border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm">Seleccione un predio primero</div>
      </div>
      <div v-if="form.unidad_id !== ''" class="col-span-6 sm:col-span-6">
        <InputLabel for="rubro_id" value="Rubro o Producto"/>
        <select v-on:change="aver" name="rubro_id" id="rubro_id" v-model:="form.rubro_id" class="mt-1 block w-full">
          <option v-if="productosFiltrados.length === 0" disabled>No hay productos disponibles</option>
          <option v-for="producto in productosFiltrados" :key="producto.id" :value="producto.id">{{ producto.nombre }}</option>
        </select>
        <InputError :message="$page.props.errors.rubro_id" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareas_totales" value="Hectareas totales"/>
        <TextInput id="hectareas_totales" type="number" v-model:="form.hectareas_totales" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.hectareas_totales" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareas_sembradas" value="Hectareas sembradas"/>
        <TextInput id="hectareas_sembradas" type="number" v-model:="form.hectareas_sembradas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.hectareas_sembradas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareas_atendidas" value="Hectareas atendidas"/>
        <TextInput id="hectareas_atendidas" type="number" v-model:="form.hectareas_atendidas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.hectareas_atendidas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareas_afectadas" value="Hectareas afectadas"/>
        <TextInput id="hectareas_afectadas" type="number" v-model:="form.hectareas_afectadas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.hectareas_afectadas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="plaga" value="Plaga o enfermedad"/>
        <TextInput id="plaga" type="text" v-model:="form.plaga" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.plaga" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="medidas" value="Medidas recomendadas"/>
        <TextInput id="medidas" type="text" v-model:="form.medidas" class="mt-1 block w-full"/>
        <InputError :message="$page.props.errors.medidas" class="mt-2" />
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