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
            MAIN APPLICANT’S CONTACT DETAILS IN COUNTRY OF APPLICATION:</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea v-model="formStore.student.address" id="address" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter address"></textarea>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal/Zip Code</label>
            <input v-model="formStore.student.postal_code" type="text" id="postal_code"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter zip code" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="how_long_lived" class="block text-sm font-medium text-gray-700">How Long Have You Lived at This
                Address?</label>
            <input v-model="formStore.student.how_long_lived" type="text" id="how_long_lived"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="How Long Have You Lived at This Address?">
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="home_number" class="block text-sm font-medium text-gray-700">Home (Landline) Number</label>
            <input v-model="formStore.student.home_number" type="text" id="home_number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Landline number" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
            <input v-model="formStore.student.mobile_number" type="text" id="mobile_number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Mobile number" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input v-model="formStore.student.email_address" type="email" id="email_address"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Email address" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label class="block text-sm font-medium text-gray-700">Will this be your contact details during the
                application process?</label>
            <div class="mt-2 flex items-center">
                <input v-model="formStore.student.contact_during_application" type="radio" id="contact_yes" value="Yes"
                    class="focus:ring-red-500 h-4 w-4 text-red-500 border-gray-300">
                <label for="contact_yes" class="ml-3 block text-sm font-medium text-gray-700">Yes</label>
                <input v-model="formStore.student.contact_during_application" type="radio" id="contact_no" value="No"
                    class="focus:ring-red-500 h-4 w-4 text-red-500 border-gray-300 ml-6">
                <label for="contact_no" class="ml-3 block text-sm font-medium text-gray-700">No</label>
            </div>

        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="main_address_uk" class="block text-sm font-medium text-gray-700">Main address and contact
                details of where you will be staying whilst in the UK</label>
            <textarea v-model="formStore.student.main_address_uk" id="main_address_uk" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Main address and contact detail"></textarea>
        </div>
        <div class="col-span-6 sm:col-span-6 md:col-span-6">
            <label for="ownership_status" class="block text-sm font-medium text-gray-700">What is the ownership status
                of your home?</label>
            <select v-model="formStore.student.ownership_status" id="ownership_status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Select</option>
                <option value="Owned">Owned</option>
                <option value="Rented">Rented</option>
                <option value="Live with family">Live with family</option>
            </select>
        </div>


    </div>
</template>