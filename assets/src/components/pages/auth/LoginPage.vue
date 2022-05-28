<template>
  <div class="container has-text-centered" id="login">
    <div class="column is-4 is-offset-4">
      <h3 class="title has-text-black">Formulaire de connexion</h3>
      <routerLink to="/">Revenir à la Page d'Accueil</routerLink>
      <hr class="login-hr" />
      <p class="subtitle has-text-black">Merci de vous connecter pour continuer.</p>
      <div class="box">
        <authPopup v-show="login.state.error.is" :message="login.state.error.message" v-model="login.state.error.is" />

        <authPopup v-show="login.email.error.is" :message="login.email.error.message" v-model="login.email.error.is" />

        <form>
          <div class="field">
            <div class="control">
              <inputTextField :placeholder="login.email.placeholder" :className="login.email.className"
                :type="login.email.inputType" v-model="login.email.val" />
            </div>
          </div>

          <div class="field">
            <div class="control">
              <inputTextField :placeholder="login.password.placeholder" :type="login.password.inputType"
                :className="login.password.className" v-model="login.password.val" />
            </div>
          </div>

          <div class="field">
            <label class="checkbox" @click.prevent="login.rememberMe.toggle" style="user-select: none">
              <input type="checkbox" v-model="login.rememberMe.val" true-value="true" false-value="false"
                style="pointer-events: none" />
              Se souvenir de moi
            </label>
          </div>
          <button class="button is-block is-info is-large is-fullwidth" @click.prevent="submitForm">
            Envoyer <i class="fa fa-sign-in" aria-hidden="true"></i>
          </button>
        </form>
      </div>
      <p class="has-text-grey">
        <routerLink to="/senregistrer">S'enregistrer</routerLink> &nbsp;·&nbsp;
        <routerLink to="/mot-de-passe-oublie">Mot de Passe Oublié</routerLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { onUnmounted } from "vue";
import { useRouter } from "vue-router";
import loginModel from "../../../models/auth/loginModel.js";

import ui from "../../ui/index";

const authPopup = ui.authPopup
const inputTextField = ui.inputTextField
const router = useRouter();

const testUser = {
  email: "test1@example.com",
  password: "password",
};

const login = loginModel;
login.email.val = testUser.email;
login.password.val = testUser.password;

function resetErrors() {
  login.email.error.is = false;
}

const redirect = router.currentRoute.value.query.redirect;

function submitForm() {
  resetErrors();
  if (login.email.isValid() && login.password !== null) {
    const payload = {
      username: login.email.val,
      password: login.password.val,
      rememberMe: login.rememberMe.val,
    };
    const res = axios.post('/auth/login', payload, {
      headers: {
        'content-type': 'application/json'
      }
    })

    if (res !== false) {
      if (redirect !== undefined) {
        router.push(redirect);
      } else {
        router.push("/");
      }
    } else {
      login.email.val = "";
      login.password.val = "";
      login.rememberMe.val = false;
      login.state.error.is = true;
    }
  } else {
    login.email.error.is = true;
    login.email.val = "";
  }
}

onUnmounted(() => {
  resetErrors();
});

</script>

<style scoped>
#login {
  padding-top: 3em;
}
</style>
