<template>
   <div>
     <h2>Items</h2>
    <form @submit.prevent="addItem" class="mb-3">
      
      <div class="form-group">
        <input type="text" class="  w-full p-2 rounded-lg" placeholder="Title" v-model="item.title">
      </div>

      <div class="form-group">
        <textarea placeholder="Body" row="5" class="border-1 w-full p-4 rounded-lg"  v-model="item.body"></textarea>
      </div>

        <div class="form-group">
        <input type="file">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Save</button>
    </form>

  <!--  -->


     <div v-for="item in items" :key="item.id">
         <div class="px-4">
      <div class="max-w-3xl bg-white rounded-lg mx-auto my-16 p-16">
        <h1 class="text-2xl font-medium mb-2">{{item.title}}</h1>
        <h2 class="font-medium text-sm text-indigo-400 mb-4 uppercase tracking-wide"></h2>
        {{item.body}}
        <button @click="deleteItem(item.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 pull-right rounded">Delete</button>
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
         item: {
           id: '',
           user_id: '',
           title: '',
           body: '',
           image:''
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
            this.items = res.data;
            vm.makePagination(res.meta, res.links);
            console.log(res.data)
          })
          .catch(err => console.log(err));
        },
           makePagination(meta, links) {
         let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
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
