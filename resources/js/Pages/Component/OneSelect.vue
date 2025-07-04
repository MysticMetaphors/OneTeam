<template>
    <form>
        <select id="item" name="item" v-model="form.item"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option hidden value="">{{ title }}</option>
            <option v-for="item in items" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>
    </form>
    {{ console.log(items) }}
</template>

<script>
import apiClient from '../../axios';

export default {
    props: {
        items: {
            type: Array,
            required: true
        },
        title: {
            type: String,
            default: 'Select Item'
        },
    },
    data() {
        return {
            form: {
                item: ''
            }
        }
    },
    methods: {
        async sendForm() {
            await apiClient.get('/sactum/csrf-cookie')

            const form = this.form
            const formData = new FormData();
            for ( let i = 0; i < form.lenght; i++) {
                const [value, key] = form[i];
                formData.append(key, value);
            }

            // const response = await apiClient.post(route('task.store'), formData);
            // this.message = response.data.message
            // this.$inertia.visit(route('task.create'));
        }
    }
}
</script>

<style scoped>
form {
    all: unset;
    padding: 0;
    box-shadow: none;
}

select {
    width: 100%;
    height: 40px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
}
</style>
