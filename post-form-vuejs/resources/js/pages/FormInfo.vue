<template>
    <div class="p-4 w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              First Name
            </label>
            <input v-model="formData.first_name" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
            <p v-if="errors.first_name" class="text-red-500 text-xs italic">{{ errors.first_name[0] }}</p>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              Last Name
            </label>
            <input v-model="formData.last_name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <p v-if="errors.last_name" class="text-red-500 text-xs italic">{{ errors.last_name[0] }}</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Content
            </label>
            <input v-model="formData.content" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <p v-if="errors.content" class="text-red-500 text-xs italic">{{ errors.content[0] }}</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Categories
            </label>
            <div class="relative">
              <select v-model="formData.category" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option v-for="category in categories" :value="`${category.id}`" value="{{ category.id }}">{{ category.name }}</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
              <p v-if="errors.category" class="text-red-500 text-xs italic">{{ errors.category[0] }}</p>
            </div>
          </div>
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
              Zip
            </label>
            <input v-model="formData.zip" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="90210">
            <p v-if="errors.zip" class="text-red-500 text-xs italic">{{ errors.zip[0] }}</p>
          </div>
        </div>
        <button @click="submitForm()" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Sunmit
        </button>
  </div>
</template>

<script>
    export default {
        props: {
            categories: {
                default: []
            }
        },
        data() {
            return {
                formData : {
                    first_name: '',
                    last_name: '',
                    content: '',
                    category: '',
                    zip: ''
                },
                errors: {}
            }
        },
        created: function () {
            console.log(this.categories)
        },
        methods: {
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
            }
        }
    }
</script>
