<template>
    <div>
      <div class="status-bar align-items-center">
        <h4 class="ml-4 mb-0">Home</h4>
        <button class="btn btn-primary ml-auto" @click="$router.push('/login')">Login</button>
      </div>
      <div class="container mt-4">
          <div class="card mb-3 p-3" v-for="food in foods">
              <div class="row">
                  <div class="col-md-4">
                      <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Good_Food_Display_-_NCI_Visuals_Online.jpg/1200px-Good_Food_Display_-_NCI_Visuals_Online.jpg" alt="Img">
                  </div>
                  <div class="col-md-6">
                      <div class="card-body">
                          <h5>{{food.name}} (<b class="text-danger"> ${{food.price}} </b>)</h5>
                      </div>
                  </div>
                  <div class="col-md-2 align-items-center">
                      <button class="btn btn-primary btn-block" @click="onOrder">Order</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="sticky-footer">
        <button class="btn btn-primary btn-block" @click="$router.push('/foodlist')">Prepare menu</button>
      </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                foods: [{
                    userName: 'User1',
                    name: 'A',
                    price: 2
                },
                {
                    userName: 'User2',
                    name: 'B',
                    price: 3.5
                }]
            }
        },
        methods: {
            onOrder: function () {
                alert('Order form pop up');
            }
        }
    }
</script>
