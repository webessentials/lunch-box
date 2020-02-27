<template>
  <div class="container">
    <h3 class="text-center mb-4">Lunch Box</h3>

    <form  @submit="checkForm">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="text" class="form-control" :class="{ 'is-invalid' : errors.emptyEmail || errors.invalidEmail }" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
          <div class="invalid-feedback" v-if="errors.emptyEmail">
            Enter your email address.
          </div>
          <div class="invalid-feedback" v-if="errors.invalidEmail">
            Invalid email address.
          </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" :class="{ 'is-invalid' : errors.password }" id="exampleInputPassword1" placeholder="Password" v-model="password">
          <div class="invalid-feedback">
            Enter your password.
          </div>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
      </form>
    </div>
</template>

<script>
  export default  {
    data() {
      return {
        errors: {},
        email: '',
        password: ''
      }
    },
    mounted() {

    },
    methods: {
      checkForm(e) {
        this.errors = {};

        if (!this.email) {
          this.errors.emptyEmail = true;
        } else if (!this.validEmail(this.email)) {
          this.errors.invalidEmail = true;
        }

        if (!this.password) {
          this.errors.password = true;
        }

        if (!Object.entries(this.errors).length) {
          this.checkAuthentication();
        }

        e.preventDefault();
      },
      validEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      },
      checkAuthentication() {
        this.$router.push('/foo');
      }
    }
  }
</script>
