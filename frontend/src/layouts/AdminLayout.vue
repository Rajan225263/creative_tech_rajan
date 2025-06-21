<template>
  <div class="flex min-h-screen bg-gray-100">
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
      <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <h1 class="text-xl font-bold text-indigo-400">AdminPanel</h1>
      </div>
      <nav class="p-4">
        <ul class="space-y-2">
          <li>
            <router-link
                    to="/categories"
                    class="flex items-center px-4 py-2 rounded hover:bg-indigo-600"
                    :class="isActive('/categories') ? 'bg-indigo-700' : ''"
            >
              <Menu class="w-5 h-5 mr-2" />
              Categories
            </router-link>
          </li>
          <li>
            <router-link
                    to="/products"
                    class="flex items-center px-4 py-2 rounded hover:bg-indigo-600"
                    :class="isActive('/products') ? 'bg-indigo-700' : ''"
            >
              <Box class="w-5 h-5 mr-2" />
              Products
            </router-link>
          </li>
        </ul>
      </nav>
    </aside>

    <div class="flex-1 flex flex-col">
      <header class="h-16 bg-white shadow px-6 flex items-center">
        <h2 class="text-lg font-semibold text-gray-800">Dashboard</h2>
      </header>
      <main class="flex-1 p-6 overflow-auto">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script setup>
  import { useRoute } from 'vue-router';
  import { Menu, Box } from 'lucide-vue-next';
  const route = useRoute();
  const isActive = (path) => route.path.startsWith(path);
</script>
