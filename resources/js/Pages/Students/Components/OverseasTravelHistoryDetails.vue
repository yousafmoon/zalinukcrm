<script setup>

import { useStudentStore } from '@/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            OVERSEAS TRAVEL HISTORY:</h3>
    </div>
    <p>Please provide details of the country, dates, duration, and purpose of your travel outside your normal country of
        residence for the last 10 years.</p>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <h3 class="text-md font-medium text-red-700">United Kingdom</h3>
            <div class="mt-2">
                <label for="uk_country_visited" class="block text-sm font-medium text-gray-700">Country Visited</label>
                <input v-model="formStore.student.uk_country_visited" type="text" id="uk_country_visited"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter country visited">
            </div>

            <div class="mt-2">
                <label for="uk_date_arrived" class="block text-sm font-medium text-gray-700">Date Arrived</label>
                <input v-model="formStore.student.uk_date_arrived" type="date" id="uk_date_arrived"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
            <div class="mt-2">
                <label for="uk_purpose_of_visit" class="block text-sm font-medium text-gray-700">Purpose of
                    visit</label>
                <input v-model="formStore.student.uk_purpose_of_visit" type="text" id="uk_purpose_of_visit"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter purpose of visit">
            </div>
            <div class="mt-2">
                <label for="uk_length_of_stay" class="block text-sm font-medium text-gray-700">Length of stay
                    (dd/wks/yrs)</label>
                <input v-model="formStore.student.uk_length_of_stay" type="text" id="uk_length_of_stay"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter length of stay">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <h3 class="text-md font-medium text-red-700">Europe</h3>
            <div class="mt-2">
                <label for="europe_country_visited" class="block text-sm font-medium text-gray-700">Country
                    Visited</label>
                <input v-model="formStore.student.europe_country_visited" type="text" id="europe_country_visited"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter country visited">
            </div>
            <div class="mt-2">
                <label for="europe_date_arrived" class="block text-sm font-medium text-gray-700">Date Arrived</label>
                <input v-model="formStore.student.europe_date_arrived" type="date" id="europe_date_arrived"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
            <div class="mt-2">
                <label for="europe_purpose_of_visit" class="block text-sm font-medium text-gray-700">Purpose of
                    visit</label>
                <input v-model="formStore.student.europe_purpose_of_visit" type="text" id="europe_purpose_of_visit"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter purpose of visit">
            </div>
            <div class="mt-2">
                <label for="europe_length_of_stay" class="block text-sm font-medium text-gray-700">Length of stay
                    (dd/wks/yrs)</label>
                <input v-model="formStore.student.europe_length_of_stay" type="text" id="europe_length_of_stay"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter length of stay">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <h3 class="text-md font-medium text-red-700">Australia, Canada, New Zealand, USA</h3>
            <div class="mt-2">
                <label for="acnz_usa_country_visited" class="block text-sm font-medium text-gray-700">Country
                    Visited</label>
                <input v-model="formStore.student.acnz_usa_country_visited" type="text" id="acnz_usa_country_visited"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter country visited">
            </div>
            <div class="mt-2">
                <label for="acnz_usa_date_arrived" class="block text-sm font-medium text-gray-700">Date Arrived</label>
                <input v-model="formStore.student.acnz_usa_date_arrived" type="date" id="acnz_usa_date_arrived"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
            <div class="mt-2">
                <label for="acnz_usa_purpose_of_visit" class="block text-sm font-medium text-gray-700">Purpose of
                    visit</label>
                <input v-model="formStore.student.acnz_usa_purpose_of_visit" type="text" id="acnz_usa_purpose_of_visit"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter purpose of visit">
            </div>
            <div class="mt-2">
                <label for="acnz_usa_length_of_stay" class="block text-sm font-medium text-gray-700">Length of stay
                    (dd/wks/yrs)</label>
                <input v-model="formStore.student.acnz_usa_length_of_stay" type="text" id="acnz_usa_length_of_stay"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter length of stay">
            </div>
        </div>



        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <h3 class="text-md font-medium text-red-700">Rest of the World</h3>
            <div class="mt-2">
                <label for="row_country_visited" class="block text-sm font-medium text-gray-700">Country Visited</label>
                <input v-model="formStore.student.row_country_visited" type="text" id="row_country_visited"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter country visited">
            </div>
            <div class="mt-2">
                <label for="row_date_arrived" class="block text-sm font-medium text-gray-700">Date Arrived</label>
                <input v-model="formStore.student.row_date_arrived" type="date" id="row_date_arrived"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
            <div class="mt-2">
                <label for="row_purpose_of_visit" class="block text-sm font-medium text-gray-700">Purpose of
                    visit</label>
                <input v-model="formStore.student.row_purpose_of_visit" type="text" id="row_purpose_of_visit"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter purpose of visit">
            </div>
            <div class="mt-2">
                <label for="row_length_of_stay" class="block text-sm font-medium text-gray-700">Length of stay
                    (dd/wks/yrs)</label>
                <input v-model="formStore.student.row_length_of_stay" type="text" id="row_length_of_stay"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter length of stay">
            </div>
        </div>
    </div>
</template>