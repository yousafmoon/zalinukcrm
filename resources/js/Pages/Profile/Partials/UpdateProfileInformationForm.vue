<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const flashMessage = ref('');
const isUploading = ref(false);
const selectedFile = ref(null);

const user = usePage().props.auth.user;
const form = useForm({
    name: user.name,
    email: user.email,
    image: user.image,
});

const defaultImage = "/images/profile-pic.jpg";
const imageSrc = ref(user.image || defaultImage);
console.log(imageSrc.value);

const handleProfileUpdate = () => {
    form.patch(route("profile.update"), {
        onSuccess: () => {
            flashMessage.value = "Profile updated successfully!";
        },
    });
};

const uploadImage = async (event) => {
    const file = event.target.files[0];
    if (file) {
        if (!file.type.startsWith("image/")) {
            flashMessage.value = "Please upload a valid image.";
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            flashMessage.value = "File size exceeds 2MB.";
            return;
        }
        selectedFile.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imageSrc.value = e.target.result; 
        };
        reader.readAsDataURL(file);
    }
};

const handleImageSubmit = async () => {
    if (!selectedFile.value) {
        flashMessage.value = "Please select an image first.";
        return;
    }

    const formData = new FormData();
    formData.append("image", selectedFile.value);
    isUploading.value = true;

    try {
        const response = await axios.post(route("profile.upload-image"), formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        if (response.data.message) {
            flashMessage.value = response.data.message;
            imageSrc.value = `/storage/${response.data.image_url}?v=${Date.now()}`;

            console.log('Updated image source:', imageSrc.value);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    } catch (error) {
        flashMessage.value = "Image upload failed.";
        console.error(error.response?.data || error);
    } finally {
        isUploading.value = false;
    }
};
</script>

<template>
  <div class="grid grid-cols-2 col-span-2 gap-6">
    <form @submit.prevent="handleProfileUpdate" class="mt-6 space-y-6">
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
        />
        <InputError :message="form.errors.name" />
      </div>

      <div>
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />
        <InputError :message="form.errors.email" />
      </div>
      <PrimaryButton :disabled="form.processing">Save Profile</PrimaryButton>
    </form>

    <div class="mt-6 flex flex-wrap flex-col justify-center items-center">
      <img
        class="h-56 w-56 mt-0 rounded-full bg-gray-300 ring-green-600 shadow-lg drop-shadow-sm transition ring-1"
        :src="imageSrc || defaultImage"
        alt="Profile Picture"
      />

      <label class="mt-5"> 
        <input
          type="file"
          accept="image/*"
          class="hidden"
          @change="uploadImage"
        />
        <span class="cursor-pointer bg-green-700 text-white px-7 py-2 rounded mt-3">
          Select Image
        </span>
      </label>

      <span
        @click="handleImageSubmit"
        :class="{
          'cursor-not-allowed bg-gray-400': isUploading,
          'cursor-pointer bg-orange-600': !isUploading,
        }"
        class="text-white px-6 py-1 rounded mt-3"
        :disabled="isUploading"
      >
        {{ isUploading ? "Uploading..." : "Upload Image" }}
      </span>

      <p v-if="flashMessage" class="mt-3 text-green-500">{{ flashMessage }}</p>
    </div>
  </div>
</template>
