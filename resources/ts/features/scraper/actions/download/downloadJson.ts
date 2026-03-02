// 📄 features/scraper/actions/download/downloadJson.ts

import type { Ref } from 'vue'
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse'

export const createDownloadAction = (
  keyword: Ref<string>,
  results: Ref<ScrapeResponse | null>
) => {
  return (): void => {
    if (!results.value) return

    const blob = new Blob(
      [JSON.stringify(results.value, null, 2)],
      { type: 'application/json' }
    )

    const url = URL.createObjectURL(blob)

    const anchor = document.createElement('a')
    anchor.href = url
    anchor.download = `results-${keyword.value.trim()}.json`

    document.body.appendChild(anchor)
    anchor.click()
    document.body.removeChild(anchor)

    URL.revokeObjectURL(url)
  }
}