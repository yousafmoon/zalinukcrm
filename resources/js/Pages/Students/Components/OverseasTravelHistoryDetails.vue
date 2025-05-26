<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();
</script>

<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            OVERSEAS TRAVEL HISTORY
        </h3>
        <p>Please provide details of the country, dates, duration, and purpose of your travel outside your normal
            country of residence for the last 10 years.</p>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Loop through Travel History -->
        <div v-for="(region, regionIndex) in formStore.student.overseastravelhistoryDetails" :key="regionIndex"
            class="col-span-12">
            <div class="col-span-12 mb-2 relative border p-4 rounded-lg shadow-md bg-white mt-2">
                <!-- Region Heading -->
                <h3 class="text-lg font-medium text-red-700 col-span-12 w-full">
                    Travel Region {{ regionIndex + 1 }}
                </h3>

                <!-- Action Buttons for Region -->
                <div class="absolute top-1 right-1 flex space-x-2">
                    <button type="button" @click="formStore.addRegion"
                        class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
                    <button @click="formStore.removeRegion(regionIndex)" type="button"
                        v-if="formStore.student.overseastravelhistoryDetails.length > 1"
                        class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>
                </div>

                <!-- Region Title -->
                <div class="mt-2">
                    <label class="block text-sm font-medium text-gray-700">Region Title</label>
                    <input v-model="region.region_title" type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                        placeholder="Enter region title">
                </div>

                <!-- Visits Section -->
                <div class="mt-4">
                    <h4 class="text-md font-medium text-gray-700">Visits</h4>
                    <div v-for="(visit, visitIndex) in region.visits" :key="visitIndex"
                        class="border p-2 rounded-md bg-gray-50 mt-2 pt-5 relative">

                        <!-- Visit Fields -->
                        <div class="grid grid-cols-4 gap-6">
                            <div class="col-span-3 sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">Country Visited</label>
                                <input v-model="visit.country_visited" type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                    placeholder="Enter country">
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">Date Arrived</label>
                                <input v-model="visit.date_arrived" type="date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">Purpose of Visit</label>
                                <input v-model="visit.purpose_of_visit" type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                    placeholder="Enter purpose">
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">Length of Stay</label>
                                <input v-model="visit.length_of_stay" type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                    placeholder="Enter length">
                            </div>
                        </div>

                        <!-- Add/Remove Visit Buttons -->
                        <div class="absolute top-1 right-1 flex space-x-2">
                            <button type="button" @click="formStore.addVisit(regionIndex)"
                                class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
                            <button @click="formStore.removeVisit(regionIndex, visitIndex)" type="button"
                                v-if="region.visits.length > 1"
                                class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
