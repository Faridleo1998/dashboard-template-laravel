<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Common/Card.vue'
import Table from '@/Components/Common/Table.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head } from '@inertiajs/vue3'

defineOptions({
  layout: AuthenticatedLayout
})

const props = defineProps({
  permissions: {
    type: Object,
    required: true
  },
  filters: {
    type: Object,
    default: () => {}
  }
})

const columns = [
  {
    name: 'Nombre',
    keyValue: 'description',
    type: 'default',
    sort: true
  },
  {
    name: 'Módulo',
    keyValue: 'module',
    type: 'default',
    sort: true
  }
]

const filtersParsed = {
  direction: props.filters.direction || '',
  sort: props.filters.sort || '',
  'filter[global]': props.filters.filter.global || '',
  page: props.filters.page || 1,
  perPage: props.filters.perPage || 15,
  'filter[module]': props.filters?.filter.module || ''
}

const filterOptions = [
  {
    label: 'Módulo',
    keyValue: 'module',
    type: 'select',
    options: {
      Usuarios: 'Usuarios',
      'Medios de pago': 'Medios de pago'
    }
  }
]

const currentRoute = route().current().split('.')[0]
</script>

<template>
  <Head title="Permisos" />
  <TitlePage title="Permisos" />

  <Card>
    <Table
      :columns="columns"
      :current-route="currentRoute"
      :data="permissions"
      :filter-options="filterOptions"
      :filters="filtersParsed"
      message="No se encontraron permisos"
      placeholder-search="Nombre"
    />
  </Card>
</template>
