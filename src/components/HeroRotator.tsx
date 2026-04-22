import { TextRotate } from "./ui/text-rotate"

const words = [
  "stronger 💪",
  "smarter 🧠",
  "resilient 🛡️",
  "connected 🤝",
  "confident ✨",
  "profitable 💰",
  "informed 📚",
  "unstoppable 🚀",
  "heard 📣",
  "thriving 🌱",
  "funky 🪩",
]

/**
 * HeroRotator — replaces the vanilla JS text rotator in Hero.astro.
 * Uses motion/react AnimatePresence for bulletproof animations.
 * Rendered client-side only (client:load in Hero.astro).
 */
export function HeroRotator() {
  return (
    <span className="hero-rotator-wrapper">
      <TextRotate
        texts={words}
        rotationInterval={3000}
        splitBy="words"
        initial={{ y: "0%", opacity: 0 }}
        animate={{ y: "0%", opacity: 1 }}
        exit={{ y: "0%", opacity: 0 }}
        transition={{ duration: 0.5, ease: "easeInOut" }}
        animatePresenceMode="wait"
        staggerDuration={0}
        auto={true}
        loop={true}
        mainClassName="hero-rotate-text"
        elementLevelClassName="hero-rotate-char"
      />
    </span>
  )
}
