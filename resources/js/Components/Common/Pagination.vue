<script setup>
import Select from '../Forms/Select.vue'

const props = defineProps({
  links: {
    type: Array,
    default: () => []
  },
  lastPage: {
    type: Number,
    required: true
  },
  currentPage: {
    type: Number,
    required: true
  },
  perPage: {
    type: String,
    default: ''
  }
})

const perPageOptions = {
  5: '5',
  15: '15',
  25: '25'
}

const emit = defineEmits(['updateQueriesParams'])

const handleClickPage = (page) => {
  if (!page.includes('Previous') && !page.includes('Next')) {
    return emit('updateQueriesParams', 'page', parseInt(page))
  }

  if (page.includes('Previous')) {
    return emit(
      'updateQueriesParams',
      'page',
      props.currentPage - 1 >= 1 ? props.currentPage - 1 : 1
    )
  }

  emit(
    'updateQueriesParams',
    'page',
    props.currentPage + 1 <= props.lastPage ? props.currentPage + 1 : props.currentPage
  )
}
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-col flex-wrap justify-end md:flex-row md:justify-end gap-8 items-center">
      <div class="flex gap-4 items-center justify-between sm:justify-start">
        <p>Resultados por página</p>
        <Select
          id="perPage"
          :options="perPageOptions"
          class="min-w-[80px]"
          :value="perPage.toString()"
          @change="emit('updateQueriesParams', 'perPage', $event.target.value)"
        />
      </div>

      <div class="flex flex-wrap items-center gap-1 justify-center">
        <template v-for="(link, i) in links" :key="i">
          <template v-if="!link.label.includes('Next') && !link.label.includes('Previous')">
            <a
              class="flex w-9 items-center justify-center rounded py-1.5 px-3 font-medium hover:bg-primary hover:text-white cursor-pointer"
              :class="link.active && 'bg-primary text-white'"
              @click="handleClickPage(link.label)"
            >
              <p class="-mb-1">{{ link.label }}</p>
            </a>
          </template>
          <template v-else>
            <a
              class="flex h-8 w-9 items-center justify-center rounded hover:bg-primary hover:text-white cursor-pointer"
              @click="handleClickPage(link.label)"
            >
              <i
                class="ti"
                :class="link.label.includes('Next') ? 'ti-chevron-right' : 'ti-chevron-left'"
              ></i>
            </a>
          </template>
        </template>
      </div>
    </div>
  </div>
</template>
