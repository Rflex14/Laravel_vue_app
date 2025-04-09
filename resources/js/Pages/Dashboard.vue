<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Exportar Hojas de calculo de Excel
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                      ¿Que formato desea exportar?
                    </div>
                    <div class="w-full p-6">
                      <Link :href="route('excel.almacenes')" :active="route().current('excel.*')" class="p-6 rounded border border-solid border-black">Primer link</Link>
                    </div>
                    <div class="w-full p-6">
                      <Link :href="route('excel.epidemiologico')" :active="route().current('excel.*')" class="p-6 rounded border border-solid border-black">Segundo link</Link>
                    </div>
                    <div class="w-full p-6">
                      <Link :href="route('excel.vegetal')" :active="route().current('excel.*')" class="p-6 rounded border border-solid border-black">Tercer link</Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
