<template>
    <div>
		<h2 class="text-center">Список книг</h2>
		<router-link to="/add" class="btn btn-link" v-if="logged">Добавить книгу</router-link>
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
                logged: false
            }
        },
        created() {
            this.axios
                .get('http://localhost:8001/api/books/')
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
                    .delete(`http://localhost:8001/api/books/${id}`)
                    .then(response => {
                        let i = this.books.map(data => data.id).indexOf(id);
                        this.books.splice(i, 1)
                    });
            }
        }
    }
</script>	