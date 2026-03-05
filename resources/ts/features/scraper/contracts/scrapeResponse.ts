// 📄 features/scraper/contracts/scrapeResponse.ts

import type { ScrapeItem } from '@/ts/features/scraper/contracts/scrapeItem';

export interface ScrapeResponse {
  readonly items: ReadonlyArray<ScrapeItem>;
  readonly total: number;
}
