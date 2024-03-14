<template>
    <div class="px-2">
        <div class="file-item d-flex" v-for="file in files">
            <div class="image-item pt-2" style="width: 52px;height: 67px;">
                <img :src="`/images/icons/files_type/${file.type}.svg`">
            </div>
            <div class="pt-2 px-2" style="width: calc(100% - 80px);">
                <p class="mt-1" style="font-size: 90%;font-weight: 600;">{{file.name}}</p>
                <p class="mt-1" style="font-size: 85%;font-weight: 500;opacity: 0.5;">{{file.created_at}}
                </p>
            </div>
            <div class="pt-2 text-center" style="width: 10px;height: 67px;">
                <i @click="download(file.id, file.name)" class="fa fa-cloud-download text-blue-600 mt-1" aria-hidden="true"></i>
                <i @click="deleteFile(file.id)" class="fa fa-trash text-red-600 mt-2" aria-hidden="true" style="margin-left: 2px;"></i>
            </div>
        </div>
    </div>
    <input type="file" ref="uploadFile" @change="handleFileChange" style="display: none;">
    <div @click="openDialog" class="text-center" style="width: 50px;height: 50px;background: #1d4ed8;position: fixed;top:87vh;right: 10px;border-radius: 50px;cursor: pointer;">
        <i class="text-white fa fa-cloud-upload" aria-hidden="true" style="font-size: 140%;line-height: 48px;"></i>
    </div>

</template>
<script>
    import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                files: [],
                selectedFile: null
            }
        },
        computed: {

        },
        created: function () {
            this.getData();
        },
        watch: {
            selectedFile() {
                this.uploadFile();
            }
        },
        methods: {
            async getData() {
                try {
                    const { data } = await axios.get('/api/file/get-data/'+this.$route.params.id);
                    this.files = data || [];
                } catch (error) {
                    console.log(error);
                }
            },
            handleFileChange(event) {
                this.selectedFile = event.target.files[0];
            },
            async uploadFile() {
                const formData = new FormData();
                formData.append('file', this.selectedFile);
                try {
                    const response = await axios.post('/api/file/upload/'+this.$route.params.id, formData);
                    this.getData();
                } catch (error) {
                    Swal.fire(error?.response?.data?.message);
                }
            },
            openDialog(){
                var elem = this.$refs.uploadFile;
                elem.click()
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
