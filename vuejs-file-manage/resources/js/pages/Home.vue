<template>
    <div>
        <div class="grid grid-cols-4 gap-4 p-2">
            <div class="foder-icon pt-1" v-for="forder in forders">
                <router-link :to="{name: 'FileList', params: { id: forder.id }}">
                    <img src="/images/icons/forder-icon.svg">
                    <p class="text-center mt-1" style="font-size: 85%;font-weight: 600;">{{forder.name}}</p>
                </router-link>
            </div>
        </div>
        <div class="px-1 mt-4">
            <p class="px-2 mb-2" style="font-size: 95%;font-weight: 500;">Recent uploaded</p>
                <div class="file-item d-flex mt-0" v-for="file in files">
                    <div class="image-item pt-2" style="width: 52px;height: 67px;">
                        <img :src="`/images/icons/files_type/${file.type}.svg`">
                    </div>
                    <div class="pt-2 px-2" style="width: calc(100% - 80px);">
                        <p class="mt-1" style="font-size: 90%;font-weight: 600;">{{file.name}}</p>
                        <p class="mt-1" style="font-size: 85%;font-weight: 500;opacity: 0.5;">{{file.created_at}}
                        </p>
                    </div>
                    <div class="pt-2" style="width: 10px;height: 67px;">
                        <i @click="download(file.id, file.name)" class="fa fa-cloud-download text-blue-600 mt-1" aria-hidden="true"></i>
                        <i @click="deleteFile(file.id)" class="fa fa-trash text-red-600 mt-2" aria-hidden="true" style="margin-left: 2px;"></i>
                    </div>
                </div>
        </div>
    </div>
    <router-link :to="{name: 'ForderCreate'}">
        <div class="text-center" style="width: 50px;height: 50px;background: #1d4ed8;position: fixed;top:87vh;right: 10px;border-radius: 50px;cursor: pointer;">
            <i class="text-white fa fa-folder-open" aria-hidden="true" style="font-size: 140%;line-height: 48px;"></i>
        </div>
    </router-link>
</template>

<script>
    export default {
        data() {
            return {
                forders: [],
                files: []
            }
        },
        created: function () {
            this.getData();
        },
        methods: {
            async getData() {
                try {
                    const { data } = await axios.get('api/home/get-data', this.formData)
                    this.forders = data?.forders || [];
                    this.files = data?.files || [];
                } catch (error) {
                    console.log(error);
                }
            },
            async submitForm() {
                try {
                    const response = await axios.post('api/create', this.formData)
                    console.log(response)
                    this.resetForm();
                    this.errors = {}
                } catch (error) {
                    this.errors = error?.response?.data?.errors;
                }
            },
            resetForm() {
                this.formData = {
                    first_name: '',
                    last_name: '',
                    content: '',
                    category: '',
                    zip: ''
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
                        this.getData();
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
<style>
    .foder-icon {
        cursor: pointer;
    }
    .file-item{
        cursor: pointer;
    }
    .foder-icon > a > img{
        width: 100%;
    }
    .image-item > image{
        width: 100%;
        height: 100%;
    }
    a{
        text-decoration: none !important;
        color: black;
    }
    a:hover{
        color: black;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }
</style>
