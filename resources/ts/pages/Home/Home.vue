<!-- 📄 pages/Home/Home.vue -->

<template>
  <Title>
    Search Results
  </Title>

  <div class="sm:w-[350px] w-full px-4">
    <ScraperForm
      v-model="keyword"
      :error-message="errorMessage"
      :search="search"
    />

    <ScraperResults
      :results="results"
      :download-json="downloadJson"
      :download-xml="downloadXml"
    />
  </div>
</template>

<script setup lang="ts">
import { useScrape } from '@/ts/features/scraper'
import Title from '@/ts/components/Title.vue'
import ScraperForm from '@/ts/features/scraper/components/form/ScraperForm.vue'
import ScraperResults from '@/ts/features/scraper/components/results/ScraperResults.vue'

const {
  keyword,
  results,
  errorMessage,
  search,
  downloadJson,
  downloadXml
} = useScrape()
</script>