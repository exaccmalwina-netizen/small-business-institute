import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const blogCollection = defineCollection({
  loader: glob({ pattern: "*.md", base: "./src/content/blog" }),
  schema: z.object({
    title: z.string(),
    excerpt: z.string(),
    category: z.string(),
    categoryName: z.string(),
    date: z.date(),
    image: z.string().optional(),
    author: z.string().default('SBI Editorial Team'),
  }),
});

export const collections = {
  'blog': blogCollection,
};
