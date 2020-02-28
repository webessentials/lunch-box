<template>
    <div>
      <div class="status-bar align-items-center">
        <h4 class="ml-4 mb-0">Home</h4>
        <button class="btn btn-primary ml-auto" @click="$router.push('/login')" v-if="!checkToken()">Login</button>
        <button class="btn btn-primary ml-auto" @click="$router.push('/login')" v-else>Logout</button>
      </div>
      <div class="container mt-4">
          <div class="d-block" v-if="!foods.length">
              <div class="alert alert-warning text-center">
                  <h3>Sorry there's no food yet</h3>
              </div>
              <img src="/image/sad.jpg" class="img-fluid">
          </div>
          <div v-else class="card mb-3 p-3" v-for="food in foods">
              <div class="row">
                  <div class="col-md-4">
                      <img class="img-fluid" :src="food.picture" alt="Img">
                  </div>
                  <div class="col-md-4">
                      <div class="card-body pt-md-0">
                          <h5>{{food.name}} (<b class="text-danger"> ${{food.price}} </b>)</h5>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <button class="btn btn-primary btn-block" @click="$router.push('/ordering/'+food.id)" v-if="checkToken()">Order</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                foods: []
            }
        },
        methods: {
            checkToken() {
              return !!window.localStorage.getItem('user_token');
            },
            fetchFoods() {
                if (this.checkToken()) {
                    axios.get('api/food-schedule/today')
                    .then(res => {
                        this.foods = res.data;
                    })
                    .catch(err => console.log(err));
                }
            },
            getOrderList() {

            }
        },
        created() {
            this.fetchFoods();
            this.getOrderList();
        }
    }
</script>
