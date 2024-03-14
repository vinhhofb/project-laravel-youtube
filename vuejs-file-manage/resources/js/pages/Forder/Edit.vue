<template>
    <div class="p-3">
        <div class="mb-6">
            <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forder Name</label>
            <input v-model="formData.name" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button @click="changeNameForder" type="button" class="mt-3 w-100 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-0 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">Change</button>
            <button @click="deleteForder" type="button" class="mt-2 w-100 text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:red:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">Delete</button>
        </div>
    </div>
</template>
<script>
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
        created: function () {
            this.getForder();
        },
        methods: {
            async getForder() {
                try {
                    const {data} = await axios.get('/api/forder/edit/'+this.$route.params.id);
                    this.formData.name = data.name;
                } catch (error) {
                    console.log(error);
                }
            },
            async changeNameForder() {
                try {
                    const {data} = await axios.post('/api/forder/edit/'+this.$route.params.id, this.formData);
                    if(data){
                        this.$router.push({ name: 'Home' });
                    }
                } catch (error) {
                    console.log(error);
                }
            },
            async deleteForder() {
                try {
                    const {data} = await axios.get('/api/forder/delete/'+this.$route.params.id);
                    if(data){
                        this.$router.push({ name: 'Home' });
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
