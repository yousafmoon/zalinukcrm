<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { computed, ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';

defineProps({
    students: {
        type: Object,
        required: true,
    },
    totalStudents: {
        type: Number,
        required: false,
        default: 0,
    },
});
const page = usePage();
const totalStudents = computed(() => page.props.totalStudents);
const user = computed(() => page.props.auth?.user || {});
const defaultImage = "/assets/images/profile-pic.jpg";
const imageSrc = ref(user.value.image || defaultImage);
watchEffect(() => {
    if (user.value.image) {
        imageSrc.value = user.value.image;
    }
});

const handleImageSubmit = (newImage) => {
    imageSrc.value = newImage;
};

const totalUniversities = ref(20);
const totalAgents = ref(10);
</script>


<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout :image="imageSrc" @image-uploaded="handleImageSubmit">

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You are logged in as: <strong>{{ user.name }}</strong>
                    </div>
                </div>

                <div class="flex justify-between flex-wrap">
                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"
                                fill="none">
                                <path d="M32 4L4 16L32 28L60 16L32 4Z" fill="#4CAF50" />
                                <path d="M28 30C20.82 30 15 35.82 15 43H41C41 35.82 35.18 30 28 30Z" fill="#FFC107" />
                                <circle cx="28" cy="20" r="8" fill="#03A9F4" />
                                <path d="M60 18V27C60 29 58 30 56 30H46C44 30 42 29 42 27V18L56 24L60 18Z"
                                    fill="#FF5722" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Student Management {{ totalStudents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="50" height="50">
                                <rect x="15" y="15" width="70" height="30" fill="#4CAF50" stroke="#000"
                                    stroke-width="2" />
                                <line x1="20" y1="20" x2="85" y2="20" stroke="#fff" stroke-width="2" />
                                <line x1="20" y1="25" x2="85" y2="25" stroke="#fff" stroke-width="2" />
                                <line x1="20" y1="30" x2="85" y2="30" stroke="#fff" stroke-width="2" />
                                <rect x="15" y="50" width="70" height="30" fill="#2196F3" stroke="#000"
                                    stroke-width="2" />
                                <line x1="20" y1="55" x2="85" y2="55" stroke="#fff" stroke-width="2" />
                                <line x1="20" y1="60" x2="85" y2="60" stroke="#fff" stroke-width="2" />
                                <line x1="20" y1="65" x2="85" y2="65" stroke="#fff" stroke-width="2" />

                            </svg>


                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Document & File Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"
                                fill="none">
                                <rect x="16" y="32" width="32" height="24" fill="#4CAF50" />
                                <polygon points="32,12 8,32 56,32" fill="#FFC107" />
                                <rect x="28" y="40" width="8" height="16" fill="#795548" />
                                <rect x="20" y="36" width="6" height="6" fill="#03A9F4" />
                                <rect x="38" y="36" width="6" height="6" fill="#03A9F4" />
                                <rect x="18" y="32" width="4" height="24" fill="#9E9E9E" />
                                <rect x="42" y="32" width="4" height="24" fill="#9E9E9E" />
                                <polygon points="32,18 28,24 36,24" fill="#FF5722" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                University Management {{ totalUniversities }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"
                                fill="none">
                                <circle cx="20" cy="20" r="8" fill="#03A9F4" />
                                <rect x="12" y="28" width="16" height="20" fill="#4CAF50" rx="4" />
                                <circle cx="44" cy="20" r="8" fill="#FF5722" />
                                <rect x="36" y="28" width="16" height="20" fill="#8E24AA" rx="4" />
                                <path d="M28,36 L36,36" stroke="#795548" stroke-width="4" stroke-linecap="round" />
                                <circle cx="32" cy="36" r="2" fill="#FFC107" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Agent Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">
                                <rect x="7.5" y="7.5" width="35" height="35" rx="2.5" ry="2.5" fill="#FFD700"
                                    stroke="#000" stroke-width="1" />
                                <rect x="7.5" y="7.5" width="2.5" height="15" fill="#00008B" />
                                <line x1="10" y1="12.5" x2="42.5" y2="12.5" stroke="#8B4513" stroke-width="0.5" />
                                <line x1="10" y1="17.5" x2="42.5" y2="17.5" stroke="#8B4513" stroke-width="0.5" />
                                <line x1="10" y1="22.5" x2="42.5" y2="22.5" stroke="#8B4513" stroke-width="0.5" />
                                <line x1="10" y1="27.5" x2="42.5" y2="27.5" stroke="#8B4513" stroke-width="0.5" />
                                <line x1="10" y1="32.5" x2="42.5" y2="32.5" stroke="#8B4513" stroke-width="0.5" />
                                <line x1="10" y1="37.5" x2="42.5" y2="37.5" stroke="#8B4513" stroke-width="0.5" />
                            </svg>



                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                IECTC Courses {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>


                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="50" height="50">
                                <circle cx="25" cy="30" r="10" fill="#4CAF50" />
                                <rect x="20" y="40" width="10" height="20" fill="#4CAF50" />
                                <circle cx="50" cy="30" r="10" fill="#2196F3" />
                                <rect x="45" y="40" width="10" height="20" fill="#2196F3" />
                                <circle cx="75" cy="30" r="10" fill="#FF9800" />
                                <rect x="70" y="40" width="10" height="20" fill="#FF9800" />
                                <line x1="35" y1="30" x2="50" y2="30" stroke="#000" stroke-width="2" />
                                <line x1="60" y1="30" x2="75" y2="30" stroke="#000" stroke-width="2" />
                                <line x1="25" y1="40" x2="50" y2="40" stroke="#000" stroke-width="2" />
                                <line x1="50" y1="40" x2="75" y2="40" stroke="#000" stroke-width="2" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Associations {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <circle cx="50" cy="30" r="15" fill="#FF6347" stroke="#000" stroke-width="2" />
                                <line x1="50" y1="45" x2="35" y2="60" stroke="#2E8B57" stroke-width="2" />
                                <line x1="50" y1="45" x2="65" y2="60" stroke="#2E8B57" stroke-width="2" />
                                <circle cx="35" cy="60" r="10" fill="#4682B4" stroke="#000" stroke-width="2" />
                                <circle cx="65" cy="60" r="10" fill="#4682B4" stroke="#000" stroke-width="2" />
                                <line x1="35" y1="70" x2="30" y2="80" stroke="#FFD700" stroke-width="2" />
                                <line x1="65" y1="70" x2="70" y2="80" stroke="#FFD700" stroke-width="2" />
                                <circle cx="30" cy="80" r="5" fill="#9370DB" stroke="#000" stroke-width="2" />
                                <circle cx="70" cy="80" r="5" fill="#9370DB" stroke="#000" stroke-width="2" />
                            </svg>





                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Lead & Inquiry Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>


                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <rect x="20" y="15" width="60" height="70" rx="5" ry="5" fill="#E0F7FA" stroke="#000"
                                    stroke-width="2" />
                                <rect x="25" y="25" width="50" height="10" rx="2" ry="2" fill="#0288D1" />
                                <line x1="25" y1="40" x2="75" y2="40" stroke="#000" stroke-width="2" />
                                <line x1="25" y1="50" x2="75" y2="50" stroke="#000" stroke-width="2" />
                                <line x1="25" y1="60" x2="75" y2="60" stroke="#000" stroke-width="2" />
                                <line x1="25" y1="70" x2="75" y2="70" stroke="#000" stroke-width="2" />
                                <circle cx="35" cy="50" r="5" fill="#4CAF50" />
                                <polyline points="33,50 35,52 38,48" fill="none" stroke="#fff" stroke-width="2" />
                            </svg>




                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Application & Admission Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <rect x="20" y="30" width="60" height="40" rx="5" ry="5" fill="#4CAF50" stroke="#000"
                                    stroke-width="2" />
                                <rect x="20" y="25" width="60" height="15" rx="5" ry="5" fill="#8BC34A" stroke="#000"
                                    stroke-width="2" />
                                <rect x="25" y="35" width="50" height="20" rx="3" ry="3" fill="#FFD700" stroke="#000"
                                    stroke-width="2" />
                                <circle cx="40" cy="45" r="5" fill="#FF5722" />
                                <text x="37" y="48" font-family="Arial" font-size="6" fill="#fff">$</text>
                                <line x1="20" y1="40" x2="80" y2="40" stroke="#000" stroke-width="1"
                                    stroke-dasharray="3 3" />
                                <rect x="60" y="50" width="20" height="10" rx="2" ry="2" fill="#E0E0E0" stroke="#000"
                                    stroke-width="1" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Fee & Payment Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <rect x="20" y="20" width="60" height="80" rx="5" ry="5" fill="#4A90E2" stroke="#000"
                                    stroke-width="2" />
                                <circle cx="50" cy="45" r="15" fill="#FFFFFF" stroke="#000" stroke-width="1.5" />
                                <path d="M50 30 A15 15 0 0 0 50 60 A15 15 0 0 0 50 30 Z" fill="none" stroke="#000"
                                    stroke-width="1" />
                                <path d="M40 45 H60" stroke="#000" stroke-width="1" />
                                <path d="M50 30 V60" stroke="#000" stroke-width="1" />
                                <rect x="30" y="65" width="40" height="10" rx="2" ry="2" fill="#FFCC00" stroke="#000"
                                    stroke-width="1.5" />
                                <text x="32" y="72" font-family="Arial" font-size="6" fill="#000">VISA</text>
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Visa & Immigration Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>


                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <path
                                    d="M20 20 H80 A10 10 0 0 1 90 30 V60 A10 10 0 0 1 80 70 H40 L25 85 V70 H20 A10 10 0 0 1 10 60 V30 A10 10 0 0 1 20 20 Z"
                                    fill="#4A90E2" stroke="#000" stroke-width="2" />
                                <path
                                    d="M30 40 H70 A5 5 0 0 1 75 45 V55 A5 5 0 0 1 70 60 H40 L35 65 V60 H30 A5 5 0 0 1 25 55 V45 A5 5 0 0 1 30 40 Z"
                                    fill="#FFFFFF" stroke="#000" stroke-width="1.5" />
                                <line x1="35" y1="45" x2="65" y2="45" stroke="#000" stroke-width="2" />
                                <line x1="35" y1="50" x2="60" y2="50" stroke="#000" stroke-width="2" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Communication Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <circle cx="50" cy="50" r="30" fill="#E5E5E5" />
                                <path d="M50,50 L50,20 A30,30 0 0,1 80,50 Z" fill="#4A90E2" />
                                <rect x="20" y="70" width="10" height="20" fill="#7ED321" />
                                <rect x="35" y="60" width="10" height="30" fill="#F5A623" />
                                <rect x="50" y="50" width="10" height="40" fill="#D0021B" />
                                <rect x="65" y="40" width="10" height="50" fill="#BD10E0" />
                                <line x1="20" y1="80" x2="35" y2="70" stroke="#4A90E2" stroke-width="2" />
                                <line x1="35" y1="70" x2="50" y2="60" stroke="#4A90E2" stroke-width="2" />
                                <line x1="50" y1="60" x2="65" y2="50" stroke="#4A90E2" stroke-width="2" />
                                <line x1="65" y1="50" x2="80" y2="40" stroke="#4A90E2" stroke-width="2" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Reporting & Analytics {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>


                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <circle cx="50" cy="50" r="40" fill="#F0F0F0" stroke="#000" stroke-width="2" />
                                <rect x="30" y="40" width="10" height="20" rx="2" fill="#4A90E2" />
                                <rect x="60" y="40" width="10" height="20" rx="2" fill="#4A90E2" />
                                <circle cx="50" cy="50" r="10" fill="#FFD700" />
                                <line x1="50" y1="60" x2="50" y2="70" stroke="#000" stroke-width="2" />
                                <circle cx="50" cy="75" r="5" fill="#D0021B" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Student Support & Follow-up {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>


                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <path d="M30 40 L70 30 L70 70 L30 60 Z" fill="#FFD700" stroke="#000" stroke-width="2" />
                                <path d="M75 40 Q85 50 75 60" stroke="#4A90E2" stroke-width="2" fill="none" />
                                <path d="M80 35 Q95 50 80 65" stroke="#D0021B" stroke-width="2" fill="none" />
                                <rect x="28" y="55" width="10" height="30" rx="3" fill="#8B4513" stroke="#000"
                                    stroke-width="2" />
                                <circle cx="50" cy="50" r="5" fill="#4A90E2" />
                                <circle cx="60" cy="40" r="3" fill="#D0021B" />
                            </svg>

                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Marketing & Campaign Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>

                    <div
                        class="relative mt-6 flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 100 100"
                                fill="none">
                                <rect x="20" y="20" width="60" height="60" rx="5" ry="5" fill="#FFD700" stroke="#000"
                                    stroke-width="2" />
                                <path d="M30 35 L40 45 L60 25" stroke="#4CAF50" stroke-width="4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="50" cy="70" r="8" fill="#4A90E2" stroke="#000" stroke-width="2" />
                                <rect x="25" y="50" width="5" height="5" fill="#D0021B" />
                                <rect x="25" y="60" width="5" height="5" fill="#D0021B" />
                                <rect x="25" y="70" width="5" height="5" fill="#D0021B" />
                                <line x1="35" y1="52.5" x2="70" y2="52.5" stroke="#000" stroke-width="2" />
                                <line x1="35" y1="62.5" x2="70" y2="62.5" stroke="#000" stroke-width="2" />
                                <line x1="35" y1="72.5" x2="70" y2="72.5" stroke="#000" stroke-width="2" />
                            </svg>
                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                Task & Activity Management {{ totalAgents }}
                            </h5>

                        </div>
                        <div class="p-6 pt-0">
                            <a class="!font-medium !text-blue-gray-900 !transition-colors hover:!text-green-500"
                                :href="route('students.index')">
                                <button
                                    class="flex select-none items-center gap-2 rounded-lg py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-green-500 transition-all hover:bg-green-500/10 active:bg-green-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    Know More
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>


            </div>
        </div>



        <Footer />
    </AuthenticatedLayout>
</template>
