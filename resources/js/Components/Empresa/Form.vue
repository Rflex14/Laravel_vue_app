<script>
export default {
  name: 'EmpresaForm'
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
      {{ updating ? 'Actualizar Empresa' : 'Registrar Empresa' }}
    </template>
    <template #description>
      {{ updating ? 'Actualizar la empresa seleccionada' : 'Registrar una empresa nueva' }}
    </template>
    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="rif" value="Rif" />
        <TextInput id="rif" v-model="form.rif" type="text" autocomplete="rif" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.rif" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="nombre" value="Nombre" />
        <TextInput id="nombre" v-model="form.nombre" type="text" autocomplete="nombre" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.nombre" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="nombre_responsable" value="Nombre del responsable" />
        <TextInput id="nombre_responsable" v-model="form.nombre_responsable" type="text" autocomplete="nombre_responsable" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.nombre_responsable" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="cedula_responsable" value="Cedula del responsable" />
        <TextInput id="cedula_responsable" v-model="form.cedula_responsable" type="number" autocomplete="cedula_responsable" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.cedula_responsable" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="telefono_responsable" value="Telefono del responsable" />
        <TextInput id="telefono_responsable" v-model="form.telefono_responsable" type="number" autocomplete="telefono_responsable" class="mt-1 block w-full" />
        <InputError :message="$page.props.errors.telefono_responsable" class="mt-2" />
      </div>
    </template>
    <template #actions>
      <PrimaryButton>
        {{ updating ? 'Actualizar' : 'Registrar' }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>