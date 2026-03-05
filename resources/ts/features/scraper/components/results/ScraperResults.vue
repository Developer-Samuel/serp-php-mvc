<!-- 📄 features/scraper/components/results/ScraperResults.vue -->

<template>
  <div v-if="results" class="flex flex-col sm:flex-row gap-2 w-full mt-8">
    <Button class="w-full bg-green-600 hover:bg-green-700 rounded-lg focus:ring-green-600" @click="downloadJson">
      Download JSON
    </Button>

    <Button class="w-full bg-orange-600 hover:bg-orange-700 rounded-lg focus:ring-purple-600" @click="downloadXml">
      Download XML
    </Button>
  </div>
</template>

<script setup lang="ts">
import Button from '@/ts/components/actions/Button.vue';

defineProps<{
  results: unknown;
  downloadJson: () => void;
  downloadXml: () => void;
}>();
</script>
