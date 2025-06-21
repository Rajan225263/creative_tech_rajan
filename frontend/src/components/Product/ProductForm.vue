<template>
    <section class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg" v-if="loaded">
        <h2 class="text-2xl font-bold mb-6">{{ isEdit ? 'Edit' : 'Create' }} Product</h2>
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label>Name</label>
                <input
                        v-model="form.name"
                        class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                        :class="{ 'border-red-500': errors.name }"
                />
                <p v-if="errors.name" class="text-red-600 text-sm">{{ errors.name[0] }}</p>
            </div>

            <div>
                <label>Description</label>
                <textarea
                        v-model="form.description"
                        class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                ></textarea>
            </div>

            <div>
                <label>Price (৳)</label>
                <input
                        type="number"
                        step="0.01"
                        v-model="form.price"
                        class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                        :class="{ 'border-red-500': errors.price }"
                />
                <p v-if="errors.price" class="text-red-600 text-sm">{{ errors.price[0] }}</p>
            </div>

            <div>
                <label>Categories</label>
                <div
                        class="grid grid-cols-2 gap-3 max-h-48 overflow-auto border rounded p-3 bg-indigo-50"
                >
                    <label
                            v-for="c in categories"
                            :key="c.id"
                            class="flex items-center gap-2"
                    >
                        <input
                                type="checkbox"
                                :value="c.id"
                                v-model="form.category_ids"
                                class="form-checkbox text-indigo-600"
                        />
                        {{ c.name }}
                    </label>
                </div>
                <p v-if="errors.category_ids" class="text-red-600 text-sm">{{ errors.category_ids[0] }}</p>
            </div>

            <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded shadow"
            >
                {{ isEdit ? 'Update' : 'Create' }} Product
            </button>
        </form>
    </section>

    <p v-else class="text-center py-20 text-gray-500">Loading...</p>
</template>

<script setup>
    import { reactive, ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import api from '@/services/api'

    const router = useRouter()
    const route = useRoute()

    const isEdit = ref(!!route.params.id)
    const loaded = ref(false)

    // reactive ফর্ম অবজেক্ট ব্যবহার করা হল
    const form = reactive({
        name: '',
        description: '',
        price: '',
        category_ids: []
    })

    const categories = ref([])
    const errors = reactive({})

    const loadCategories = async () => {
        const res = await api.get('/categories')
        categories.value = res.data
    }

    const loadProduct = async () => {
        try {
            const res = await api.get(`/products/${route.params.id}`);
            const p = res.data.data; // <-- এখানে 'data' থেকে ডাটা নিতে হবে
            form.name = p.name;
            form.description = p.description;
            form.price = p.price;
            form.category_ids = p.categories.map(c => c.id);
        } catch (err) {
            console.error(err);
        }
    };


    const submit = async () => {
        // Clear previous errors
        Object.keys(errors).forEach(key => delete errors[key])

        try {
            if (isEdit.value) {
                await api.put(`/products/${route.params.id}`, form)
            } else {
                await api.post('/products', form)
            }
            router.push('/products')
        } catch (e) {
            if (e.response?.status === 422) {
                Object.assign(errors, e.response.data.errors)
            }
        }
    }

    onMounted(async () => {
        await loadCategories()
        if (isEdit.value) {
            await loadProduct()
        }
        loaded.value = true
    })
</script>
