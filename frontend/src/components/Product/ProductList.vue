<template>
    <section class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Products</h1>
            <router-link to="/products/create" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                <Plus class="w-5 h-5"/> Add Product
            </router-link>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50 text-indigo-700 text-sm tracking-wide uppercase">
                <tr><th class="px-6 py-4">#</th><th class="px-6 py-4 text-left">Name</th><th class="px-6 py-4 text-left">Price</th><th class="px-6 py-4 text-left">Categories</th><th class="px-6 py-4 text-right">Actions</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                <tr v-for="(p, i) in products" :key="p.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ i + 1 }}</td>
                    <td class="px-6 py-4 font-medium">{{ p.name }}</td>
                    <td class="px-6 py-4">৳{{ parseFloat(p.price).toFixed(2) }}</td>
                    <td class="px-6 py-4">
                        <span v-for="c in p.categories" :key="c.id" class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2 py-1 rounded">{{ c.name }}</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <router-link :to="`/products/edit/${p.id}`" class="text-indigo-600 hover:underline">Edit</router-link>
                        <button @click="del(p.id)" class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                <tr v-if="!products.length"><td colspan="5" class="text-center py-6 text-gray-500">No products found.</td></tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import api from '@/services/api';
    import { Plus } from 'lucide-vue-next';

    const products = ref([]);
    const fetch = async () => { products.value = (await api.get('/products')).data; };
    const del = async (id) => { if (confirm('Confirm delete?')) { await api.delete(`/products/${id}`); fetch(); } };
    onMounted(fetch);
</script>
