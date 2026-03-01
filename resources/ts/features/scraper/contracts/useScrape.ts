// 📄 features/scraper/contracts/useScrape.contract.ts

import type { Ref } from 'vue'
import type { ScrapeResponse } from '@/ts/features/scraper/services/contracts/scrapeResponse'

export interface UseScrape {
  readonly keyword: Ref<string>
  readonly results: Ref<ScrapeResponse | null>
  readonly errorMessage: Ref<string | null>
  readonly search: () => Promise<void>
  readonly downloadJson: () => void
}