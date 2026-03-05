// 📄 features/scraper/components/form/actions/contract/button.ts

import type { ButtonType } from '@/ts/features/scraper/components/form/actions/types/button.type';

export interface Button {
  type?: ButtonType;
  body?: string | null;
  class?: string | null;
}
