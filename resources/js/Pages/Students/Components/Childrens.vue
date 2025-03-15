<script setup>
import { useStudentStore } from '@/Stores/studentStore';
import { computed } from 'vue';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

const children = computed(() => formStore.student.Children);
</script>

<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            YOUR CHILDREN (IRRESPECTIVE OF AGE)
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div v-for="(child, index) in children" :key="index" class="col-span-12">
            <div class="col-span-12 mb-4 flex justify-between items-center">
                <h3 class="text-lg font-medium text-red-700">Child {{ index + 1 }}</h3>
                <div>
                    <button type="button" @click="formStore.removeChild(index)"
                        class="text-red-500 border border-red-700 rounded-lg p-2">-</button>
                    <button type="button" @click="formStore.addChild"
                        class="text-red-500 border border-red-700 rounded-lg p-2">+</button>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <label :for="'child' + (index + 1) + '_full_name'"
                        class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input v-model="child.full_name" :id="'child' + (index + 1) + '_full_name'" type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                        placeholder="Enter full name">
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <label :for="'child' + (index + 1) + '_gender'"
                        class="block text-sm font-medium text-gray-700">Gender</label>
                    <select v-model="child.gender" :id="'child' + (index + 1) + '_gender'"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        <option value="" disabled>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <label :for="'child' + (index + 1) + '_dob'" class="block text-sm font-medium text-gray-700">Date of
                        Birth</label>
                    <input v-model="child.dob" :id="'child' + (index + 1) + '_dob'" type="date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                </div>
            </div>
        </div>
    </div>
</template>