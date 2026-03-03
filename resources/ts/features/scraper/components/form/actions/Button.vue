<!-- 📄 features/scraper/components/form/actions/Button.vue -->

<template>
  <button
    :type="type ?? 'button'"
    :class="[baseClass, className]"
  >
    <slot>
      {{ body }}
    </slot>
  </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
  type?: HTMLButtonElement['type']
  body?: string | null
  class?: string | null
}>()

const baseClass =
  'px-3 py-1 transition-linear duration-500 focus:ring-1 focus:ring-blue-600 cursor-pointer'

const className = computed(() => props.class ?? '')
</script>