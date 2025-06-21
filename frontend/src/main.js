import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import * as lucide from 'lucide-vue-next';
import './index.css'; // Tailwind CSS

const app = createApp(App);
Object.entries(lucide).forEach(([name, comp]) => {
    app.component(name, comp);
});
app.use(router);
app.mount('#app');
