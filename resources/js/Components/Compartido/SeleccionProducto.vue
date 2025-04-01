<script>
  export default {
    name: 'SeleccionProducto'
  }
</script>

<script setup>
import { onBeforeMount, toRef } from 'vue';
import { ref } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'

const props = defineProps ({
  productos: {
    type: Array,
    required: true
  },
  seleccionados: {
    type: Array,
    required: true
  }
})

const ids = ref([]);
const currentSelection = ref(null);
const selection = ref(props.seleccionados)

onBeforeMount(() => {
  if (selection.value != []) {
  selection.value.forEach(elemento => {
    ids.value.push(elemento.id);
  });
}
})

const emit = defineEmits(['onProductos']);

const agregarSelection = () => {
  
  if (currentSelection.value !== null) {
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
    ids.value.push(currentSelection.value.id);
    selection.value.push(currentSelection.value);
    emit('onProductos', ids.value);
  }
};
const quitarSelection = (id) => {
  selection.value = selection.value.filter(producto => producto.id !== id);
  ids.value = ids.value.filter(numero => numero !== id);
  emit('onProductos', ids.value);
}

</script>
  
<template>
  <div>
    <InputLabel class="col-span-6" value="Productos"/>
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
  </div>
</template>