<template>
  <div>
    <div class="status-bar align-items-center">
      <span @click="$router.push('/dashboard')">Back</span>
      <h4 class="ml-4 mb-0">Food List</h4>
    </div>
    <div class="container mt-4">
      <ul class="list-group">
        <li v-for="food in foodList" class="list-group-item d-flex justify-content-between align-items-center">
          {{ food.name }}
          <span class="badge badge-danger badge-pill">${{ food.price }}</span>
          <button class="btn btn-primary" @click="addToMenu(food.id)">Add to today menu</button>
        </li>
      </ul>
    </div>
    <div class="sticky-footer">
      <button class="btn btn-primary btn-block">Create food</button>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        foodList: [],
        todayMenu: []
      }
    },
    mounted() {
      this.fetchFoods()
    },
    methods: {
      fetchFoods() {
        axios.get('api/foods')
        .then(response => {
          this.foodList = response.data.data
        })
      },
      fetchTodayMenu() {

      },
      addToMenu(id) {
        let date = new Date()
        let currentDate = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
        axios.post('api/schedules', {
          date: currentDate,
          food_id: id
        }).then(response => {
          if (response.status === 201) {
            console.log('OK');
          }
        })
      }
    }
  }
</script>
