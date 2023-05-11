<template>
  <div>
    coucou
  </div>
</template>

<script>
  export default {
    name: 'Test',
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
    methods: {
      test() {
        console.log('test')
      }
    },
    mounted() {
      this.test()
    }
  }
</script>