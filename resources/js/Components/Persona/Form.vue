<script>
export default {
  name: 'PersonaForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
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
      {{ updating ? 'Actualizar Persona' : 'Registrar Persona' }}
    </template>
    <template #description>
      {{ updating ? 'Actualizar la persona seleccioanda' : 'Registrar una persona nueva' }}
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="rif" value="Rif" />
        <TextInput id="rif" v-model="form.rif" type="text" autocomplete="rif" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.rif" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cedula" value="Cedula" />
        <TextInput id="cedula" v-model="form.cedula" type="number" autocomplete="cedula" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.cedula" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="nombre" value="Nombre" />
        <TextInput id="nombre" v-model="form.nombre" type="text" autocomplete="nombre" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.nombre" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="apellido" value="Apellido" />
        <TextInput id="apellido" v-model="form.apellido" type="text" autocomplete="apellido" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.apellido" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="telefono" value="Telefono" />
        <TextInput id="telefono" v-model="form.telefono" type="number" autocomplete="telefono" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.telefono" class="mt-2" />
      </div>
    </template>
    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Actualizar' : 'Registrar' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>