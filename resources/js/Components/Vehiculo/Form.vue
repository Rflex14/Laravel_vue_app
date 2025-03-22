<script>
export default {
  name: 'VehiculoForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import SeleccionPropietario from '@/Components/Compartido/SeleccionPropietario.vue'

defineProps({
  personas: {
    type: Object,
    required: true
  },
  empresas: {
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

defineEmits(['submit'])
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? 'Actualizar Vehiculo' : 'Registrar Vehiculo' }}
    </template>
    <template #description>
      {{ updating ? 'Actualizar el vehiculo seleccionado' : 'Registrar un vehiculo nuevo' }}
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="placa" value="Placa" />
        <TextInput id="placa" v-model="form.placa" type="text" autocomplete="placa" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.placa" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="modelo" value="Modelo" />
        <TextInput id="modelo" v-model="form.modelo" type="text" autocomplete="modelo" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.modelo" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="marca" value="Marca" />
        <TextInput id="marca" v-model="form.marca" type="text" autocomplete="marca" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.marca" class="mt-2" />
      </div>
      <SeleccionPropietario :personas="personas" :empresas="empresas" :form="form" />
    </template>
    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Actualizar' : 'Registrar' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>