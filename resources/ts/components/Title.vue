<!-- 📄 components/Title.vue -->

<template>
  <component :is="tag" :class="className">
    <slot />
  </component>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
  tag?: 'h1' | 'h2' | 'h3';
  class?: string;
}>();

const tag = computed(() => props.tag ?? 'h1');

const className = computed(() => {
  return props.class ?? 'text-2xl font-semibold';
});
</script>
