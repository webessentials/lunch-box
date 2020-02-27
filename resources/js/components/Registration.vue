<template>
  <div>
    <div class="status-bar align-items-center">
      <span @click="$router.push('/login')">Back</span>
      <h4 class="ml-4 mb-0">Registration</h4>
    </div>

    <form @submit="checkForm">
      <div class="container mt-4">
        <div class="form-group">
          <label for="inputName">Name</label>
          <input type="text" class="form-control" :class="{ 'is-invalid' : errors.emptyName }" id="inputName" aria-describedby="emailHelp" placeholder="Enter your name" v-model="name">
          <div class="invalid-feedback" v-if="errors.emptyName">
            Enter your name.
          </div>
        </div>
        <div class="form-group">
          <label for="inputPhoneNumber">Phone number</label>
          <input type="number" class="form-control" :class="{ 'is-invalid' : errors.emptyPhoneNumber }" id="inputPhoneNumber" aria-describedby="emailHelp" placeholder="Enter your phone number" v-model="phoneNumber">
          <div class="invalid-feedback" v-if="errors.emptyPhoneNumber">
            Enter your phone number.
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail">Email address</label>
          <input type="text" class="form-control" :class="{ 'is-invalid' : errors.emptyEmail || errors.invalidEmail }" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
          <div class="invalid-feedback" v-if="errors.emptyEmail">
            Enter your email address.
          </div>
          <div class="invalid-feedback" v-if="errors.invalidEmail">
            Invalid email address.
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" class="form-control" :class="{ 'is-invalid' : errors.emptyPassword || errors.shortPassword }" id="inputPassword" placeholder="Password" v-model="password">
          <div class="invalid-feedback" v-if="errors.emptyPassword">
            Enter your password.
          </div>
          <div class="invalid-feedback" v-if="errors.shortPassword">
            Password must be more than 6 characters.
          </div>
        </div>
        <div class="form-group">
          <label for="inputConfirmedPassword">Password</label>
          <input type="password" class="form-control" :class="{ 'is-invalid' : errors.emptyConfirmedPassword || errors.notMatchedConfirmedPassword }" id="inputConfirmedPassword" placeholder="Confirmed Password" v-model="confirmedPassword">
          <div class="invalid-feedback" v-if="errors.emptyConfirmedPassword">
            Enter your password.
          </div>
          <div class="invalid-feedback" v-if="errors.notMatchedConfirmedPassword">
            Password no matched.
          </div>
        </div>
      </div>
      <div class="sticky-footer">
        <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        errors: {},
        name: '',
        phoneNumber: '',
        email: '',
        password: '',
        confirmedPassword: ''
      }
    },
    methods: {
      checkForm(e) {
        this.errors = {};

        if (!this.name) {
          this.errors.emptyName = true;
        }

        if (!this.phoneNumber) {
          this.errors.emptyPhoneNumber = true;
        }

        if (!this.email) {
          this.errors.emptyEmail = true;
        } else if (!this.validEmail(this.email)) {
          this.errors.invalidEmail = true;
        }

        if (!this.password) {
          this.errors.emptyPassword = true;
        } else if (this.password.length < 6) {
          this.errors.shortPassword = true;
        }

        if (!this.confirmedPassword) {
          this.errors.emptyConfirmedPassword = true;
        } else if (this.password !== this.confirmedPassword) {
          this.errors.notMatchedConfirmedPassword = true;
        }

        if (!Object.entries(this.errors).length) {
          this.register();
        }

        e.preventDefault();
      },
      validEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      },
      register() {
        this.$router.push('/bar');
      }
    }
  }
</script>
