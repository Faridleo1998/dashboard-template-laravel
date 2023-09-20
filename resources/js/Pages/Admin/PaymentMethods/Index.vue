<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Table from '@/Components/Common/Table.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head } from '@inertiajs/vue3'

defineOptions({
  layout: AuthenticatedLayout
})

defineProps({
  paymentMethods: {
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
    keyValue: 'title',
    type: 'default'
  },
  {
    name: 'Estado',
    keyValue: 'status',
    type: 'status'
  },
  {
    name: 'Acciones',
    type: 'actions'
  }
]

const currentRoute = route().current().split('.')[0]

const routeActions = {
  edit: 'payment_methods.edit',
  delete: 'payment_methods.destroy'
}
</script>

<template>
  <Head title="Medios de Pago" />
  <TitlePage title="Medios de Pago">
    <Button icon="AddRound" :href="route('payment_methods.create')"> Crear </Button>
  </TitlePage>

  <Card>
    <Table
      :columns="columns"
      :data="paymentMethods"
      :route-actions="routeActions"
      :filters="filters"
      :current-route="currentRoute"
      placeholder-search="Nombre"
      message="No se encontraron medios de pago"
    />
  </Card>
</template>
