import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import legacy from "@vitejs/plugin-legacy";
import { createHash } from "crypto";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(),
    legacy({
      targets: ["defaults", "not IE 11"],
    }),
  ],
  server: true,
  build: {
    emptyOutDir: false,
    manifest: true,
    assetsDir: `assets/build.webpack__${createHash("md5").digest("hex")}`,
  },
});
