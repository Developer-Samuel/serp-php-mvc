// config/resolvePage.ts

import type { DefineComponent } from 'vue'

const pages = import.meta.glob([
  '../Pages/**/*.vue',
  '../Errors/**/*.vue'
])

export async function resolvePage(name: string): Promise<DefineComponent> {
  const path = Object.keys(pages).find((path) =>
    path.endsWith(`${name}.vue`)
  )

  if (!path) {
    throw new Error(`Page not found: ${name}`)
  }

  const module = await pages[path]() as { default: DefineComponent }

  return module.default
}