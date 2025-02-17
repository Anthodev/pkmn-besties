import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";

/* if you're using React */
// import react from '@vitejs/plugin-react';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    /* react(), // if you're using React */
    symfonyPlugin({
      viteDevServerHostname: 'localhost'
    }),
    vue(),
  ],
  build: {
    rollupOptions: {
      input: {
        app: "./assets/app.js"
      },
    }
  },
  server: {
    host: '0.0.0.0',
    cors: true
  }
});
