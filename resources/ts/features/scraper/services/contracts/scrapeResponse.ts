// 📄 features/scraper/services/contracts/scrapeResponse.ts

import type { ScrapeItem } from '@/ts/features/scraper/services/contracts/scrapeItem'

export interface ScrapeResponse {
  readonly items: ReadonlyArray<ScrapeItem>
  readonly total: number
}