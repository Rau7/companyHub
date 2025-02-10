<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Şirketler</h2>
                        <Link
                            :href="route('companies.create')"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Yeni Şirket Ekle
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Logo
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Şirket Adı
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Website
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        İşlemler
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="company in companies.data"
                                    :key="company.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img
                                            v-if="company.logo_url"
                                            :src="company.logo_url"
                                            class="h-12 w-12 object-cover rounded-full"
                                            :alt="company.name + ' logo'"
                                        />
                                        <div
                                            v-else
                                            class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center"
                                        >
                                            <span
                                                class="text-gray-500 text-xl"
                                                >{{
                                                    company.name.charAt(0)
                                                }}</span
                                            >
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ company.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ company.email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a
                                            v-if="company.website"
                                            :href="company.website"
                                            target="_blank"
                                            class="text-blue-600 hover:text-blue-900"
                                        >
                                            {{ company.website }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Link
                                            :href="
                                                route(
                                                    'companies.edit',
                                                    company.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >Düzenle</Link
                                        >
                                        <button
                                            @click="deleteCompany(company.id)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Sil
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-4">
                            <div
                                class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                            >
                                <div
                                    class="flex flex-1 justify-between sm:hidden"
                                >
                                    <Link
                                        v-if="companies.prev_page_url"
                                        :href="companies.prev_page_url"
                                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    >
                                        Önceki
                                    </Link>
                                    <Link
                                        v-if="companies.next_page_url"
                                        :href="companies.next_page_url"
                                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    >
                                        Sonraki
                                    </Link>
                                </div>
                                <div
                                    class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                                >
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Toplam
                                            <span class="font-medium">{{
                                                companies.total
                                            }}</span>
                                            sonuçtan
                                            <span class="font-medium"
                                                >{{ companies.from }}-{{
                                                    companies.to
                                                }}</span
                                            >
                                            arası gösteriliyor
                                        </p>
                                    </div>
                                    <div>
                                        <nav
                                            class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                            aria-label="Pagination"
                                        >
                                            <Link
                                                v-for="link in companies.links"
                                                :key="link.url"
                                                :href="link.url"
                                                :class="[
                                                    link.active
                                                        ? 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                        : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0',
                                                    'relative inline-flex items-center px-4 py-2 text-sm font-semibold',
                                                ]"
                                                v-html="link.label"
                                            />
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

defineProps({
    companies: Object,
});

const deleteCompany = (id) => {
    if (confirm("Bu şirketi silmek istediğinizden emin misiniz?")) {
        useForm().delete(route("companies.destroy", id));
    }
};
</script>
