import keywordExtractor from 'keyword-extractor';

/**
 * Extracts the top N most important semantic keywords from HTML content.
 * 
 * @param {string} html Raw content of the post
 * @param {number} count Number of tags to extract (default 3)
 * @returns {string[]} Array of tags
 */
export function extractKeywords(html, count = 3) {
    if (!html) return [];
    
    // Strip HTML tags and entities to get raw readable text
    let text = html.replace(/<[^>]*>?/gm, ' ').replace(/&[a-z]+;/g, ' ');

    // Extract true keywords using semantic analysis (ignores all grammar/stop words)
    const rawKeywords = keywordExtractor.extract(text, {
        language: "english",
        remove_digits: true,
        return_changed_case: true,
        remove_duplicates: false // keep duplicates so we can count frequencies
    });

    // Count frequencies of the meaningful keywords
    const frequency = {};
    rawKeywords.forEach(word => {
        // Skip tiny words that might have bypassed the extractor
        if (word.length > 3) {
            frequency[word] = (frequency[word] || 0) + 1;
        }
    });

    // Sort by most frequent and return array of words
    const sortedWords = Object.entries(frequency)
        .sort((a, b) => b[1] - a[1]) // Sort by count
        .map(entry => entry[0]);

    return sortedWords.slice(0, count);
}
