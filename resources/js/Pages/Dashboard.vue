<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Excel">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Excel
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <div class="w-full mt-6 text-center font-bold text-md uppercase tracking-widest">Exportaciones</div>
                    <div class="w-full flex">
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('excel.almacenes')" :active="route().current('excel.*')" class="w-full text-center p-4 text-black">Formato Data de Almacenes</Link>
                        </button>
                      </div>
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('excel.epidemiologico')" :active="route().current('excel.*')" class="w-full text-center p-4 text-black">Formato Data Epidemiológica</Link>
                        </button>
                      </div>
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('excel.vegetal')" :active="route().current('excel.*')" class="w-full p-4 text-black text-center">Formato Protección Vegetal</Link>
                        </button>
                      </div>
                    </div>
                </div>
              <div class="mt-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <div class="w-full mt-6 text-center font-bold text-md uppercase tracking-widest">Respaldos</div>
                    <div class="w-full flex">
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('respaldo.formatoAlmacenes')" :active="route().current('respaldo.*')" class="w-full text-center p-4 text-black">Formato Data de Almacenes</Link>
                        </button>
                      </div>
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('respaldo.formatoEpidemiologico')" :active="route().current('respaldo.*')" class="w-full text-center p-4 text-black">Formato Data Epidemiológica</Link>
                        </button>
                      </div>
                      <div class="w-full p-6">
                        <button :type="button" class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"> 
                          <Link :href="route('respaldo.formatoVegetal')" :active="route().current('respaldo.*')" class="w-full p-4 text-black text-center">Formato Protección Vegetal</Link>
                        </button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </AppLayout>
</template>
