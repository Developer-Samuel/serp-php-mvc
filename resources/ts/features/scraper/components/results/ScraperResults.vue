<!-- 📄 features/scraper/components/results/ScraperResults.vue -->

<template>
  <div v-if="results" class="flex flex-col sm:flex-row gap-2 w-full mt-8">
    <Button
      @click="downloadJson"
      class="w-full bg-green-600 hover:bg-green-700 rounded-lg focus:ring-green-600"
    >
      Download JSON
    </Button>

    <Button
      @click="downloadXml"
      class="w-full bg-orange-600 hover:bg-orange-700 rounded-lg focus:ring-purple-600"
    >
      Download XML
    </Button>
  </div>
</template>

<script setup lang="ts">
import Button from '@/ts/features/scraper/components/form/actions/Button.vue'

defineProps<{
  results: unknown
  downloadJson: () => void
  downloadXml: () => void
}>()
</script>