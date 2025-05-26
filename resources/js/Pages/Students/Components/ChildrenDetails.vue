<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { computed } from 'vue';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();
const childrens = computed(() => formStore.student.childrenDetails);

const addCh = () => {
    formStore.addChild();
};

const removeCh = (index) => {
    formStore.removeChild(index);
};
</script>

<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            YOUR CHILDREN (IRRESPECTIVE OF AGE)
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div v-for="(child, index) in childrens" :key="index" class="col-span-12">
            <div class="col-span-12 mb-2 relative border p-4 rounded-lg shadow-md bg-white mt-2">

                <!-- Full-width Heading -->
                <h3 class="text-lg font-medium text-red-700 col-span-12 w-full">Child {{ index + 1 }}</h3>

                <!-- Action Buttons (Keep Absolute) -->
                <div class="absolute top-1 right-1 flex space-x-2">
                    <button type="button" @click="addCh" class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
                    <button @click="removeCh(index)" type="button" v-if="childrens.length > 1"
                        class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>
                </div>

                <!-- Form Fields Container -->
                <div class="w-full mt-1">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input v-model="child.child_full_name" type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Enter full name">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select v-model="child.child_gender"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option value="" disabled>Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input v-model="child.child_dob" type="date"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Place of Birth</label>
                            <input v-model="child.child_place_of_birth" type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Enter place of birth">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Nationality</label>
                            <input v-model="child.child_nationality" type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Enter nationality">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Accompanying to UK</label>
                            <select v-model="child.child_accompanying_uk"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Current Address</label>
                            <input v-model="child.child_current_address" type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Enter current address">
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Passport Number</label>
                            <input v-model="child.child_passport_number" type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                placeholder="Enter passport number">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>
