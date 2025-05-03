<script setup>
import { ref, computed, watchEffect } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { defineAbilitiesFor } from '@/Pages/Services/ability';

const props = defineProps({ image: String });
const emit = defineEmits(['imageUploaded']);

const page = usePage();
const authUser = computed(() => page.props.auth?.user || null);
const defaultImage = "/assets/images/profile-pic.jpg";
const imageSrc = ref(defaultImage);

watchEffect(() => {
  imageSrc.value = authUser.value?.image || defaultImage;
});

const roles = computed(() => (authUser.value?.roles?.map(role => role.name) || ['Guest']));
const abilities = computed(() => defineAbilitiesFor(roles.value));
const showingNavigationDropdown = ref(false);
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="border-b border-gray-100 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <div class="flex shrink-0 items-center">
              <Link :href="route('dashboard')">
              <ApplicationLogo class="block h-12 w-25 fill-current text-gray-500" />
              </Link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <NavLink v-if="abilities.can('view', 'Dashboard')" :href="route('dashboard')"
                :active="route().current('dashboard')">
                Dashboard
              </NavLink>
              <NavLink v-if="abilities.can('view', 'Students')" :href="route('students.index')"
                :active="route().current('students.index')">
                Students
              </NavLink>
            </div>
          </div>

          <!-- User Menu -->
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <Dropdown align="right" width="48">
              <template #trigger>
                <button class="flex items-center space-x-2 px-2 py-1 text-sm font-medium text-gray-500">
                  <img class="h-10 w-10 rounded-full bg-gray-300" :src="imageSrc" alt="Profile Picture" />
                  <span>{{ authUser?.name }}</span>
                  <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </button>
              </template>
              <template #content>
                <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                <DropdownLink v-if="abilities.can('view', 'Permissions')" :href="route('permissions.index')">Permissions
                </DropdownLink>
                <DropdownLink v-if="abilities.can('view', 'Roles')" :href="route('roles.index')">Roles</DropdownLink>
                <DropdownLink v-if="abilities.can('view', 'Users')" :href="route('users.index')">Users</DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
              </template>
            </Dropdown>
          </div>

          <!-- Mobile Menu Toggle -->
          <div class="-mr-2 flex items-center sm:hidden">
            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="p-2 rounded-md text-gray-400 hover:bg-gray-100 focus:outline-none">
              <svg class="h-6 w-6" v-if="!showingNavigationDropdown" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg class="h-6 w-6" v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div v-show="showingNavigationDropdown" class="sm:hidden">
        <ResponsiveNavLink v-if="abilities.can('view', 'Dashboard')" :href="route('dashboard')">Dashboard
        </ResponsiveNavLink>
        <ResponsiveNavLink v-if="abilities.can('view', 'Students')" :href="route('students.index')">Students
        </ResponsiveNavLink>
        <ResponsiveNavLink v-if="abilities.can('view', 'Permissions')" :href="route('permissions.index')">Permissions
        </ResponsiveNavLink>
        <ResponsiveNavLink v-if="abilities.can('view', 'Roles')" :href="route('roles.index')">Roles</ResponsiveNavLink>
        <ResponsiveNavLink v-if="abilities.can('view', 'Users')" :href="route('users.index')">Users</ResponsiveNavLink>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <slot />
    </main>
  </div>
</template>