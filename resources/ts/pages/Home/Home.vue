<!-- 📄 pages/Home/Home.vue -->

<template>
    <h1 class="text-2xl">
      Search Results
    </h1>

    <form @submit.prevent="search" class="mt-4">
      <div
        v-if="errorMessage"
        class="text-red-500 text-md text-center"
      >
        {{ errorMessage }}
      </div>
      <div class="flex mt-4">
        <input
          v-model="keyword"
          placeholder="Search..."
          class="border border-r-0 border-solid border-gray-500 rounded-l-lg px-3 py-1 focus:ring-1 focus:ring-blue-600 outline-0"
        />
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 rounded-r-lg px-3 py-1 transition-linear duration-500 focus:ring-1 focus:ring-blue-600 cursor-pointer"
        >
          Search
        </button>
      </div>
    </form>

    <div
      v-if="results"
      class="flex gap-2 mt-8"
    >
      <button
        @click="downloadJson"
        class="bg-green-600 hover:bg-green-700 rounded-lg px-3 py-1 transition-linear duration-500 focus:ring-1 focus:ring-green-600 cursor-pointer"
      >
        Download JSON
      </button>
      <button
        @click="downloadXml"
        class="bg-orange-600 hover:bg-orange-700 rounded-lg px-3 py-1 transition duration-500 focus:ring-1 focus:ring-purple-600 cursor-pointer"
      >
        Download XML
      </button>
    </div>
</template>

<script setup lang="ts">
import { useScrape } from '@/ts/features/scraper'

const {
  keyword,
  results,
  errorMessage,
  search,
  downloadJson,
  downloadXml
} = useScrape()
</script>