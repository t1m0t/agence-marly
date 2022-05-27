<template>
  <div class="container has-text-centered" id="forgot-password">
    <div class="column is-4 is-offset-4">
      <h3 class="title has-text-black">Mot de Passe Oublié</h3>
      <router-link to="/">Revenir à La Page d'Accueil</router-link>
      <hr class="login-hr" />
      <p class="subtitle has-text-black">Merci d'entrer votre Email pour continuer.</p>
      <div class="box">
        <authPopup
          v-show="recover.state.performed.is"
          :message="recover.state.performed.message"
          :class="popupClass"
        />

        <authPopup
          v-show="recover.email.error.is"
          :message="recover.email.error.message"
          v-model="recover.email.error.is"
        />

        <form>
          <div class="field">
            <div class="control">
              <inputTextField
                :placeholder="recover.email.placeholder"
                :className="recover.email.className"
                :type="recover.email.inputType"
                v-model.lazy="recover.email.val"
              />
            </div>
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
        <router-link to="/senregistrer">S'enregistrer</router-link> &nbsp;·&nbsp;
        <router-link to="/connexion">Se connecter</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import recoverModel from "../../../models/auth/recoverModel";
import ui from "../../ui/index";
export default {
  components: { authPopup: ui.authPopup, inputTextField: ui.inputTextField },
  setup() {
    const recover = recoverModel;
    const popupClass = "notification is-info";

    function resetErrors() {
      recover.email.error.is = false;
      recover.state.performed.is = false;
    }

    function submitForm() {
      resetErrors();
      if (recover.email.isValid() && !recover.state.performed.is) {
        recover.state.performed.is = true;
        /* const payload = {
          email: recover.email.val,
        }; */
        // TODO: dispatch request
        console.log("TODO: dispatch request for recover");
        return;
      } else {
        recover.email.error.is = true;
        recover.email.val = "";
      }
    }

    return {
      submitForm,
      recover,
      popupClass,
    };
  },
};
</script>

<style scoped>
#forgot-password {
  padding-top: 3em;
}
</style>