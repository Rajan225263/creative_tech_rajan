import { createRouter, createWebHistory } from 'vue-router';
import AdminLayout from '@/layouts/AdminLayout.vue';
import CategoryList from '@/components/Category/CategoryList.vue';
import CategoryForm from '@/components/Category/CategoryForm.vue';
import ProductList from '@/components/Product/ProductList.vue';
import ProductForm from '@/components/Product/ProductForm.vue';

const routes = [
    {
        path: '/',
        component: AdminLayout,
        children: [
            { path: '', redirect: '/categories' },
            { path: 'categories', component: CategoryList },
            { path: 'categories/create', component: CategoryForm },
            { path: 'categories/edit/:id', component: CategoryForm },
            { path: 'products', component: ProductList },
            { path: 'products/create', component: ProductForm },
            { path: 'products/edit/:id', component: ProductForm },
        ],
    },
    { path: '/:catchAll(.*)', redirect: '/' },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
