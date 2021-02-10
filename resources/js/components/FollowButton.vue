<template>
    <div class="">

  <button  href="" class="inline-flex mb-2 ml-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="followUser"  v-text="buttonText"></button>

    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.follows,
            }
        },
        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                              alert("ごめんなさい。ログインしてください(T_T)");
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'フォロー中' : 'フォローする';
            }
        }
    }
</script>
