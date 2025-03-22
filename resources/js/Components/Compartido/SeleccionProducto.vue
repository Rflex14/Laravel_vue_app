<script>
  export default {
    name: 'SeleccionProducto'
  }
</script>

<script setup>
import { ref } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'

defineProps ({
  productos: {
    type: Array,
    required: true
  }
})

const selection = ref([]);
const currentSelection = ref(1);

const emit = defineEmits(['onProductos']);

const agregarSelection = () => {

  let yaExiste = false;
  selection.value.forEach(producto => {
    if(producto.id == currentSelection.value.id) {
      yaExiste = true;
      return;
    }
  });
  if(yaExiste) {
    return;
  }
  selection.value.push(currentSelection.value);
  emit('onProductos', selection.value);
};
const quitarSelection = (id) => {
  selection.value = selection.value.filter(producto => producto.id !== id);
  emit('onProductos', selection.value);
}

</script>
  
<template>
  <InputLabel class="col-span-6" for="productos" value="Productos"/>
  <select id="productos" v-model="currentSelection">
    <option v-for="(producto, index) in productos" :key="index" :value="producto">{{ producto?.nombre }}</option>
  </select>
  <SecondaryButton @click="agregarSelection">Agregar</SecondaryButton>
  <div class="col-span-6">
    <ul>
      <li v-for="(producto, index) in selection" :key="index">{{ producto.nombre }} <span @click="quitarSelection(producto.id)">Eliminar</span>
      </li>
    </ul>
  </div>
</template>