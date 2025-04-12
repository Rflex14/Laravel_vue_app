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
  <div class="w-full col-span-3">
    <InputLabel class="col-span-6" value="Productos"/>
    <div class="flex">
      <select id="productos" v-model="currentSelection" class="w-full">
        <option v-for="(producto, index) in productos" :key="index" :value="producto">{{ producto?.nombre }}</option>
      </select>
      <button type="button" @click="agregarSelection" class="text-white bg-indigo-500 hover:bg-indigo-700 hover:text-white py-2 px-4 rounded ml-1">Agregar</button>
    </div>
    <div>
      <ul>
        <li v-for="(producto, index) in selection" :key="index" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded mt-1 mb-1">
          {{ producto.nombre }} <span @click="quitarSelection(producto.id)" class="float-end cursor-pointer">X</span>
        </li>
      </ul>
    </div>
  </div>
</template>