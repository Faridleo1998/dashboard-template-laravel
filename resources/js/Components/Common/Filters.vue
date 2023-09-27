<script setup>
import { ref } from 'vue'
import Button from '../Buttons/Button.vue'
import Input from '../Forms/Input.vue'
import Select from '../Forms/Select.vue'

defineProps({
  isSearch: {
    type: Boolean,
    required: true
  },
  placeholderSearch: {
    type: String,
    required: true
  },
  filters: {
    type: Object,
    required: true
  },
  filterOptions: {
    type: Array,
    required: true
  },
  currentRoute: {
    type: String,
    required: true
  }
})

const isOpenFilters = ref(false)

const emit = defineEmits(['updateQueriesParams', 'clearFilters'])

const handleClearFilters = () => {
  isOpenFilters.value = false
  emit('clearFilters')
}
</script>

<template>
  <div
    v-show="isOpenFilters === true"
    class="absolute h-screen bg-transparent w-full top-0 left-0 z-9"
    @click="isOpenFilters = false"
  ></div>
  <div class="flex gap-4 justify-between relative items-end">
    <div v-if="isSearch">
      <Input
        id="search"
        :placeholder="placeholderSearch"
        :is-search="true"
        :value="filters['filter[global]']"
        class="md:min-w-[200px]"
        @input="emit('updateQueriesParams', 'filter[global]', $event.target.value)"
      />
    </div>
    <template v-if="filterOptions.length > 0">
      <div>
        <Button
          :icon="isOpenFilters ? 'x' : 'filter'"
          :is-only-icon="true"
          class="lg:hidden"
          @click="isOpenFilters = !isOpenFilters"
        />
        <div
          class="absolute lg:relative right-0 top-14 lg:top-0 duration-500 bg-white dark:bg-black lg:dark:bg-boxdark rounded-lg border-[1.5px] border-stroke lg:border-none dark:border-strokedark p-4 lg:p-0 w-full sm:max-w-[700px] sm:w-auto z-10 lg:translate-x-0 lg:flex lg:items-end lg:gap-4"
          :class="isOpenFilters ? 'translate-x-0' : 'translate-x-[200%]'"
        >
          <div class="flex flex-col flex-wrap sm:flex-row gap-4">
            <template v-for="filter in filterOptions" :key="filter">
              <Select
                v-if="filter.type === 'select'"
                :id="filter.keyValue"
                :label="filter.label"
                :options="filter.options"
                class="min-w-[180px] flex-1"
                placeholder="Todo"
                :value="filters[`filter[${filter.keyValue}]`]"
                @change="
                  emit('updateQueriesParams', `filter[${filter.keyValue}]`, $event.target.value)
                "
              />

              <Input
                v-else
                :id="filter.keyValue"
                :label="filter.label"
                :type="filter.type"
                :value="filter[`filter[${filter.keyValue}]`]"
                class="min-w-[180px] flex-1"
                @input="
                  emit('updateQueriesParams', `filter[${filter.keyValue}]`, $event.target.value)
                "
              />
            </template>
          </div>
          <div class="mt-4 flex justify-end">
            <Button
              type="danger"
              icon="filter-x"
              class="lg:hidden"
              title="Limpiar filtros"
              @click="handleClearFilters"
              >Limpiar filtros</Button
            >
            <Button
              type="danger"
              icon="filter-x"
              class="hidden lg:block"
              :is-only-icon="true"
              title="Limpiar filtros"
              @click="handleClearFilters"
            />
          </div>
        </div>
      </div>
    </template>
  </div>
</template>
