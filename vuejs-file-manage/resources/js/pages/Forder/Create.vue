<template>
    <div class="p-3">
        <div class="mb-6">
            <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forder Name</label>
            <input v-model="formData.name" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button @click="createForder" type="button" class="mt-3 w-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
        </div>
    </div>
</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                formData: {
                    name: ""
                }
            }
        },
        computed: {
            currentTitlePage() {
                return this.$route?.meta?.title || '';
            }
        },
        methods: {
            async createForder() {
                try {
                    const {data} = await axios.post('/api/forder/create', this.formData)
                    if(data){
                        this.$router.push({ name: 'Home' });
                    }
                } catch (error) {
                    Swal.fire(error?.response?.data?.message);
                }
            },
        }
    }
</script>
