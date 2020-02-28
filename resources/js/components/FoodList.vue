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
          <button class="btn btn-primary" @click="addToMenu(food.id)" v-if="!checkIfInTodayList(food.id)">Add to today menu</button>
          <button class="btn btn-danger" @click="removeFromMenu(food.id)" v-else>Remove from menu</button>
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
      this.fetchTodayMenu()
    },
    methods: {
      fetchFoods() {
        axios.get('api/foods')
        .then(response => {
          this.foodList = response.data.data
        })
      },
      fetchTodayMenu() {
        this.todayMenu = []
        axios.get('api/food-schedule/today')
        .then(response => {
          if (response.data.schedules.length) {
            response.data.schedules.forEach(food => {
              this.todayMenu.push(food.food_id)
            })
          }
        })
      },
      addToMenu(id) {
        let date = new Date()
        let currentMonth = parseInt(date.getMonth()) + 1
        let currentDate = date.getFullYear() + '-' + currentMonth + '-' + date.getDate();
        axios.post('api/schedules', {
          date: currentDate,
          food_id: id
        }).then(response => {
          if (response.status === 201) {
            console.log('OK');
          }
        })
      },
      removeFromMenu(id) {
        console.log('Remove from menu')
      },
      checkIfInTodayList(id) {
        return this.todayMenu.includes(id)
      }
    }
  }
</script>
