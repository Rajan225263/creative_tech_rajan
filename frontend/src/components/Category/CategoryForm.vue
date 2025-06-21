<template>
    <section class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6">{{ isEdit ? 'Edit' : 'Create' }} Category</h2>
        <form @submit.prevent="submit" class="space-y-6">
            <div><label class="block mb-1">Name</label><input v-model="form.name" class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500" :class="{'border-red-500': errors.name}" /><p v-if="errors.name" class="text-red-600 text-sm">{{ errors.name[0] }}</p></div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded shadow">{{ isEdit ? 'Update' : 'Create' }}</button>
        </form>
    </section>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';
    import api from '@/services/api';
    const router = useRouter(), route = useRoute();
    const isEdit = ref(!!route.params.id);
    const form = ref({ name: '' });
    const errors = ref({});
    const load = async () => {
        const res = await api.get(`/categories/${route.params.id}`);
        form.value = res.data.data;  // <-- API response থেকে সঠিক জায়গা থেকে ডাটা নিন
    };
    const submit = async () => {
        errors.value = {};
        try {
            if (isEdit.value) await api.put(`/categories/${route.params.id}`, form.value);
            else await api.post('/categories', form.value);
            router.push('/categories');
        } catch (e) {
            if (e.response?.status === 422) errors.value = e.response.data.errors;
        }
    };
    onMounted(() => { if (isEdit.value) load(); });
</script>
