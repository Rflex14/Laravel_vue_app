
<script>
 export default {
   name: 'SeleccionPropietario'
 }
</script>

<script setup>
import { ref, onBeforeMount } from 'vue';
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

const propietario = ref("Persona");
const persona = ref(false);

const props = defineProps({
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
  }
})

function cambio() {
  if (propietario.value === "Persona") {
    propietario.value = "Empresa";
    persona.value = true;
    props.form.empresa_id = "";
  } else {
    propietario.value = "Persona";
    persona.value = false;
    props.form.persona_id = "";
  }
  console.log(propietario.value);
}

onBeforeMount(() => {
  if(!props.form.empresa_id) {
    cambio();
  }
})

</script>

<template>
  <div>Propietario:</div>
  <SecondaryButton @click="cambio">Ingresar {{ propietario }}</SecondaryButton>
  <div v-if="persona" class="col-span-6 sm:col-span-6">
    <InputLabel for="persona_id" value="Persona propietaria" />
    <select name="persona_id" id="persona_id" v-model="form.persona_id">
      <option value="">Seleccione</option>
      <option v-for="persona in personas" :value="persona.id">{{ persona.cedula }}</option>
      <InputError :message="$page.props.errors.persona_id" class="mt-2" />
    </select>
  </div>
  <div v-else class="col-span-6 sm:col-span-6">
    <InputLabel for="empresa_id" value="Empresa propietaria" />
    <select name="empresa_id" id="empresa_id" v-model="form.empresa_id">
      <option value="">Seleccione</option>
      <option v-for="empresa in empresas" :value="empresa.id">{{ empresa.rif }}</option>
      <InputError :message="$page.props.errors.empresa_id" class="mt-2" />
    </select>
  </div>
</template>