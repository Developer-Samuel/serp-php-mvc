// 📄 features/scraper/index.ts

import type { UseScrape } from '@/ts/features/scraper/contracts/useScrape';
import { useScrapeState } from '@/ts/features/scraper/state/useScrapeState';
import { useScrapeActions } from '@/ts/features/scraper/actions/index';

export const useScrape = (): UseScrape => {
  const state = useScrapeState();
  const actions = useScrapeActions(state.keyword, state.results, state.errorMessage);

  return {
    ...state,
    ...actions,
  };
};
