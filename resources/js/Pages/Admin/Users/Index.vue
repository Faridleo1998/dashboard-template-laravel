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
  }
})

const columns = [
  {
    name: 'Identificación',
    keyValue: 'identification_number',
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
      :route-actions="routeActions"
      :data="users"
      message="No hay usuarios creados"
    />
  </Card>
</template>
