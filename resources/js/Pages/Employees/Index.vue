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
                                    v-for="employee in employees"
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
                                        {{ employee.company.name }}
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
    employees: Array,
});

const deleteEmployee = (id) => {
    if (confirm("Bu çalışanı silmek istediğinizden emin misiniz?")) {
        useForm().delete(route("employees.destroy", id));
    }
};
</script>
