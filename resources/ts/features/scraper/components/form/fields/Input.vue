<!-- 📄 features/scraper/components/form/fields/Input.vue -->

<template>
  <input
    v-model="model"
    :class="[
      baseClass,
      className
    ]"
    :placeholder="placeholder"
  />
</template>

<script setup lang="ts">
import { computed } from 'vue'

const model = defineModel<string>({
  required: true
})

const props = defineProps<{
  class?: string,
  placeholder?: string
}>()

const baseClass = 'border border-r-0 border-solid border-gray-500 rounded-l-lg w-full px-3 py-1 focus:ring-1 focus:ring-blue-600 outline-0'

const className = computed(() => props.class ?? '')
</script>