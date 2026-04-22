import { useState, useEffect, useRef } from "react";
import { AnimatePresence, motion } from "motion/react";

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
];

export function HeroRotator() {
  const [index, setIndex] = useState(0);
  const [maxWidth, setMaxWidth] = useState<number | null>(null);
  const measureRef = useRef<HTMLSpanElement>(null);

  // After mount: measure all words and lock container to the widest
  useEffect(() => {
    if (!measureRef.current) return;
    let max = 0;
    words.forEach((word) => {
      measureRef.current!.textContent = word;
      const w = measureRef.current!.getBoundingClientRect().width;
      if (w > max) max = w;
    });
    // Small buffer for emoji cross-browser differences
    setMaxWidth(Math.ceil(max) + 16);
  }, []);

  // Rotation timer
  useEffect(() => {
    const timer = setInterval(() => {
      setIndex((i) => (i + 1) % words.length);
    }, 3000);
    return () => clearInterval(timer);
  }, []);

  return (
    <span
      style={{
        display: "inline-block",
        position: "relative",
        // Width is locked to widest word — never changes, zero layout shift
        width: maxWidth != null ? `${maxWidth}px` : "auto",
        verticalAlign: "middle",
        // Overflow visible so emoji on edges aren't clipped
        overflow: "visible",
      }}
    >
      {/* Invisible measurement span — cloned font from parent via CSS class */}
      <span
        ref={measureRef}
        aria-hidden="true"
        style={{
          visibility: "hidden",
          position: "absolute",
          top: 0,
          left: 0,
          whiteSpace: "nowrap",
          pointerEvents: "none",
        }}
      />

      <AnimatePresence mode="wait" initial={false}>
        <motion.span
          key={index}
          // ONLY opacity — zero vertical or horizontal movement
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.45, ease: "easeInOut" }}
          style={{
            display: "inline-block",
            whiteSpace: "nowrap",
            color: "var(--accent)",
            letterSpacing: "0.02em",
            lineHeight: 1,
          }}
        >
          {words[index]}
        </motion.span>
      </AnimatePresence>
    </span>
  );
}
