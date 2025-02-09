<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <h2 class="text-2xl font-semibold">Şirket Düzenle</h2>
          </div>

          <form @submit.prevent="submit" class="max-w-md">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Şirket Adı
              </label>
              <input v-model="form.name" 
                     type="text" 
                     id="name"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                     required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
              </label>
              <input v-model="form.email" 
                     type="email" 
                     id="email"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                     required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                Website
              </label>
              <input v-model="form.website" 
                     type="url" 
                     id="website"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="logo">
                Logo
              </label>
              <div v-if="company.logo_url" class="mb-2">
                <img :src="company.logo_url" 
                     :alt="company.name + ' logo'"
                     class="h-20 w-20 object-cover rounded-lg">
              </div>
              <input type="file" 
                     @input="form.logo = $event.target.files[0]"
                     id="logo"
                     accept="image/*"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              <p class="text-sm text-gray-500 mt-1">
                Logo en az 100x100 piksel boyutunda olmalıdır. (PNG, JPG, GIF)
              </p>
            </div>

            <div class="flex items-center justify-between">
              <button type="submit"
                      class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                      :disabled="form.processing">
                Güncelle
              </button>
              <Link :href="route('companies.index')"
                    class="text-indigo-600 hover:text-indigo-900">
                İptal
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  company: Object
})

const form = useForm({
  name: props.company.name,
  email: props.company.email,
  website: props.company.website,
  logo: null,
  _method: 'PUT'
})

const submit = () => {
  form.post(route('companies.update', props.company.id))
}
</script>
