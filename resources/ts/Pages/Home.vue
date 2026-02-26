<!-- 📄 Pages/Home.vue -->

<template>
  <div>
    <h1>Search Results</h1>

    <input
      v-model="keyword"
      placeholder="Search..."
    />

    <button @click="search">
      Search
    </button>

    <button
      v-if="results"
      @click="download"
    >
      Download JSON
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const keyword = ref('')
const results = ref(null)

const search = async () => {
  const response = await axios.post('/scrape', {
    keyword: keyword.value
  })

  results.value = response.data
}

const download = () => {
  const blob = new Blob(
    [JSON.stringify(results.value, null, 2)],
    { type: 'application/json' }
  )

  const url = URL.createObjectURL(blob)
  const a = document.createElement('a')
  a.href = url
  a.download = 'results.json'
  a.click()
}
</script>