<template>
    <div>
		<h2 class="text-center">Редактировать книгу</h2>
		<form @submit.prevent="updateBook">
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
            <button type="submit" class="btn btn-primary">Обновить книгу</button>
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
        created() {
            this.axios
                .get(`/api/books/${this.$route.params.id}`)
                .then((res) => {
                    this.book = res.data;
                });
        },
        methods: {
            updateBook() {
                this.axios
                    .patch(`/api/books/${this.$route.params.id}`, this.book)
                    .then((res) => {
                        this.$router.push({ name: 'index' });
                    });
            }
        }
    }
</script>