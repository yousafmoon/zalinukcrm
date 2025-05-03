<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
        required: true,
    },
    pageNumberUpdated: {
        type: Function,
        default: null,
    },
    baseRoute: {
        type: String,
        required: true, 
    },
});

const defaultPageNumberUpdated = (link) => {
    if (!link.url) return; 
    const pageNumber = new URL(link.url).searchParams.get("page");

    router.visit(`${baseRoute}?page=${pageNumber}`, {
        preserveScroll: true,
        replace: true,
    });
};
</script>

<template>
    <div class="max-w-7xl mx-auto py-6">
        <div class="max-w-none mx-auto">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                >
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ data.meta.from }}</span>
                                to
                                <span class="font-medium">{{ data.meta.to }}</span>
                                of
                                <span class="font-medium">{{ data.meta.total }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav
                                class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination"
                            >
                                <button
                                    v-for="(link, index) in data.meta.links"
                                    :key="index"
                                    @click.prevent="pageNumberUpdated
                                        ? pageNumberUpdated(link)
                                        : defaultPageNumberUpdated(link)"
                                    :disabled="link.active || !link.url"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    :class="{
                                        'z-10 bg-red-50 border-red-500 text-red-600':
                                            link.active,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50':
                                            !link.active,
                                    }"
                                >
                                    <span v-html="link.label"></span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
