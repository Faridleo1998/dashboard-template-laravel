<script setup>
import { watch } from 'vue'
import ButtonAction from '../Buttons/ButtonAction.vue'
import Input from '../Forms/Input.vue'
import NoDataMessage from './NoDataMessage.vue'
import Status from './Status.vue'
import SvgIcon from './SvgIcon.vue'
import { router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const props = defineProps({
  columns: {
    type: Array,
    required: true
  },
  data: {
    type: Object,
    required: true
  },
  message: {
    type: String,
    default: ''
  },
  routeActions: {
    type: Object,
    default: () => {}
  },
  minWidthColumn: {
    type: String,
    default: '180px'
  },
  checks: {
    type: Boolean,
    default: false
  },
  search: {
    type: Boolean,
    default: true
  },
  placeholderSearch: {
    type: String,
    default: 'Buscar...'
  },
  filters: {
    type: Object,
    default: () => {}
  }
})

const searchText = ref(props.filters.search)

const gridCols = computed(() => {
  return `grid-template-columns: ${props.checks ? '80px' : ''} repeat(${
    props.columns.length
  }, minmax(${props.minWidthColumn}, 1fr))`
})

watch(searchText, (value) => {
  router.get(
    'payment_methods',
    { search: value },
    {
      preserveState: true,
      replace: true
    }
  )
})
</script>

<template>
  <div v-if="search" class="mb-8 md:max-w-70">
    <Input id="search" v-model="searchText" :placeholder="placeholderSearch" :is-search="true" />
  </div>
  <div class="max-w-full overflow-x-auto">
    <table class="w-full table-auto">
      <thead>
        <tr class="bg-gray-2 text-left dark:bg-meta-4 grid" :style="gridCols">
          <th v-if="checks" class="grid place-content-center">
            <input id="checkAll" type="checkbox" name="" />
          </th>
          <th
            v-for="(head, i) in columns"
            :key="i"
            class="py-5 px-4 font-medium text-black dark:text-white break-words xl:pl-10"
          >
            <div class="flex gap-8">
              {{ head.name }}
              <span v-if="head.sort" class="cursor-pointer" @click="sort(head.keyValue)">
                <SvgIcon name="Sort" />
              </span>
            </div>
          </th>
        </tr>
      </thead>
      <tbody v-if="data.data.length !== 0">
        <tr
          v-for="(item, i) in data.data"
          :key="i"
          class="hover:bg-gray-2 dark:hover:bg-meta-4 duration-150 border-b border-[#eee] dark:border-[#eeeeee34] last:border-none grid"
          :style="gridCols"
        >
          <td v-if="checks" class="grid place-content-center">
            <input :id="item.id" type="checkbox" name="" />
          </td>
          <td
            v-for="(key, index) in columns"
            :key="index"
            class="py-5 px-4 dark:border-strokedark break-words xl:pl-10"
            :class="routeActions.edit.length !== 0 && 'cursor-pointer'"
            @click="
              () => {
                routeActions.edit.length !== 0 && router.get(route(routeActions.edit, item.id))
              }
            "
          >
            <template v-if="key.type === 'status'">
              <Status
                v-if="key.hasOwnProperty('alternativeOptions') && key.alternativeOptions === true"
                :status="item[key.keyValue]"
                :alternative-options="true"
              />
              <Status v-else :status="item[key.keyValue]" />
            </template>

            <template v-if="key.type === 'actions' && Object.keys(routeActions).length !== 0">
              <div class="flex gap-4">
                <ButtonAction
                  v-if="routeActions.edit !== ''"
                  title="Editar"
                  icon="Edit"
                  @click.stop="() => router.get(route(routeActions.edit, item.id))"
                />
                <ButtonAction
                  v-if="routeActions.delete !== ''"
                  title="Eliminar"
                  icon="Trash"
                  @click.stop="
                    () => {
                      router.delete(route(routeActions.delete, item.id))
                    }
                  "
                />
              </div>
            </template>

            <template v-if="key.type === 'default'">
              <div class="relative">
                {{ item[key.keyValue] }}
              </div>
            </template>
          </td>
        </tr>
      </tbody>
      <div v-else>
        <NoDataMessage :message="message" />
      </div>
    </table>
  </div>
</template>