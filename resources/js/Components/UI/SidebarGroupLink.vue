<script setup>
import { onMounted } from 'vue'
import NavLink from './NavLink.vue'
import { ref, watch } from 'vue'

const props = defineProps({
  url: {
    type: Object,
    required: true
  },
  routeLinkActive: {
    type: String,
    default: ''
  }
})

const isOpen = ref(false)

const emit = defineEmits(['handleRouteLinkActive', 'handleSetSidebarOpen'])

watch(
  () => props.routeLinkActive,
  () => {
    if (
      props.url.children.some((child) => child.route.includes(props.routeLinkActive.split('.')[0]))
    ) {
      isOpen.value = true
    } else {
      isOpen.value = false
    }
  }
)

onMounted(() => {
  emit('handleRouteLinkActive', route().current())
})
</script>

<template>
  <div
    class="group relative flex items-center justify-between gap-2.5 rounded-sm py-2 lg:py-3 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 cursor-pointer"
    @click="isOpen = !isOpen"
  >
    <div class="flex items-center gap-2.5">
      <i v-if="url.icon" :class="`ti ti-${url.icon}`"></i>
      {{ url.name }}
    </div>
    <i class="ti ti-chevron-down duration-300" :class="isOpen ? 'rotate-0' : 'rotate-180'"></i>
  </div>
  <div class="overflow-hidden" :class="!isOpen && 'hidden'">
    <ul class="mt-4 flex flex-col gap-2.5 pl-6">
      <li v-for="(routeChildren, index) in url.children" :key="index">
        <NavLink
          :url="routeChildren"
          @click="
            () => {
              emit('handleRouteLinkActive', routeChildren.route)
              emit('handleSetSidebarOpen', false)
            }
          "
        />
      </li>
    </ul>
  </div>
</template>
