<template>
  <div>
    <!-- Your dashboard content goes here -->
    
    <footer class="footer mt-auto py-3">
      <div class="container text-center">
        <div class="h-100 d-flex align-center justify-md-space-between justify-center">
          <span class="d-flex align-center">
            &copy;
            {{ currentYear }}
            Copyright 2025
            <a
              href="https://zalinukconsultants.com"
              target="_blank"
              rel="noopener noreferrer"
              class="text-primary ms-1 text-red-600 uppercase"
            >zalinukconsultants</a>
          </span>
         All right reserved
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
};
</script>
