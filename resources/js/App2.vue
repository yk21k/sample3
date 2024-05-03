<template>
  <div class="page">
    <p>{{ counter }}</p>
    <button @click="counter += 1">
      click!
    </button>
  </div>
 </template>

 <script>
 export default {
  data () {
    return {
      counter: 0,
    }
  },
 }
 </script>
