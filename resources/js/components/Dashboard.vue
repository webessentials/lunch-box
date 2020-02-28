<template>
  <div>
    <div class="status-bar align-items-center">
      <h4 class="ml-4 mb-0">Dashboard</h4>
      <button class="btn btn-primary ml-auto">Logout</button>
    </div>
    <div class="container mt-4">
      <div class="d-flex justify-content-center">
        <button class="btn btn-light btn-circle">
          15
        </button>
        <div class="ml-4">
          <button class="btn btn-success d-block truncate-text">
            7 Dishes: Fried lobster
          </button>
          <button class="btn btn-success d-block mt-4 truncate-text">
            8 Dishes: Chicken Soup
          </button>
        </div>
      </div>
      <ul class="list-group mt-5">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Cras justo odio
          <span class="badge badge-primary badge-pill">14</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Dapibus ac facilisis in
          <span class="badge badge-primary badge-pill">2</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Morbi leo risus
          <span class="badge badge-primary badge-pill">1</span>
        </li>
      </ul>
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

      }
    },
    mounted() {
      this.fetchOrders()
    },
    methods: {
      fetchOrders() {
        axios.get('/api/orders')
        .then(response => {
          console.log(response)
        })
      }
    }
  }
</script>
