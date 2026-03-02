// 📄 features/scraper/contracts/scrapeItem.ts

export interface ScrapeItem {
  readonly title: string
  readonly url: string
  readonly description?: string
}
