<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="mb-4">You're logged in!</p>
                        <div class="flex gap-4">
                            <Link
                                href="/companies"
                                class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 transition-colors"
                            >
                                Company List
                            </Link>
                            <Link
                                href="/employees"
                                class="rounded-md bg-green-500 px-4 py-2 text-white hover:bg-green-600 transition-colors"
                            >
                                Employee List
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
