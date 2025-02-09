<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <h2 class="text-2xl font-semibold">Çalışan Düzenle</h2>
          </div>

          <form @submit.prevent="submit" class="max-w-md">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                Ad
              </label>
              <input v-model="form.first_name" 
                     type="text" 
                     id="first_name"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                     required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                Soyad
              </label>
              <input v-model="form.last_name" 
                     type="text" 
                     id="last_name"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                     required>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="company_id">
                Şirket
              </label>
              <select v-model="form.company_id"
                      id="company_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                <option value="">Şirket Seçin</option>
                <option v-for="company in companies" 
                        :key="company.id" 
                        :value="company.id">
                  {{ company.name }}
                </option>
              </select>
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
              <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                Telefon
              </label>
              <input v-model="form.phone" 
                     type="tel" 
                     id="phone"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
              <button type="submit"
                      class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                      :disabled="form.processing">
                Güncelle
              </button>
              <Link :href="route('employees.index')"
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
  employee: Object,
  companies: Array
})

const form = useForm({
  first_name: props.employee.first_name,
  last_name: props.employee.last_name,
  company_id: props.employee.company_id,
  email: props.employee.email,
  phone: props.employee.phone,
  _method: 'PUT'
})

const submit = () => {
  form.post(route('employees.update', props.employee.id))
}
</script>
