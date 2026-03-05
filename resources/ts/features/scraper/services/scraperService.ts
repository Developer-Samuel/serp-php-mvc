// 📄 features/scraper/services/scraperService.ts

import axios, { type AxiosResponse } from 'axios';

import type { ScrapeRequest } from '@/ts/features/scraper/contracts/scrapeRequest';
import type { ScrapeResponse } from '@/ts/features/scraper/contracts/scrapeResponse';

export const scraperService = {
  async scrape(payload: ScrapeRequest): Promise<ScrapeResponse> {
    const response: AxiosResponse<ScrapeResponse> = await axios.post('/scrape', payload);

    return response.data;
  },
};
