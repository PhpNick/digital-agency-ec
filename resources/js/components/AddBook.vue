<template>
    <div>
		<h2 class="text-center">Добавить книгу</h2>
        <form @submit.prevent="addBook">
            <div class="form-group">
                <label>Автор</label>
                <input type="text" class="form-control" v-model="book.author">
            </div>
            <div class="form-group">
                <label>Автор или соавторы</label>
                <input type="text" class="form-control" v-model="book.co_author">
            </div>
            <div class="form-group">
                <label>Название</label>
                <input type="text" class="form-control" v-model="book.title">
            </div>
            <div class="form-group">
                <label>Описание</label>
                <textarea class="form-control" v-model="book.description" rows="3"></textarea>
            </div>                        
            <button type="submit" class="btn btn-primary">Добавить книгу</button>
        </form>        

	</div>
</template>

<script>
    export default {
        data() {
            return {
                book: {}
            }
        },
        methods: {
            addBook() {
                this.axios
                    .post('http://localhost:8001/api/books', this.book)
                    .then(response => (
                        this.$router.push({ name: 'index' })
                    ))
                    .catch(err => console.log(err))
            }
        }
    }
</script>	