<template>
    <div class="px-2">
        <div class="mb-6 px-2">
            <input v-model="keyword" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="file-item d-flex" v-for="file in files">
            <div class="image-item pt-2" style="width: 52px;height: 67px;">
                <img :src="`/images/icons/files_type/${file.type}.svg`">
            </div>
            <div class="pt-2 px-2" style="width: calc(100% - 80px);">
                <p class="mt-1" style="font-size: 90%;font-weight: 600;">{{file.name}}</p>
                <p class="mt-1" style="font-size: 85%;font-weight: 500;opacity: 0.5;">18 Dec, 2020 at 14:37 - 3.4MB
                </p>
            </div>
            <div class="pt-2 text-center" style="width: 10px;height: 67px;">
                <i @click="download(file.id, file.name)" class="fa fa-cloud-download text-blue-600 mt-1" aria-hidden="true"></i>
                <i @click="deleteFile(file.id)" class="fa fa-trash text-red-600 mt-2" aria-hidden="true" style="margin-left: 2px;"></i>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                keyword: '',
                files: []
            }
        },
        watch: {
            keyword() {
                this.search();
            }
        },
        methods: {
            async search() {
                try {
                    const {data} = await axios.post('/api/file/search', {'keyword': this.keyword})
                    this.files = data;
                } catch (error) {
                    console.log(error);
                }
            },
            download(id, name){
                axios.get('/api/file/download/'+id, { responseType: 'blob' })
                .then(response => {
                    console.log(response.headers);
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', name);
                    document.body.appendChild(link);
                    link.click();
                })
                .catch(error => {
                    console.log(error);
                });
            },
            async deleteFile(id){
                try {
                    const {data} = await axios.get('/api/file/delete/'+id);
                    if(data){
                        this.search();
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
