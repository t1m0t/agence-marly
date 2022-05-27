<template>
  <div class="file is-info">
    <label class="file-label">
      <input
        class="file-input"
        type="file"
        name="file"
        accept="text/csv"
        @change="uploadFile"
      />
      <span class="file-cta">
        <span class="file-icon">
          <font-awesome-icon :icon="['fas', 'file-upload']" />
        </span>
        <span class="file-label"> Choose a file… </span>
      </span>
    </label>
  </div>
</template>

<script>
//for icones
import { library } from "@fortawesome/fontawesome-svg-core";
import { faFileUpload } from "@fortawesome/free-solid-svg-icons";
export default {
  setup(props, { emit }) {
    // for icons
    library.add(faFileUpload);

    function uploadFile(e) {
      emit("update:modelValue", e.target.files);
    }

    return {
      uploadFile,
    };
  },
};
</script>