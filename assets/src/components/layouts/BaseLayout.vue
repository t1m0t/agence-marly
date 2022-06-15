<template>
  <div class="columns is-mobile">
    <div class="column is-full">
      <header v-if="headerEnabled">
        <HeaderLayout />
      </header>

      <body>
        <BodyLayout>
          <RouterView v-slot="{ Component }">
            <template v-if="Component">
              <Suspense>
                <component :is="Component"></component>
                <template #fallback>
                  Loading...
                </template>
              </Suspense>
            </template>
          </RouterView>
        </BodyLayout>
      </body>
      <footer>
        <FooterLayout>
          <router-view name="footer">
          </router-view>
        </FooterLayout>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from "vue-router";
import { watch, ref } from "vue";
import HeaderLayout from "./HeaderLayout.vue";
import BodyLayout from "./BodyLayout.vue";
import FooterLayout from "./FooterLayout.vue";

const displayMainNav = ref("");
function headerEnabled(metaValue) {
  if (metaValue === undefined) {
    return (displayMainNav.value = true);
  } else if (metaValue === false) {
    return (displayMainNav.value = false);
  } else {
    console.error(
      "DisplayMainNav need to be undefined or false, got: ",
      metaValue
    );
  }
}

watch(useRoute(), (val) => {
  headerEnabled(val.meta.displayMainNav);
});

</script>
