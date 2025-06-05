<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { watchEffect } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

watchEffect(() => {
    if (props.student) {
        formStore.student = props.student;
    }
});

</script>

<template>

    <h3 class="text-lg font-medium text-red-700 mt-4 mb-1">
        OVERSEAS TRAVEL HISTORY
    </h3>
    <p class="mb-4">
        Please provide details of the country, dates, duration, and purpose of your travel outside your normal
        country of residence for the last 10 years.
    </p>


    <div v-if="props.student && props.student.overseas_travel_history_details">

        <div class="grid grid-cols-12 gap-6">
            <div v-for="(region, regionIndex) in props.student.overseas_travel_history_details" :key="regionIndex"
                class="col-span-12">
                <div class="col-span-12 mb-2 border p-4 rounded-lg shadow-md bg-white">
                    <h3 class="text-md font-semibold text-red-700 mb-2">
                        Travel Region {{ regionIndex + 1 }}
                    </h3>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700">Region Title: <strong>{{
                            region.region_title }}</strong>
                        </span>

                    </div>

                    <div v-if="region.visits && region.visits.length > 0">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Visits</h4>

                        <div v-for="(visit, visitIndex) in region.visits" :key="visitIndex"
                            class="border p-3 rounded-md bg-gray-50 mb-4">
                            <table class="w-full table-auto text-sm">
                                <tbody>
                                    <tr class="border-b">
                                        <td class="font-semibold py-1 pr-4 w-1/2">Country Visited:</td>
                                        <td class="py-1">{{ visit.country_visited }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="font-semibold py-1 pr-4">Date Arrived:</td>
                                        <td class="py-1">{{ visit.date_arrived }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="font-semibold py-1 pr-4">Purpose of Visit:</td>
                                        <td class="py-1">{{ visit.purpose_of_visit }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold py-1 pr-4">Length of Stay:</td>
                                        <td class="py-1">{{ visit.length_of_stay }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
