<template>
    <section class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6">{{ isEdit ? 'Edit' : 'Create' }} Product</h2>
        <form @submit.prevent="submit" class="space-y-6">
            <div><label>Name</label><input v-model="form.name" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500" :class="{'border-red-500': errors.name}" /><p v-if="errors.name" class="text-red-600 text-sm">{{ errors.name[0] }}</p></div>
            <div><label>Description</label><textarea v-model="form.description" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500"></textarea></div>
            <div><label>Price (৳)</label><input type="number" step="0.01" v-model="form.price" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500" :class="{'border-red-500': errors.price}" /><p v-if="errors.price" class="text-red-600 text-sm">{{ errors.price[0] }}</p></div>
            <div>
                <label>Categories</label>
                <div class="grid grid-cols-2 gap-3 max-h-48 overflow-auto border rounded p-3 bg-indigo-50">
                    <label v-for="c in categories" :key="c.id" class="flex items-center gap-2"><input type="checkbox" :value="c.id" v-model="form.category_ids" class="form-checkbox text-indigo-600" />{{ c.name }}</label>
                </div>
                <p v-if="errors.category_ids" class="text-red-600 text-sm">{{ errors.category_ids[0] }}</p>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded shadow">{{ isEdit ? 'Update' : 'Create' }} Product</button>
        </form>
    </section>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';
    import api from '@/services/api';

    const router = useRouter(), route = useRoute();
    const isEdit = ref(!!route.params.id);
    const form = ref({ name: '', description: '', price: '', category_ids: [] });
    const categories = ref([]);
    const errors = ref({});

    const loadCats = async () => { categories.value = (await api.get('/categories')).data; };
    const loadProduct = async () => {
        const res = await api.get(`/products/${route.params.id}`);
        const p = res.data;
        form.value = { name: p.name, description: p.description, price: p.price, category_ids: p.categories.map(c => c.id) };
    };

    const submit = async () => {
        errors.value = {};
        try {
            if (isEdit.value) await api.put(`/products/${route.params.id}`, form.value);
            else await api.post('/products', form.value);
            router.push('/products');
        } catch (e) {
            if (e.response?.status === 422) errors.value = e.response.data.errors;
        }
    };

    onMounted(() => { loadCats(); if (isEdit.value) loadProduct(); });
</script>
