<script>
export default {
  name: 'AlmacenForm'
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
  props.form.productos = _productos;
  console.log(props.form.productos);
}
defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? 'Editar Almacén' : 'Registrar Almacén' }}
    </template>
    <template #description>
      {{ updating ? 'Editar el Almacén seleccionado' : 'Registrar un Almacén nuevo' }}
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
        <InputLabel for="sector" value="Sector" />
        <TextInput id="sector" v-model="form.sector" type="text" autocomplete="sector" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.sector" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="direccion" value="Dirección" />
        <TextInput id="direccion" v-model="form.direccion" type="text" autocomplete="direccion" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.direccion" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cantidadMaxima" value="Cantidad Máxima" />
        <TextInput id="cantidadMaxima" v-model="form.cantidadMaxima" type="number" autocomplete="cantidadMaxima" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.cantidadMaxima" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="unidad" value="Unidad de medición" />
        <TextInput id="Unidad" v-model="form.unidad" type="text" autocomplete="unidad" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.unidad" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="empresa_id" value="Empresa propietaria" />
        <select name="empresa_id" id="empresa_id" v-model="form.empresa_id">
          <option value="">Seleccione</option>
          <option v-for="empresa in empresas" :value="empresa.id">{{ empresa.rif }}</option>
          <InputError :message="$page.props.errors.empresa_id" class="mt-2" />
        </select>
      </div>
      <SeleccionProducto name="productos" id="productos" :seleccionados="props.form.productos" :productos="productos" @onProductos="onProductos" />
    </template>
    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Actualizar' : 'Registrar' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>