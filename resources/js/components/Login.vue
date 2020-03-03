<template>
  <div>
    <div class="nav-sticky navbar navbar-expand navbar-light bg-white">
      <span class="btn-link" @click="$router.push('/')">
          <svg class="bi bi-chevron-left" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.354 3.646a.5.5 0 010 .708L7.707 10l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
            </svg>
      </span>
      <h4 class="ml-1 mb-0">Login</h4>
      <button class="btn btn-primary ml-auto" @click="$router.push('/registration')">Register</button>
    </div>

      <div class="container mt-4">
          <form class="card mb-3 p-3">
              <div class="container mt-4">
                  <div class="d-inline-flex w-100 mb-4 justify-content-center">
                      <div class="logo mr-3">
                          <img src="/images/logo.png" alt="logo" class="img-fluid">
                      </div>
                      <h3 class="text-center mt-3">Lunch Box</h3>
                  </div>
                  <div class="form-group">
                      <label for="inputEmail">Email address</label>
                      <input type="text" class="form-control" :class="{ 'is-invalid' : errors.emptyEmail || errors.invalidEmail }" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter your email" v-model="email">
                      <div class="invalid-feedback" v-if="errors.emptyEmail">
                          Enter your email address.
                      </div>
                      <div class="invalid-feedback" v-if="errors.invalidEmail">
                          Invalid email address.
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputPassword">Password</label>
                      <input type="password" class="form-control" :class="{ 'is-invalid' : errors.password || errors.shortPassword }" id="inputPassword" placeholder="Password" v-model="password">
                      <div class="invalid-feedback" v-if="errors.password">
                          Enter your password.
                      </div>
                      <div class="invalid-feedback" v-if="errors.shortPassword">
                          Password must be more than 6 characters.
                      </div>
                  </div>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                  </div>
              </div>
          </form>
      </div>
      <div class="sticky-footer">
          <button type="button" @click="checkForm" class="btn btn-primary btn-block mt-4">Login</button>
      </div>
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
        } else if (this.password.length < 6) {
          this.errors.shortPassword = true;
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
        axios.post('api/login', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          if (response.status === 200) {
              const isAdmin = response.data.role === 'admin';
              localStorage.setItem('user_token', response.data.token);
              localStorage.setItem('is_admin', isAdmin);
              axios.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
              if (isAdmin) {
                  this.$router.push('/dashboard');
              } else {
                  this.$router.push('/');
              }
          }
        })
      }
    }
  }
</script>

<style>
    .logo {
        width: 60px;
        height: 60px;
    }
</style>
