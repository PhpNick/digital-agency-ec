<template>
    <div>
		<h2 class="text-center">Список книг <router-link to="/add" class="btn btn-link btn-lg" v-if="logged">( Добавить книгу )</router-link></h2>

        <form @submit.prevent="searchBooks">
        <div class="input-group">
          <input v-model="searchKey" class="form-control" id="search-element" requred placeholder="Поиск по каталогу" />
          <div class="input-group-append">
          <button type="submit" class="btn btn-primary">Найти книги</button>
          </div>
        </div>
        </form>

        <select class="form-control my-2 col-sm-4" v-model="sort" @change="sortBooks">
          <option disabled value="">Сортировка</option>
          <option value="title">по названию</option>
          <option value="author">по автору</option>
          <option value="description">по описанию</option>
          <option value="created_at">по дате публикации</option>
        </select>

		<div class="card my-2" style="width: 100%;" v-for="book in books" :key="book.id">
		  <div class="card-body">
            <div class="d-flex justify-content-between">
		    <h5 class="card-title">{{book.title}}</h5>
            <small class="ml-2 text-nowrap">{{book.created_at | formatDate}}</small>
            </div>
		    <h6 class="card-subtitle mb-2 text-muted">{{book.author}} / {{book.co_author}}</h6>
		    <p class="card-text">{{book.description}}</p>
			<router-link :to="{name: 'edit', params: { id: book.id }}" class="btn btn-link" v-if="logged">Редактировать</router-link>

            <button class="btn btn-link" @click="deleteBook(book.id)" v-if="logged">Удалить</button>		    

		  </div>
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                books: [],
                logged: false,
                searchKey: '',
                sort: ''
            }
        },
        created() {
            this.axios
                .get('/api/books/')
                .then(response => {
                    this.books = response.data;
                });
            if(this.$userId != '') {
            	this.logged = true;
            }
        },
        methods: {
            deleteBook(id) { 
                this.axios
                    .delete(`/api/books/${id}`)
                    .then(response => {
                        let i = this.books.map(data => data.id).indexOf(id);
                        this.books.splice(i, 1)
                    });
            },

            searchBooks() { 
            this.axios
                .get(`/api/books/search/${this.searchKey}`)
                .then(response => {
                    this.books = response.data;
                });
            },

            sortBooks() { 
            this.axios
                .get(`/api/books/sort/${this.sort}`)
                .then(response => {
                    this.books = response.data;
                });
            }                        
        }
    }
</script>	