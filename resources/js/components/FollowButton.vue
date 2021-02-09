<template>
    <div class="">

  <button  href="" class="inline-flex mb-2 ml-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="followUser">Follow</button>

    </div>
</template>

<script>
    export default {
      props: ['userId'],

        mounted() {
            console.log('Component mounted.')
        },
        methods: {
          followUser () {
            axios.post('/follow/' + this.userId)
            .then(response => {
              alert(response.data);
            })
          }
        }
    }
</script>
