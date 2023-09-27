<script setup>
import ButtonAction from '../Buttons/ButtonAction.vue'
import Filters from './Filters.vue'
import NoDataMessage from './NoDataMessage.vue'
import Pagination from './Pagination.vue'
import Status from './Status.vue'
import { router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { throttledWatch } from '@vueuse/core'

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
  isSearch: {
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
  },
  filterOptions: {
    type: Array,
    default: () => []
  },
  currentRoute: {
    type: String,
    required: true
  }
})

const queriesParams = ref(props.filters)

const gridCols = computed(() => {
  return `grid-template-columns: ${props.checks ? '80px' : ''} repeat(${
    props.columns.length
  }, minmax(${props.minWidthColumn}, 1fr))`
})

const updateQueriesParams = (field, value) => {
  queriesParams.value[field] = value
  if (field !== 'page') {
    queriesParams.value['page'] = 1
  }
}

const clearFilters = () => {
  router.get(props.currentRoute)
}
throttledWatch(
  queriesParams.value,
  () => {
    router.get(`${props.currentRoute}`, queriesParams.value, {
      preserveState: true,
      replace: true
    })
  },
  { throttle: 400 }
)

const sort = (fieldName) => {
  if (fieldName === queriesParams.value.sort || `-${fieldName}` === queriesParams.value.sort) {
    queriesParams.value.direction = queriesParams.value.direction === 'asc' ? 'desc' : 'asc'
  } else {
    queriesParams.value.direction = 'asc'
  }
  queriesParams.value.sort = queriesParams.value.direction === 'asc' ? fieldName : `-${fieldName}`
}
</script>

<template>
  <div v-if="isSearch || filterOptions.length !== 0" class="mb-4 lg:mb-8">
    <Filters
      :is-search="isSearch"
      :placeholder-search="placeholderSearch"
      :filter-options="filterOptions"
      :current-route="currentRoute"
      :filters="filters"
      @update-queries-params="updateQueriesParams"
      @clear-filters="clearFilters"
    />
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
            <div
              v-if="head.sort"
              class="flex gap-8 cursor-pointer h-full items-center"
              @click="sort(head.keyValue)"
            >
              {{ head.name }}
              <span
                v-show="
                  !filters.direction ||
                  (filters.sort !== head.keyValue && filters.sort !== `-${head.keyValue}`)
                "
                class="-scale-x-100"
              >
                <i class="ti ti-menu-deep"></i>
              </span>
              <span v-show="filters.direction === 'asc' && filters.sort === head.keyValue">
                <i class="ti ti-sort-ascending"></i>
              </span>
              <span v-show="filters.direction === 'desc' && filters.sort === `-${head.keyValue}`">
                <i class="ti ti-sort-descending"></i>
              </span>
            </div>
            <div v-else class="items-center flex h-full">
              {{ head.name }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody v-if="data.data.length !== 0" class="grid auto-rows-fr">
        <tr
          v-for="(item, i) in data.data"
          :key="i"
          class="hover:bg-gray-2 dark:hover:bg-meta-4 duration-150 border-b border-[#eee] dark:border-[#eeeeee34] last:border-none grid items-center"
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
                  icon="pencil"
                  @click.stop="() => router.get(route(routeActions.edit, item.id))"
                />
                <ButtonAction
                  v-if="routeActions.delete !== ''"
                  title="Eliminar"
                  icon="trash"
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
  <Pagination
    v-if="data.data.length !== 0"
    :links="data.links"
    :last-page="data.last_page"
    :current-page="data.current_page"
    :per-page="filters.perPage"
    :filters="filters"
    class="mt-6"
    @update-queries-params="updateQueriesParams"
  />
</template>
