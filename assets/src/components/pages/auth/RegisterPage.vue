<template>
  <div class="container has-text-centered">
    <div class="column is-4 is-offset-4">
      <h3 class="title has-text-black">S'enregistrer</h3>
      <router-link to="/">Revenir à la Page d'Accueil</router-link>
      <hr class="login-hr" />
      <p class="subtitle has-text-black">Merci de vous enregistrer pour continuer.</p>
      <div class="box">
        <authPopup
          v-show="register.email.error.is"
          :message="register.email.error.message"
          v-model="register.email.error.is"
        />
        <authPopup
          v-show="register.password.error.is"
          :message="register.password.error.message"
          v-model="register.password.error.is"
        />
        <authPopup
          v-show="register.passwordRepeat.error.is"
          :message="register.passwordRepeat.error.message"
          v-model="register.passwordRepeat.error.is"
        />
        <authPopup
          v-show="register.acceptTerms.error.is"
          :message="register.acceptTerms.error.message"
          v-model="register.acceptTerms.error.is"
        />

        <form>
          <div class="field">
            <div class="control">
              <inputTextField
                :placeholder="register.email.placeholder"
                :className="register.email.className"
                :type="register.email.inputType"
                v-model="register.email.val"
              />
            </div>
          </div>

          <div class="field">
            <div class="control">
              <inputTextField
                :placeholder="register.password.placeholder"
                :className="register.password.className"
                :type="register.password.inputType"
                v-model="register.password.val"
              />
            </div>
          </div>

          <div class="field">
            <div class="control">
              <inputTextField
                :placeholder="register.passwordRepeat.placeholder"
                :className="register.passwordRepeat.className"
                :type="register.passwordRepeat.inputType"
                v-model="register.passwordRepeat.val"
              />
            </div>
          </div>

          <div class="field">
            <label
              class="checkbox"
              @click.prevent="register.acceptTerms.toggle"
              style="user-select: none"
            >
              <input
                type="checkbox"
                v-model="register.acceptTerms.val"
                true-value="true"
                false-value="false"
                style="pointer-events: none"
              />
              Accepter
            </label>

            <routerLink to="/conditions-generales">
              Conditions Générales Utilisateur</routerLink
            >
          </div>
          <button
            class="button is-block is-info is-large is-fullwidth"
            @click.prevent="submitForm"
          >
            Envoyer <i class="fa fa-sign-in" aria-hidden="true"></i>
          </button>
        </form>
      </div>
      <p class="has-text-grey">
        <routerLink to="/connexion">Se Connecter</routerLink> &nbsp;·&nbsp;
        <routerLink to="/mot-de-passe-oublie">Mot de Passe Oublié</routerLink>
      </p>
    </div>
  </div>
</template>

<script>
import { onUnmounted } from "vue";
//import { useStore } from "vuex";

import registerModel from "../../../models/auth/registerModel.js";

import inputTextField from "../../ui/inputTextField.vue";
import authPopup from "../../ui/authPopup.vue";

export default {
  components: { inputTextField, authPopup },

  setup() {
    //const store = useStore();
    const register = registerModel;

    function resetErrors() {
      register.email.error.is = false;
      register.password.error.is = false;
      register.passwordRepeat.error.is = false;
      register.acceptTerms.error.is = false;
    }

    function submitForm() {
      resetErrors();
      if (register.email.isValid()) {
        if (register.password.isValid()) {
          if (register.password.val === register.passwordRepeat.val) {
            if (register.acceptTerms.val === true) {
              /* const payload = {
                email: register.email.val,
                password: register.password.val,
              }; */
              console.log("TODO: dispatch request for register");
            } else {
              register.acceptTerms.error.is = true;
            }
          } else {
            register.passwordRepeat.error.is = true;
          }
        } else {
          register.password.val = "";
          register.password.error.is = true;
        }
      } else {
        register.email.error.is = true;
        register.email.val = "";
      }
    }

    onUnmounted(() => {
      resetErrors();
    });

    return {
      submitForm,
      register,
    };
  },
};
</script>

<style scoped>
#register {
  padding-top: 3em;
}
</style>
