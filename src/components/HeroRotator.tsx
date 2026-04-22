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
  const [dims, setDims] = useState<{ width: number; height: number } | null>(null);
  const measureRef = useRef<HTMLSpanElement>(null);

  // Measure all words once fonts are ready, set fixed container size
  useEffect(() => {
    const measure = () => {
      if (!measureRef.current) return;
      let maxW = 0;
      let maxH = 0;
      words.forEach((word) => {
        measureRef.current!.textContent = word;
        const rect = measureRef.current!.getBoundingClientRect();
        if (rect.width > maxW) maxW = rect.width;
        if (rect.height > maxH) maxH = rect.height;
      });
      // +24px buffer for emoji cross-browser differences
      setDims({ width: Math.ceil(maxW) + 24, height: Math.ceil(maxH) });
    };

    // Wait for fonts to load for accurate rects
    if (document.fonts?.ready) {
      document.fonts.ready.then(measure);
    } else {
      measure();
    }
  }, []);

  // Rotation loop
  useEffect(() => {
    const t = setInterval(() => setIndex((i) => (i + 1) % words.length), 3000);
    return () => clearInterval(t);
  }, []);

  return (
    <span
      style={{
        // Fixed size set once — never changes, zero layout reflow
        display: "inline-block",
        position: "relative",
        width: dims ? `${dims.width}px` : "4em",
        height: dims ? `${dims.height}px` : "1em",
        verticalAlign: "middle",
        overflow: "visible",
      }}
    >
      {/* Hidden span inherits h1 font for accurate measurement */}
      <span
        ref={measureRef}
        aria-hidden="true"
        style={{
          visibility: "hidden",
          position: "absolute",
          whiteSpace: "nowrap",
          pointerEvents: "none",
          top: 0,
          left: 0,
        }}
      />

      <AnimatePresence mode="wait" initial={false}>
        <motion.span
          key={index}
          // position:absolute → words OVERLAP in same spot, never push each other
          style={{
            position: "absolute",
            top: "50%",
            left: 0,
            transform: "translateY(-50%)",
            whiteSpace: "nowrap",
            display: "inline-block",
            color: "var(--accent)",
            letterSpacing: "0.02em",
            lineHeight: 1,
          }}
          // ONLY opacity — zero position change
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.4, ease: "easeInOut" }}
        >
          {words[index]}
        </motion.span>
      </AnimatePresence>
    </span>
  );
}
