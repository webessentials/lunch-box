<template>
    <div>
      <div class="nav-sticky navbar navbar-expand navbar-light bg-white">
        <h4 class="ml-2 mb-0">Welcome</h4>
          <button class="btn btn-primary ml-auto" @click="$router.push('/login')" v-if="!checkToken()">Login</button>
          <template v-else>
              <ul class="navbar-nav mt-2 mt-md-0 ml-auto">
                  <li class="nav-item" v-if="isAdmin()">
                      <a class="nav-link" href="javascript:;" @click="$router.push('/dashboard')">
                          <svg class="bi bi-grid" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M9.5 4.5a1 1 0 00-1-1h-4a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4zm-1 7h-4v4h4v-4zm7 0h-4v4h4v-4zm0-7h-4v4h4v-4zm-7 0h-4v4h4v-4zm2 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4zm-6 6a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1h-4zm7 0a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1h-4z" clip-rule="evenodd"></path>
                          </svg>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="javascript:;" @click="logout">
                          <svg class="bi bi-box-arrow-right" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M13.646 13.354a.5.5 0 010-.708L16.293 10l-2.647-2.646a.5.5 0 01.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd"></path>
                              <path fill-rule="evenodd" d="M6.5 10a.5.5 0 01.5-.5h9a.5.5 0 010 1H7a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                              <path fill-rule="evenodd" d="M4 15.5A1.5 1.5 0 012.5 14V6A1.5 1.5 0 014 4.5h7A1.5 1.5 0 0112.5 6v1.5a.5.5 0 01-1 0V6a.5.5 0 00-.5-.5H4a.5.5 0 00-.5.5v8a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V14a1.5 1.5 0 01-1.5 1.5H4z" clip-rule="evenodd"></path>
                          </svg>
                      </a>
                  </li>
              </ul>
          </template>

      </div>
      <div class="container mt-4">
          <div class="w-100 text-center" v-if="loading">
              <div class="spinner-border text-center" role="status">
                  <span class="sr-only">Loading...</span>
              </div>
          </div>
          <div class="d-block" v-else-if="!foods.length">
              <div class="alert alert-warning text-center">
                  <h3>Sorry there's no food yet</h3>
              </div>
              <img src="/images/sad.jpg" class="img-fluid">
          </div>
          <template v-else>
              <template v-if="yourFoods.length > 0">
                  <h2>You ordered:</h2>
                  <div class="card mb-3 p-3" v-for="order in yourFoods">
                      <template v-for="order_detail in order.order_details">
                          <h5>{{order_detail.food.name}}&nbsp;(<b class="text-danger">$ {{order_detail.unit_price}}</b>)</h5>
                          <p>Quantity:&nbsp;{{order_detail.quantity}}
                              <span class="d-block">Price:&nbsp;$ {{order_detail.quantity * order_detail.unit_price}}</span>
                          </p>
                          <div>
                              <button class="btn btn-primary btn-block" @click.prevent="cancelOrder(order.id)">Cancel</button>
                          </div>
                      </template>
                  </div>
              </template>
              <h3>Food today:</h3>
              <div class="card mb-3 p-3" v-for="food in foods">
                  <div class="row">
                      <div class="col-md-4">
                          <img class="img-fluid" :src="food.food.picture" alt="Img">
                      </div>
                      <div class="col-md-4">
                          <div class="card-body pt-md-0">
                              <h5>{{food.food.name}} (<b class="text-danger"> ${{food.food.price}} </b>)</h5>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <button class="btn btn-primary btn-block" @click="$router.push('/ordering/'+food.food.id)" v-if="checkToken()">Order</button>
                      </div>
                  </div>
              </div>
          </template>
      </div>
    </div>
</template>

<script>
    import Logout from '../mixins/logout.vue';
    import User from '../mixins/user';
    export default {
        data() {
            return {
                foods: [],
                yourFoods: [],
                loading: false
            }
        },
        mixins: [Logout, User],
        methods: {
            checkToken() {
              return !!window.localStorage.getItem('user_token');
            },
            fetchFoods() {
                this.loading = true;
                axios.get('/api/schedule/today')
                .then(res => {
                    this.foods = res.data;
                    this.loading = false;
                })
                .catch(err => console.log(err));
            },
            getOrderList() {
                this.loading = true;
                axios.get('/api/orders/user-today')
                .then(res => {
                    this.yourFoods = res.data;
                })
                .catch(err => console.log(err));
            },
            cancelOrder: function(id) {
                const instance = this;
                axios.post('/api/orders/cancel', {
                    id,
                }).then(response => {
                    let index = instance.yourFoods.findIndex(f => parseInt(f.id) === parseInt(id));
                    if (index !== -1) instance.yourFoods.splice(index, 1);
                })
            }
        },
        mounted() {
            if (this.checkToken()) {
                this.getOrderList();
            }

            this.fetchFoods();
        }
    }
</script>
