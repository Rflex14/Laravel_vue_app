<script>
export default {
  name: 'Unidad_ProductivaForm'
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


defineProps({
  personas: {
    type: Object,
    required: true
  },
  empresas: {
    type: Object,
    required: true
  },
  productos: {
    type: Object,
    required: true
  },
  form: {
    type: Object,
    required: true
  },
  updating: {
    type: Boolean,
    required: false,
    default: false
  }
})
const productosSeleccionados = ref([]);

const onProductos = (_productos) => {
  productosSeleccionados.value = _productos;
  console.log(productosSeleccionados.value);
}
defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? 'Actualizar Unidad Productiva' : 'Registrar Unidad Productiva' }}
    </template>
    <template #description>
      {{ updating ? 'Actualizar la Unidad Productiva seleccionada' : 'Registrar una Unidad Productiva nueva' }}
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="nombre" value="Nombre" />
        <TextInput id="nombre" v-model="form.nombre" type="text" autocomplete="nombre" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.nombre" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="estado" value="Estado" />
        <TextInput id="estado" v-model="form.estado" type="text" autocomplete="estado" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.estado" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="municipio" value="Municipio" />
        <TextInput id="municipio" v-model="form.municipio" type="text" autocomplete="municipio" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.municipio" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="parroquia" value="Parroquia" />
        <TextInput id="parroquia" v-model="form.parroquia" type="text" autocomplete="parroquia" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.parroquia" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="direccion" value="Direccion" />
        <TextInput id="direccion" v-model="form.direccion" type="text" autocomplete="direccion" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.direccion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareasActivas" value="Hectareas Activas" />
        <TextInput id="hectareasActivas" v-model="form.hectareasActivas" type="number" autocomplete="hectareasActivas" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.hectareasActivas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="hectareasInactivas" value="Hectareas Inactivas" />
        <TextInput id="hectareasInactivas" v-model="form.hectareasInactivas" type="number" autocomplete="hectareasInactivas" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.hectareasInactivas" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="este" value="Coordenada Este" />
        <TextInput id="este" v-model="form.este" type="number" autocomplete="este" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.este" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="norte" value="Coordenada Norte" />
        <TextInput id="norte" v-model="form.norte" type="number" autocomplete="norte" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.norte" class="mt-2" />
      </div>
      <SeleccionPropietario :personas="personas" :empresas="empresas" :form="form" />
      <SeleccionProducto name="productos" id="productos" :productos="productos" @onProductos="onProductos" />
    </template>
    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Actualizar' : 'Registrar' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>