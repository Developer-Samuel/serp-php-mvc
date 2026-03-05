// 📄 features/scraper/contracts/apiErrorResponse.ts

export interface ApiErrorResponse {
  readonly response?: {
    readonly data?: {
      readonly error?: string;
    };
  };
}
