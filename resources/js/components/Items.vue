<template>
   <div>
     <h2>Items</h2>
     <form action="" @submit.prevent="addItem" >
       <div class="form-group">
      <input type="text" placeholder="Title" v-model="item.title">
        </div>
     </form>

       <form action="">
       <div class="form-group">
      <textarea type="text" placeholder="Body" v-model="item.body"></textarea>
        </div>
        <button type="submit" class="max-w-3xl bg-white rounded-lg mx-auto my-16 p-16">Save</button>
     </form>

     <div v-for="item in items" :key="item.id">
         <div class="px-4">
      <div class="max-w-3xl bg-white rounded-lg mx-auto my-16 p-16">
        <h1 class="text-2xl font-medium mb-2">{{item.title}}</h1>
        <h2 class="font-medium text-sm text-indigo-400 mb-4 uppercase tracking-wide"></h2>
        {{item.body}}
        <button @click="deleteItem(item.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >Delete</button>
      </div>
      
    </div>
     </div>
   </div>
</template>

<script>
    export default {
      data() {
       return {
         items: [],
         items: {
           id: '',
           title: '',
           body: ''
         },item_id: '',
         pagination: {},
         edit:false
       }
      },

      created() {
   this.fetchItems();
      },

      methods: {
        fetchItems(page_url) {
          let vm = this;
          page_url = page_url || 'api/items'
          fetch( page_url)
          .then(res => res.json())
          .then(res => {
            this.items = this.data;
            vm.makePagination(res.meta, res.links);
            console.log(res.data)
          })
          .catch(err => console.log(err));
        },
        deleteItem(id){
           if (confirm('Are you sure?')) {
             fetch(`api/item/${id}` , {
               method: 'delete'
             })
             .then (res => res.json())
             .then(data => {
               alert('Item removed');
               this.fetchItems();

             })
           } 
        },
        addItem(){
          if (this.edit === false) {
            fetch('api/item', {
              method: 'post',
              body:JSON.stringify(this.item),
              headers: {
                'content-type': 'application/json'
              }
            })
            .then(res => res.json())
            .then(data => {
              this.item.title ='';
              this.item.body ='';
              alert('Item Added');
              this.fetchItems();
            })
            .catch(err => console.log(err));
            
              } else {
        // Update
        fetch('api/item', {
          method: 'put',
          body: JSON.stringify(this.item),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Item Updated');
            this.fetchitems();
          })
          .catch(err => console.log(err));
      }
    },
    editItem(item) {
      this.edit = true;
      this.item.id = item.id;
      this.item.item_id = item.id;
      this.item.title = item.title;
      this.item.body = item.body;
    },
    clearForm() {
      this.edit = false;
      this.item.id = null;
      this.item.item_id = null;
      this.item.title = '';
      this.item.body = '';
    }
  }
};
</script>
