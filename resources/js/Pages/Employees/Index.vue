<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Çalışanlar</h2>
                        <Link
                            :href="route('employees.create')"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Yeni Çalışan Ekle
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Ad Soyad
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Şirket
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Telefon
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
                                    v-for="employee in employees.data"
                                    :key="employee.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ employee.first_name }}
                                        {{ employee.last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ employee.email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{
                                            employee.company
                                                ? employee.company.name
                                                : "-"
                                        }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ employee.phone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Link
                                            :href="
                                                route(
                                                    'employees.edit',
                                                    employee.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >Düzenle</Link
                                        >
                                        <button
                                            @click="deleteEmployee(employee.id)"
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
                                        v-if="employees.prev_page_url"
                                        :href="employees.prev_page_url"
                                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    >
                                        Önceki
                                    </Link>
                                    <Link
                                        v-if="employees.next_page_url"
                                        :href="employees.next_page_url"
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
                                                employees.total
                                            }}</span>
                                            sonuçtan
                                            <span class="font-medium"
                                                >{{ employees.from }}-{{
                                                    employees.to
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
                                                v-for="link in employees.links"
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
    employees: Object,
});

const deleteEmployee = (id) => {
    if (confirm("Bu çalışanı silmek istediğinizden emin misiniz?")) {
        useForm().delete(route("employees.destroy", id));
    }
};
</script>
