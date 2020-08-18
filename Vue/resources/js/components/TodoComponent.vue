<template>
<div>
 <div class="d-flex justify-content-end"> 
<button class="btn btn-success col-2  m-3" @click="showCarrito"><i class="fas fa-cart-plus fa-md"></i><span class="bg-danger rounded-circle">{{listProduct.length}}</span></button>
</div>
<h1>Filtros</h1> 
 <div class="form-group">
      <input v-model="searchName" class="form-control" placeholder="Buscar Producto">
</div>
 <div class="row">
  <div class="col-lg-3 col-md-12 col-12">
    <div class="form-group">
            <label for="type">Categoria</label>
            <select  class="form-control" v-model="CategorieID"    >
             <option v-for="categorie in categories" :value="categorie.categori_id">{{categorie.name}}</option>  
            </select>
  </div>

   <div class="form-group">
            <label for="type">Producto Dispobibles</label>
            <select  class="form-control" v-model="available"    >
             <option :value="true">Dispobibles</option>  
             <option :value="false">Agotados</option>  
            </select>
    </div>
    <div class="form-group">
            <label for="type">Nivel de venta</label>
            <select  class="form-control" v-model="bestSeller" >
             <option :value="true">Mas Vendidos</option>  
             <option :value="false">Menos Venditos</option>  
            </select>
      </div>
    <div class="form-group">
            <label for="type">Rango de precio</label>
            <select  class="form-control" v-model="price"    >
             <option :value="30000">Mayor a 30,000</option>  
             <option :value="10000">Menor a 10,000</option>  
            </select>
      </div>
</div>
<div class="col-lg-9 col-12">
<h1 class="text-center"> Productos</h1>
<div class="row">

 <div class="col-md-4" v-for="todo in filteredProducts" :key="todo.id">
  <div class="card">
  <div class="card-body text-cener">
    <h5 class="card-title text-center">{{todo.name}}</h5>
    <img v-bind:src="todo.img">
    <p class="card-text text-success">{{todo.price}}</p>
    <p class="card-text">{{todo.description}}</p>
    <button  class="btn btn-primary" @click="addProduct(todo)">add</button>
  </div>
   </div>
  </div>
 </div>
</div>
</div>



 <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
           </button>
      </div>
     <div class="modal-body">
      <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Producto</th>
      <th scope="col">Precio</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr  v-for="(ls,index) of listProduct">
      <td><img v-bind:src="ls.imgen"></td>
      <td>{{ls.nombre}}</td>
      <td>{{ls.precio}}</td>
      <td><a class="btn btn-danger" href="#" @click="deleteTodo(index)"><i class="fa fa-times fa-md"></i></a></td>
    </tr>  
  </tbody> 
   </table>
   </div>
 </div>
 </div>
</div>

 <!-- Modal End -->








</div>
</template>

<script>



export default {
  


  data() {
    return { 
      todos:[],
      categories:{},
      todo : {},
      listProduct:[],
      CategorieID:'',
      available:'',
      bestSeller:'',
      price:"",
      searchName:'',
       }

       }, 
        methods:{
         getTodos(){
            axios.get('/api/todo').then((response) =>{
               this.todos = response.data
                  }).catch((error) =>{
                 console.log(error)
               })
            },
  
          getCategories(){
            axios.get('/api/categories').then((response) =>{
               this.categories = response.data
                  }).catch((error) =>{
                 console.log(error)
               })
            }, 
        addProduct(todo){
         this.listProduct.push({
         idItem :todo.id,
         nombre :todo.name,
         precio: todo.price,
         imgen: todo.img
        })
        this.nuevaProducto=""
        localStorage.setItem('lista_productos',
         JSON.stringify(this.listProduct))

        },
        showCarrito(){
          $('#modal').modal('show');
        },
        deleteTodo(id)
          {
       this.listProduct.splice(id,1)
       localStorage.setItem('lista_productos',
       JSON.stringify(this.listProduct))
         
          },
        filterByName(todo) { 
       if (this.searchName.length === 0) {
        return true;
        }

         return  (todo.name.toLowerCase().indexOf(this.searchName.toLowerCase()) > -1);
        }, 
       filterCategorie(todo) { 
       if (this.CategorieID.length === 0) {
        return true;
        }
        return  (todo.categories.includes(this.CategorieID));
        },  
        filterPrice(todo) { 
       if (this.price.length === 0) {
        return true;
        }
        if(parseInt(this.price) === 10000){
        return  (parseInt(todo.price) <= parseInt(this.price));
        }else{
         return  (parseInt(todo.price) >= parseInt(this.price));
        }
        
        }, 
        filterSeller(todo) { 
       if (this.bestSeller.length === 0) {
        return true;
        }
    
         return todo.best_seller === this.bestSeller;
       
        }, 

       filterAvailable(todo) { 
       if (this.available.length === 0) {
        return true;
        }
         return todo.available === this.available;
         },  
        },
        mounted(){
        this.getCategories() 
        this.getTodos()   
        },

        computed:{
        filteredProducts: function () {
          return this.todos
         .filter(this.filterByName)
         .filter(this.filterCategorie)
         .filter(this.filterPrice)
         .filter(this.filterSeller)
         .filter(this.filterAvailable)

        }
      },
    created(){
   let datosDB = JSON.parse(localStorage.getItem('lista_productos'))
  if(datosDB === null){
    this.listProduct = []
   }else{
    this.listProduct = datosDB
  }
 }
    }
</script>
