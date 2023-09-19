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
  users: {
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
    name: 'Identificación',
    keyValue: 'identification_number',
    type: 'default'
  },
  {
    name: 'Nombre completo',
    keyValue: 'full_name',
    type: 'default'
  },
  {
    name: 'Correo electrónico',
    keyValue: 'email',
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

const routeActions = {
  edit: 'users.edit',
  delete: 'users.delete'
}
</script>

<template>
  <Head title="Usuarios" />
  <TitlePage title="Usuarios">
    <Button icon="AddRound" :href="route('users.create')"> Crear </Button>
  </TitlePage>

  <Card>
    <Table
      :columns="columns"
      :data="users"
      :route-actions="routeActions"
      :filters="filters"
      placeholder-search="Número de identificación"
      message="No se encontraron usuarios"
    />
  </Card>
</template>
