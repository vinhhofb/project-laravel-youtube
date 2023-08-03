<template>
    <div class="wrapper">
      <p>File Uploader Vue.js</p>
      <form>
        <input class="file-input" type="file" name="file" @change="uploadFile" hidden>
        <i class="fas fa-cloud-upload-alt" @click="$refs.fileInput.click()"></i>
        <p>Browse File to Upload</p>
      </form>
      <section class="progress-area" v-if="showProgress">
        <li class="row" v-for="(file, index) in files">
          <i class="fas fa-file-alt"></i>
          <div class="content">
            <div class="details">
              <span class="name">{{ file.name }} • Uploading</span>
              <span class="percent">{{ file.progress }}%</span>
            </div>
            <div class="progress-bar">
              <div class="progress" :style="{ width: file.progress + '%' }"></div>
            </div>
          </div>
        </li>
      </section>
      <section class="uploaded-area">
        <li class="row" v-for="(file, index) in uploadedFiles">
          <div class="content upload">
            <i class="fas fa-file-alt"></i>
            <div class="details">
              <span class="name">{{ file.name }} • Uploaded</span>
              <span class="size">{{ file.size }}</span>
            </div>
          </div>
          <i class="fas fa-check"></i>
        </li>
      </section>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        files: [],
        uploadedFiles: [],
        showProgress: false,
      };
    },
    methods: {
      uploadFile(event) {
        const file = event.target.files[0];
        if (file) {
          let fileName = file.name;
          if (fileName.length >= 12) {
            let splitName = fileName.split(".");
            fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
          }
          const formData = new FormData();
          formData.append("file", file);
          this.files.push({ name: fileName, progress: 0 });
          this.showProgress = true;
          axios
            .post("php/upload.php", formData, {
              onUploadProgress: (progressEvent) => {
                const loaded = progressEvent.loaded;
                const total = progressEvent.total;
                const fileLoaded = Math.floor((loaded / total) * 100);
                this.files[this.files.length - 1].progress = fileLoaded;
                if (loaded === total) {
                  const fileSize =
                    total < 1024
                      ? total + " KB"
                      : (loaded / (1024 * 1024)).toFixed(2) + " MB";
                  this.uploadedFiles.push({ name: fileName, size: fileSize });
                  this.files = [];
                  this.showProgress = false;
                }
              },
            })
            .catch((error) => {
              console.log(error);
            });
        }
      },
    },
  };
  </script>
